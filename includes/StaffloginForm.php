<?php 
    // Error Setting
    $passwordError = "Error logging in: Email or Password is Incorrect";
    $error = "";

    if (isset($_POST["form__submitInput"])) {
        $email = secure($_POST["email"]);
        $password = secure($_POST["password"]);

        $sqlGetLoginData = "SELECT * FROM `internallogin` WHERE `email` = '{$email}'";
        $result = $conn -> query($sqlGetLoginData);
        if ($result -> num_rows > 0) {
            while ($row = $result -> fetch_assoc()) {
                $userPassword = $row["password"];
                $userActive = $row["active"];
            }
            if(password_verify($password, $userPassword) & $userActive) {
                $result = $conn -> query($sqlGetLoginData);
                   while ($row = $result -> fetch_assoc()){
                    $userID = $row['internalID'];
                    $firstName = $row['firstName'];
                    $lastName = $row['lastName'];
                    $email = $row['email'];
                    $phone = $row['phone'];
                    $internalLevel = $row['intLevel'];
                   } 
                session_start();
                $_SESSION['userID'] = $userID;
                $_SESSION['firstName'] = $firstName;
                $_SESSION['lastName'] = $lastName;
                $_SESSION['email'] = $email;
                $_SESSION['phone'] = $phone;
                $_SESSION['internalLevel'] = $internalLevel;
                header('Location: ./internal_dashboard.php');
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
        <legend class="form__legend">Staff Login</legend>
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