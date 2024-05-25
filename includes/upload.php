<?php 
include("functions.php");
session_start();
$conn = openCon();
if ($_SESSION['step'] == 2 && isset($_POST['question_text'])) {
    $module_id = $_SESSION['module_id'];
    $question_text = $_POST['question_text'];

    // Insert question into the database
    $stmt = $conn->prepare("INSERT INTO questions (moduleID, questionText) VALUES (?, ?)");
    $stmt->bind_param('is', $module_id, $question_text);
    $stmt->execute();
    $question_id = $stmt->insert_id;
    $stmt->close();

    // Handle media upload if any
    if (!empty($_FILES['media']['name'][0])) {
        $file_count = count($_FILES['media']['name']);
        for ($i = 0; $i < $file_count; $i++) {
            $file_name = basename($_FILES['media']['name'][$i]);
            $media_type = $_POST['media_type']; // 'audio', 'image', 'video', or 'pdf'
            $target_dir = "uploads/media/";
            $target_file = $target_dir . $file_name;

            if (!file_exists($target_dir)) {
                mkdir($target_dir, 0777, true);
            }

            if (move_uploaded_file($_FILES['media']['tmp_name'][$i], $target_file)) {
                $stmt = $conn->prepare("INSERT INTO media (questionID, mediaType, mediaPath) VALUES (?, ?, ?)");
                $stmt->bind_param('iss', $question_id, $media_type, $target_file);
                $stmt->execute();
                $stmt->close();
            }
        }
    }

    // Respond with a success message
    echo json_encode(['status' => 'success', 'message' => 'Question and media saved successfully']);
} else {
    // Respond with an error message
    echo json_encode(['status' => 'error', 'message' => 'Invalid request']);
}

?>