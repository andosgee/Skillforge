<?php
    if(isset($_POST["form__submitInput"])){
        // Company Details
        $companyName = secure($_POST['companyName']);
        $unitStreet = secure($_POST['unitStreetNumber']);
        $addressLn1 = secure($_POST['addressLine1']);
        $addressLn2 = secure($_POST['addressLine2']);
        $country = secure($_POST['countrySelect']);
        $city = secure($_POST['city']);
        $state = secure($_POST['state']);
        $zip = secure($_POST['zip']);
        $companyPhone = secure($_POST['companyPhone']);
        // Delegate Details
        $firstName = secure($_POST['firstName']);
        $lastName = secure($_POST['lastName']);
        $email = secure($_POST['email']);
        $phone = secure($_POST['contactPhone']);

        // Add to Company
        $sqlAddComapny = "INSERT INTO `companies`(`name`, `unitStreetNum`, `Address1`, `Address2`, `Country`, `City`, `State`, `Zip`, `phoneNumber`) 
                          VALUES ('{$companyName}', '{$unitStreet}','{$addressLn1}','{$addressLn2}','{$country}','{$city}','{$state}','{$zip}','{$companyPhone}')";
        $conn -> query($sqlAddComapny);
        $sqlGetCompany = "SELECT `companyID` FROM `companies` WHERE `name` = '{$companyName}' AND `Address1` = '{$addressLn1}'";
        $companyID = $conn -> query($sqlGetCompany);
        // Get ID from returned result
        if ($companyID && $row = $companyID->fetch_assoc()) {
            $companyID = $row['companyID'];
        }

        // Add Permission Level
        $sqlNewPermission = "INSERT INTO `userlevel`(`companyID`, `levelName`) VALUES ('{$companyID}','Admin')";
        $conn -> query($sqlNewPermission);
        $sqlGetPermission = "SELECT `levelID` FROM `userLevel` WHERE `companyID` = '{$companyID}', 'Admin'";
        $permissionID = $conn -> query($sqlGetPermission);
        // Get ID from returned result
        if ($permissionID && $row = $permissionID->fetch_assoc()) {
            $permissionID = $row['levelID'];
        }

        // Add User
        $sqlAddUser = "INSERT INTO `userdata`(`firstName`, `lastName`, `email`, `phone`, `level`, `active`, `companyID`) VALUES
                       ('{$firstName}', '{$lastName}','{$email}','{$phone}','{$permissionID}','1','{$companyID}')";
        $conn -> query($sqlAddUser);
        $sqlGetUser = "SELECT `userID` FROM `userdata` WHERE `firstName` = '{$firstName}' AND `lastName` = '{$lastName}' AND `companyID` = '{$companyID}'";
        $userID = $conn -> query($sqlGetUser);
        if ($userID && $row = $userID->fetch_assoc()) {
            $userID = $row['userID'];
        }

        // Enable Login
        $password = $companyName . $unitStreet;
        $password = password_hash($password, PASSWORD_DEFAULT);
        $sqlAddLogin = "INSERT INTO `userLogin`(`userID`,`password`) VALUES ('{$userID}',{$password})";
        $conn -> query($sqlAddLogin);
        
        // Email User with their details for login and company creation
        $to = $email;
        $subject = "Account Activated and Login Details";
        $message = "Hello {$firstName} {$lastName},
        The company {$companyName} located at {$unitStreet} {$addressLn1} {$addressLn2} {$city} {$state} {$zip} {$country} with a phone number of {$companyPhone}, has been successfully added.
        As you are the nominated delegate for {$companyName}, please login with {$email} and your password is {$companyName}{$unitStreet}. Please change your password as soon as you login under 'My Details'.
        Many Thanks
        The Skillforge Team";
        $headers = "From: mail.skillforge@gmail.com";
        mail($to, $subject, $message, $headers);
    }
?>

<div id="addCompany" class="content">
    <div class="content__wrapper">
        <form method="POST" class="form">
            <fieldset class="form__fieldset">
                <legend class="form__legend">Company Details</legend>
                <label for="companyName" class="form__label">Company Name: </label>
    	        <input type="text" id="companyName" class="form__textInput" name="companyName" required>
                <br>
                <label for="unitStreetNumber" class="form__label">Unit/Street Number:</label>
                <input type="text" id="unitStreetNumber" class="form__textNum" name="unitStreetNumber" required>
                <br>
                <label for="addressLine1" class="form__label">Address Line 1:</label>
                <input type="text" id="addressLine1" class="form__textInput" name="addressLine1" required>
                <br>
                <label for="addressLine2" class="form__label">Address Line 2:</label>
                <input type="text" id="addressLine2" class="form__textInput" name="addressLine2">
                <br>
                <label for="countrySelect" class="form__label">Country:</label>
                <select name="countrySelect" id="countries" data-palceholder="Select Country" class="form__select" required>
                <?php 
                    include "countryList.php";
                ?>
                </select>
                <p></p>
                <label for="city" class="form__label">City:</label>
                <input type="text" id="city" class="form__textInput" name="city" required>
                <br>
                <label for="zip" class="form__label">Zip/Post Code:</label>
                <input type="text" id="zip" class="form__textNum" name="zip">
                <br>
                <label for="state" class="form__label">State:</label>
                <input type="text" id="state" class="form__textInput" name="state">
                <br>
                <label for="companyPhone" class="form__label">Contact Nmber:</label>
                <input type="tel" name="companyPhone" id="companyPhone" class="form__telInput" placeholder="(64)1235846" required>
            </fieldset>
            <fieldset class="form__fieldset">
                <legend class="form__legend">Company Delegate</legend>
                <label for="firstName" class="form__label">First Name:</label>
                <input type="text" name="firstName" class="form__textInput" placeholder="Bob" required>
                <br>
                <label for="lastName" class="form__label">Last Name:</label>
                <input type="text" name="lastName" class="form__textInput" placeholder="Smith" required>
                <br>
                <label for="email" class="form__label">Email:</label>
                <input type="email" name="email" class="form__emailInput" placeholder="bob.smith@example.com" required>
                <br>
                <label for="contactPhone" class="form__label">Contact Nmber:</label>
                <input type="tel" name="contactPhone" class="form__telInput" placeholder="(64)1235846" required>
            </fieldset>
            <input name="form__submitInput" type="submit" value="Create" class="form__submitInput">
        </form>
    </div>
</div> 


<script src="./chosenLib/chosen.jquery.js" type="text/javascript"></script>
<script>
    $("#countries").chosen({no_results_text: "Oops, nothing found!"});
</script>