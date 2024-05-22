<?php 
$error = '';
$userID = $firstName = $lastName = $email = $phone = $intLevel = $active = '';
if(isset($_GET['id']) && !empty($_GET['id'])){
    if ($_GET ['id'] == '0'){
        $error = "Please Select a User";
    }elseif($_GET ['id'] == 'OwnUser'){
        $error = "";
     include "../includes/functions.php";
     $conn = OpenCon();
    $id = $_SESSION['userID'];;
    $sqlCompany = "SELECT * FROM `userData` WHERE  `userID` = '{$id}'";
    
    $result = $conn -> query($sqlCompany);
    if (isset($result)){
        while ($row = $result -> fetch_assoc()) {
            $userID = $row['userID'];
            $firstName = $row['firstName'];
            $lastName = $row['lastName'];
            $email = $row['email'];
            $phone = $row['phone'];
        }}
    }else{
    //Refresh connection and functions for async request
    $error = "";
     include "../includes/functions.php";
     $conn = OpenCon();
    $id = $_GET['id'];
    $sqlCompany = "SELECT * FROM `userData` WHERE  `userID` = '{$id}'";
    
    $result = $conn -> query($sqlCompany);
    if (isset($result)){
        while ($row = $result -> fetch_assoc()) {
            $userID = $row['userID'];
            $firstName = $row['firstName'];
            $lastName = $row['lastName'];
            $email = $row['email'];
            $phone = $row['phone'];
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
        $sqlCheckUsers = "SELECT * FROM `userData` WHERE `email` = '{$email}'";
        $result = $conn -> query($sqlCheckUsers);
        if ($result && $result->num_rows > 0) {
            echo "Email already used.";
        } else {
            $password = $email . $phone;
            $password = password_hash($password, PASSWORD_DEFAULT);
            $sqlAddUser = "INSERT INTO `userData` (`firstName`, `lastName`, `email`, `phone`, `level`, `active`, `companyID`) VALUES ('{$firstName}', '{$lastName}', '{$email}', '{$phone}', '{$intLevel}', '1', '{$__SESSION['companyID']}')";
            $conn -> query($sqlAddUser);
            $sqlGetLastUser = "SELECT `userID` FROM `userData` WHERE `email` = '{$email}' AND companyID = '{$__SESSION['companyID']}'";
            $result = $conn -> query($sqlGetLastUser);
            while ($row = $result -> fetch_assoc()) {
                $id = $row["userID"];
            }
            $sqlActivateLogin = "INSERT INTO `userlogin` (`userID`,`password`) VALUES ('{$id}','{$password}')";
            $result = $conn -> query($sqlActivateLogin);
        }
    }

    if(isset($_POST["updateDetails"])){
        $userID = secure($_POST['userID']);
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
            $update_sql = "UPDATE `userData` SET " . implode(", ", $update_fields) . " WHERE `userID` = ?";
            if ($userID = 'OwnUser'){
                $update_params[] = $_SESSION['userID']; // Adding $_SESSION['userID'] to the parameters list
                $types .= 'i'; // Adding the type for $_SESSION['userID']
            } else {
                $update_params[] = $userID;
                $types .= 'i'; // Adding the type for userID
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
        <input type="hidden" name="userID" value="<?php echo htmlspecialchars($userID); ?>">
        Can modify other user or create a new user.
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
        <label for="levelSelect" class="form__label">Role: </label>
        <select name="levelSelect" id="levelSelect" class="form__select">
            <option value="">---</option>
            <?php 
                $sqlGetRoles = "SELECT * FROM `userLevel` WHERE companyID = '{$_SESSION['companyID']}'";
                $roleList = $conn->query($sqlGetRoles);
            while ($row = $roleList->fetch_assoc()) {
            echo "<option value='{$row['levelID']}'>{$row['levelName']}</option>";
            }
            ?>
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
