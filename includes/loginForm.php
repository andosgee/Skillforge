<?php 
// Error Setting
$passwordError = "Error logging in: Email or Password is Incorrect";
echo password_hash($passwordDef, PASSWORD_DEFAULT);

if (isset($_POST["form__submitInput"])) {
    $email = secure($_POST["email"]);
    $password = secure($_POST["password"]);

    $sqlGetLoginData = "SELECT * FROM `userdata` WHERE `email` = '{$email}'";
    $result = $conn -> query($sqlGetLoginData);
    if ($result -> num_rows > 0) {
        while ($row = $result -> fetch_assoc()) {
            $userID = $row["userID"];
            $userActive = $row["active"];
        }
        $sqlGetPassword = "SELECT * FROM `userlogin` WHERE `userID` = '{$userID}'";
        $result = $conn -> query($sqlGetPassword);
        while ($row = $result -> fetch_assoc()) {
            $userPassword = $row["password"];
        }
        if(password_verify($password, $userPassword) & $userActive) {
            $result = $conn -> query($sqlGetLoginData);
               while ($row = $result -> fetch_assoc()){
                $userID = $row['userID'];
                $firstName = $row['firstName'];
                $lastName = $row['lastName'];
                $email = $row['email'];
                $phone = $row['phone'];
                $companyLevel = $row['level'];
                $companyID = $row['companyID'];
               } 
            session_start();
            $_SESSION['userID'] = $userID;
            $_SESSION['firstName'] = $firstName;
            $_SESSION['lastName'] = $lastName;
            $_SESSION['email'] = $email;
            $_SESSION['phone'] = $phone;
            $_SESSION['companyLevel'] = $companyLevel;
            $_SESSION['companyID'] = $companyID;
            header('Location: ./sample.php');
        }else{
            echo $passwordError;
        }
    }else{
        echo $passwordError;
    }
}

?>
<div class="login">
    <div class="login__wrapper">
<form method="POST" class="form">
    <fieldset class="form__fieldset">
        <legend class="form__legend">User Login</legend>
        <label for="email" class="form__label">Email: </label>
        <input type="email" id="email" class="form__emailInput" name="email" required>
        <br>
        <label for="password" class="form__label">Password: </label>
        <input type="password" id="password" class="form__textInput" name="password" required>
        <br>
        <input name="form__submitInput" type="submit" value="Login" class="form__submitInput">
    </fieldset>
</form>
</div>
</div>