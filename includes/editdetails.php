<?php 
    $error = '';
    if(isset($_POST['changePassword'])){
        $oldPassword = secure($_POST['oldPassword']);
        $newPassword = secure($_POST['newPassword']);
        $confirmPassword = secure($_POST['confirmPassword']);
    
        if ($oldPassword != $newPassword && $confirmPassword == $newPassword){
            $sqlGetPassword = "SELECT * FROM `userlogin` WHERE `userID` = '{$_SESSION['userID']}'";
            $result = $conn -> query($sqlGetPassword);
            if($result -> num_rows > 0){
                $row = $result -> fetch_assoc();
                $oldPasswordSql = $row["password"];
            }
            if (password_verify($oldPasswordSql, $oldPassword)){
                $shaPassword = password_hash($newPassword, PASSWORD_DEFAULT);
                $sqlChangePwd = "UPDATE `userlogin` SET `password` = '{$shaPassword}' WHERE `userID` = '{$_SESSION['userID']}'";
                $conn -> query($sqlChangePwd);
             }
        }else{
            $error = "Password Error: Passwords don't match or Incorrect Password entered.";
        }
     }

     $firstName = $lastName = $email = $phone = "";
     if(isset($_POST["changeDetails"])){
        $id = $_SESSION['userID'];
        $fields = [
            'firstName' => isset($_POST['firstName']) ? secure($_POST['firstName']) : null,
            'lastName' => isset($_POST['lastName']) ? secure($_POST['lastName']) : null,
            'email' => isset($_POST['email']) ? secure($_POST['email']) : null,
            'phone' => isset($_POST['phone']) ? secure($_POST['phone']) : null,
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
        if (count($update_fields) > 0){
            $sqlUpdate = "UPDATE `userData` SET " . implode(", ", $update_fields) . " WHERE `userID` = ?";
            $update_params[] = $id;
            $types .= 'i';

            $stmt = $conn->prepare($sqlUpdate);
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
        }else {
            echo "No fields to update";
        }
     } 
?>

<div class="content">
    <div class="content__wrapper content__wrapper--form">
        <form method="POST" class="form">
            <fieldset class="form__fieldset">
                <legend class="form__legend">Edit Details</legend>
                <label for="firstName">First Name:</label>
                <input type="text" name="firstName" class="form__textInput">
                <br>
                <label for="lastName">Last Name:</label>
                <input type="text" name="lastName" class="form__textInput">
                <br>
                <label for="email">Email: </label>
                <input type="email" name="email" class="form__emailInput">
                <br>
                <label for="phone">Phone: </label>
                <input type="tel" name="contactPhone" class="form__telInput">
                <br>
                <label for="level">Group: </label>
                <?php 
                    $sqlGetLevel = "SELECT * FROM `userLevel` WHERE levelID = '{$_SESSION['companyLevel']}'";
                    $result = $conn -> query( $sqlGetLevel );
                    while( $row = $result -> fetch_assoc() ){
                        $level = $row["levelName"];
                    }
                    echo $level;
                ?>
                <br>
                <label for="company">Company: </label>
                <?php 
                    $sqlGetCompany = "SELECT * FROM `companies` WHERE companyID = '{$_SESSION['companyID']}'";
                    $result = $conn -> query( $sqlGetCompany );
                    while( $row = $result -> fetch_assoc() ){
                        $company = $row["name"];
                    }
                    echo $company;
                ?>
                <br>
                <input name="changeDetails" type="submit" value="Change Details" class="form__submitInput">
            </fieldset>
        </form>

        <form id ="changePassword" method="POST" class="form form--password" >
            <fieldset class="form__fieldset">
                <legend>Change Own Password</legend>
                <?php echo $error; ?>
                <br>
                <label for="oldPassword" class="form__label">Old Password: </label>
                <input type="password" id="oldPassword" class="form__textInput" name="oldPassword" required>
                <br>
                <label for="newPassword" class="form__label">New Password: </label>
                <input type="password" id="newPassword" class="form__textInput" name="newPassword" required>
                <br>
                <label for="confirmPassword" class="form__label">Confirm New Password: </label>
                <input type="password" id="confirmPassword" class="form__textInput" name="confirmPassword" required>
                <br>
                <input name="changePassword" type="submit" value="Change Password" class="form__submitInput">
            </fieldset>
        </form>
    </div>
</div>