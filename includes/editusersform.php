<?php 
$error = '';
$internalID = $firstName = $lastName = $email = $phone = $intLevel = $active = '';
if(isset($_GET['id']) && !empty($_GET['id'])){
    if ($_GET ['id'] == '0'){
        $error = "Please Select a User";
    }elseif($_GET ['id'] == 'OwnUser'){
        $error = "";
     include "../includes/functions.php";
     $conn = OpenCon();
    $id = $_SESSION['userID'];;
    $sqlCompany = "SELECT * FROM `internallogin` WHERE  `internalID` = '{$id}'";
    
    $result = $conn -> query($sqlCompany);
    if (isset($result)){
        while ($row = $result -> fetch_assoc()) {
            $internalID = $row['internalID'];
            $firstName = $row['firstName'];
            $lastName = $row['lastName'];
            $email = $row['email'];
            $phone = $row['phone'];
            $intLevel = $row['intLevel'];
            $active = $row['active'];
        }}
    }else{
    //Refresh connection and functions for async request
    $error = "";
     include "../includes/functions.php";
     $conn = OpenCon();
    $id = $_GET['id'];
    $sqlCompany = "SELECT * FROM `internallogin` WHERE  `internalID` = '{$id}'";
    
    $result = $conn -> query($sqlCompany);
    if (isset($result)){
        while ($row = $result -> fetch_assoc()) {
            $internalID = $row['internalID'];
            $firstName = $row['firstName'];
            $lastName = $row['lastName'];
            $email = $row['email'];
            $phone = $row['phone'];
            $intLevel = $row['intLevel'];
            $active = $row['active'];
        }
    }}

?>

<form id="detailsDisplay" class="form form--details">
    <fieldset class="form__fieldset">
        <legend class="form__legend">Details</legend>
        <label class="form__label">First Name: </label><?php echo $firstName; ?>
        <br>
        <label class="form__label">Last Name: </label><?php echo $lastName; ?>
        <br>
        <label class="form__label">Email: </label><?php echo $email; ?>
        <br>
        <label class="form__label">Phone: </label>+<?php echo $phone; ?>
        <br>
        <label class="form__label">Internal Level: </label><?php echo $intLevel; ?>
        <br>
        <label class="form__label">Active User: </label><?php echo $active; ?>
    </fieldset>
</form>

<?php } ?>
<?php 
    if(isset($_POST['addUser'])){
        $firstName = secure($_POST['firstName']);
        $lastName = secure($_POST['lastName']);
        $email = secure($_POST['email']);
        $phone = secure($_POST['phone']);
        $intLevel = secure($_POST['levelSelect']);

        // Checks for duplicate user
        $sqlCheckUsers = "SELECT * FROM `internallogin` WHERE `email` = '{$email}'";
        $result = $conn -> query($sqlCheckUsers);
        if ($result && $result->num_rows > 0) {
            echo "Email already used.";
        } else {
            $password = $email . $phone;
            $password = password_hash($password, PASSWORD_DEFAULT);
            $sqlAddUser = "INSERT INTO `internallogin` (`firstName`, `lastName`, `email`, `phone`, `password`, `intLevel`, `active`) VALUES ('{$firstName}', '{$lastName}', '{$email}', '{$phone}', '{$password}', '{$intLevel}', '1')";
            $conn -> query($sqlAddUser);
        }
    }

    if(isset($_POST["updateDetails"])){
        $internalID = secure($_POST['internalID']);
        $fields = [
            'firstName' => isset($_POST['firstName']) ? secure($_POST['firstName']) : null,
            'lastName' => isset($_POST['lastName']) ? secure($_POST['lastName']) : null,
            'email' => isset($_POST['email']) ? secure($_POST['email']) : null,
            'phone' => isset($_POST['phone']) ? secure($_POST['phone']) : null,
            'intLevel' => isset($_POST['levelSelect']) ? secure($_POST['levelSelect']) : null,
        ];

        $update_fields = [];
        $update_params = [];
        $types = '';

        foreach ($fields as $key => $value) {
            if (!empty($value)) {
               $update_fields[] = "$key = ?";
               $update_params[] = $value;
              $types .= 's'; // Assuming all fields are strings
            }
        } 
        if (count($update_fields) > 0) {
            $update_sql = "UPDATE `internallogin` SET " . implode(", ", $update_fields) . " WHERE `internalID` = ?";
            if ($internalID = 'OwnUser'){
                $update_params[] = $_SESSION['userID']; // Adding $_SESSION['userID'] to the parameters list
                $types .= 'i'; // Adding the type for $_SESSION['userID']
            } else {
                $update_params[] = $internalID;
                $types .= 'i'; // Adding the type for internalID
            }
    
            $stmt = $conn->prepare($update_sql);
            if ($stmt === false) {
                die("Prepare failed: " . $conn->error);
            }
    
            $stmt->bind_param($types, ...$update_params);
    
            if ($stmt->execute()) {
                echo "User updated successfully";
            } else {
                echo "Error updating User: " . $stmt->error;
            }
    
            $stmt->close();
        } else {
            echo "No fields to update";
        } 
    }

?>

<form id ="editUser" method="POST" class="form form--fill" >
    <fieldset class="form__fieldset">
        <legend>Modify User</legend>
        <input type="hidden" name="internalID" value="<?php echo htmlspecialchars($internalID); ?>">
        Can modify other user, create a new user or own user.
        <br>
        To modify another user, simply select their name in the drop down and edit the neccessary fields.
        <br>
        To modify yourself, change dropdown to 'Myself'.
        <p></p>
        <label for="firstName" class="form__label">First Name: </label>
        <input type="text" class="form__input" id="firstName" name="firstName">
        <br>
        <label for="lastName" class="form__label">Last Name: </label>
        <input type="text" class="form__input" id="lastName" name="lastName">
        <br>
        <label for="email" class="form__label">Email: </label>
        <input type="email" class="form__input" id="email" name="email">
        <br>
        <label for="phone" class="form__label">Phone: </label>
        <input type="tel" class="form__input" id="phone" name="phone">
        <br>
        <label for="levelSelect" class="form__label">Internal Level: </label>
        <select name="levelSelect" id="levelSelect" class="form__select">
            <option value="3">Full Admin</option>
        </select>
        <br>
        <label class="form__label">Active User: </label>
        <input type="checkbox">
        <br>
        <input name="updateDetails" type="submit" value="Update Details" class="form__submitInput">
        <input name="addUser" type="submit" value="Add User" class="form__submitInput">
    </fieldset>
</form>

<script src="./chosenLib/chosen.jquery.js" type="text/javascript"></script>
    <script>
        $("#users").chosen({no_results_text: "Oops, nothing found!"});
    </script>
