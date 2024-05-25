<?php
if (!isset($_SESSION['module_id'])) {
    $_SESSION['module_id'] = null;
    $_SESSION['step'] = 1;
    $_SESSION['question_number'] = 0;
}

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    if ($_SESSION['step'] == 1 && isset($_POST['create_module'])) {
        $companyID = intval($_POST['companyID']);
        $title = $_POST['title'];
        $descriptor = $_POST['descriptor'];
        $thumbnail = '';

        if ($_FILES['thumbnail']['name']) {
            $file_name = basename($_FILES['thumbnail']['name']);
            $target_dir = "uploads/thumbnails/";
            $target_file = $target_dir . $file_name;

            if (!file_exists($target_dir)) {
                mkdir($target_dir, 0777, true);
            }

            if (move_uploaded_file($_FILES['thumbnail']['tmp_name'], $target_file)) {
                $thumbnail = $target_file;
            }
        }

        $stmt = $conn->prepare("INSERT INTO modules (companyID, title, descriptor, thumbnail) VALUES (?, ?, ?, ?)");
        $stmt->bind_param('isss', $companyID, $title, $descriptor, $thumbnail);
        $stmt->execute();
        $_SESSION['module_id'] = $stmt->insert_id;
        $_SESSION['step'] = 2;
        $_SESSION['question_number']++;
        $stmt->close();
    } elseif ($_SESSION['step'] == 2 && isset($_POST['add_question'])) {
        $module_id = $_SESSION['module_id'];
        $question_text = $_POST['question_text'];
        $_SESSION['question_number']++;
        $stmt = $conn->prepare("INSERT INTO questions (module_id, question_text) VALUES (?, ?)");
        $stmt->bind_param('is', $module_id, $question_text);
        $stmt->execute();
        $question_id = $stmt->insert_id;
        $stmt->close();

        if (!empty($_FILES['media']['name'][0])) {
            $media_files = $_FILES['media'];
            for ($i = 0; $i < count($media_files['name']); $i++) {
                $file_name = basename($media_files['name'][$i]);
                $media_type = $_POST['media_type'];
                $target_dir = "uploads/media/";
                $target_file = $target_dir . $file_name;

                if (!file_exists($target_dir)) {
                    mkdir($target_dir, 0777, true);
                }

                if (move_uploaded_file($media_files['tmp_name'][$i], $target_file)) {
                    $stmt = $conn->prepare("INSERT INTO media (question_id, media_type, media_path) VALUES (?, ?, ?)");
                    $stmt->bind_param('iss', $question_id, $media_type, $target_file);
                    $stmt->execute();
                    $stmt->close();
                }
            }
        }
    } elseif ($_SESSION['step'] == 2 && isset($_POST['publish_module'])) {
        $_SESSION['step'] = 1;
        $_SESSION['module_id'] = null;
        $_SESSION['question_number'] = 0;
    }
}

$companyID = 1;
$modules = $conn->query("SELECT * FROM modules WHERE companyID = $companyID");
?>

<div class="content">
    <div class="content__wrapper content__wrapper--form">
    <?php if ($_SESSION['step'] == 1): ?>
            <h2>Step 1: Create a Module</h2>
            <form method="post" action="" enctype="multipart/form-data" class="form">
                <input type="hidden" name="companyID" value="1"> <!-- Hardcoded for demonstration -->
                <label for="title">Title:</label>
                <input type="text" id="title" name="title" required><br><br>
                <label for="descriptor">Descriptor:</label>
                <input type="text" id="descriptor" name="descriptor" required><br><br>
                <label for="thumbnail">Thumbnail:</label>
                <input type="file" id="thumbnail" name="thumbnail" accept="image/*"><br><br>
                <button type="submit" class="form__submitInput" name="create_module">Save and Continue</button>
            </form>
        <?php elseif ($_SESSION['step'] == 2): ?>
            <h2>Step 2: Add Questions</h2>
            <p>Question <span id="questionNumber"><?php echo $_SESSION['question_number']; ?></span></p>

            <form id="questionForm" method="post" action="" enctype="multipart/form-data" class="form">
                <label for="question_text">Question:</label>
                <div id="editor-container"></div>
                <input type="hidden" id="question_text" name="question_text">
                <label for="media">Media:</label>
                <input type="file" id="media" name="media[]" multiple accept="audio/*,image/*,video/*,.pdf"><br><br>
                <label for="media_type">Media Type:</label>
                <select id="media_type" name="media_type" required>
                    <option value="audio">Audio</option>
                    <option value="image">Image</option>
                    <option value="video">Video</option>
                    <option value="pdf">PDF</option>
                    <option value="none">None</option>
                </select><br><br>
                <button type="button" class="form__submitInput" id="addQuestionBtn">Add Question</button>
                <button type="submit"  class="form__submitInput" name="publish_module">Save and Publish</button>
            </form>
        <?php endif; ?>

        <h2>Modules</h2>
        <?php if ($modules->num_rows > 0): ?>
            <ul>
                <?php while($row = $modules->fetch_assoc()): ?>
                    <li><?php echo htmlspecialchars($row['title']); ?></li>
                <?php endwhile; ?>
            </ul>
        <?php else: ?>
            <p>No modules found for this company.</p>
        <?php endif; ?>

    <script>
        var quill = new Quill('#editor-container', {
            theme: 'snow',
            modules: {
                toolbar: [
                    [{ 'header': [1, 2, false] }],
                    ['bold', 'italic', 'underline'],
                    ['image', 'code-block'],
                    [{ 'list': 'ordered'}, { 'list': 'bullet' }]
                ]
            }
        });

        $(document).ready(function() {
            $("#addQuestionBtn").click(function() {
                var delta = quill.getContents();
                $("#question_text").val(JSON.stringify(delta));
                
                var formData = new FormData($("#questionForm")[0]);
                
                $.ajax({
                    url: "includes/upload.php",
                    type: "POST",
                    data: formData,
                    processData: false,
                    contentType: false,
                    success: function(response) {
                        console.log(response);
                        // Handle success response
                    },
                    error: function(xhr, status, error) {
                        console.error(xhr.responseText);
                        // Handle error response
                    }
                });
            });
        });
    </script>
    </div>
</div>
