<?php
$error ="";
 if(isset($_POST['changePassword'])){
    $oldPassword = secure($_POST['oldPassword']);
    $newPassword = secure($_POST['newPassword']);
    $confirmPassword = secure($_POST['confirmPassword']);

    if ($oldPassword != $newPassword && $confirmPassword == $newPassword){
        $sqlGetPassword = "SELECT * FROM `internallogin` WHERE `internalID` = '{$_SESSION['userID']}'";
        $result = $conn -> query($sqlGetPassword);
        if($result -> num_rows > 0){
            $row = $result -> fetch_assoc();
            $oldPasswordSql = $row["password"];
        }
        if (password_verify($oldPasswordSql, $oldPassword)){
            $shaPassword = password_hash($newPassword, PASSWORD_DEFAULT);
            $sqlChangePwd = "UPDATE `internallogin` SET `password` = '{$shaPassword}' WHERE `internalID` = '{$_SESSION['userID']}'";
            $conn -> query($sqlChangePwd);
         }
    }else{
        $error = "Password Error: Passwords don't match or Incorrect Password entered.";
    }
 }
?>

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