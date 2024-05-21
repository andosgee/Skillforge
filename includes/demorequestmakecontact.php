<?php 
$error = '';
$requestID = $firstName = $lastName = $email = $phone = $country =$company = $contacted = $contactID ='';
if(isset($_GET['id']) && !empty($_GET['id'])){
    if ($_GET ['id'] == '0'){
        $error = "Please Select a Person";
    }else{
    //Refresh connection and functions for async request
    $error = "";
     include "../includes/functions.php";
     $conn = OpenCon();
    $id = $_GET['id'];
    $sqlCompany = "SELECT * FROM `requestdemo` WHERE  `requestID` = '{$id}'";
    
    $result = $conn -> query($sqlCompany);
    if (isset($result)){
        while ($row = $result -> fetch_assoc()) {
            $requestID = $row['requestID'];
            $firstName = $row["firstName"];
            $lastName = $row["lastName"];
            $email = $row["email"];
            $country = $row["country"];
            $phone = $row['phone'];
            $company = $row['country'];
            $contacted = $row['contacted'];
            if ($contacted != 1){
                $contacted = "No";
            } else{
                $contacted = "Yes";
            }
            $contactID = $row['contactID'];
            echo $contactID;
        }
    }
    if (isset($contactID)){
        $sqlGetIntUser = "SELECT * FROM `internalLogin` WHERE `internalID` = '{$contactID}'";
        $result = $conn -> query($sqlGetIntUser);
        if (isset($result)){
            while ($row = $result -> fetch_assoc()) {
                $intName = $row["firstName"].' '. $row["lastName"];
    }}
    }else {
        $intName = "Not Contacted";
    }
    
}
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
        <label class="form__label">Phone: </label><?php echo $phone; ?>
        <br>
        <label class="form__label">Country: </label><?php echo $country; ?>
        <br>
        <label class="form__label">Company: </label><?php echo $company; ?>
        <br>
        <label class="form__label">Contacted: </label><?php echo $contacted; ?>
        <br>
        <label class="form__label">Contacted by: </label><?php echo $intName; ?>
        
    </fieldset>
</form>
<?php }?>
<?php 
    if (isset($_POST['form__submitInput'])){
        $message = secure($_POST['emailMessage']);
        $email = secure($_POST['email']);
        $requestID = secure($_POST['requestID']);

        // Send Email
        $to = $email;
        $subject = "Follow up Regarding Demo Request";
        $headers = "From: mail.skillforge@gmail.com";
        mail($to, $subject, $message, $headers);

        // Set to contacted and sent by user
        $sqlSetToContacted = "UPDATE `requestdemo` SET `contacted` = '1', `contactID` = '{$_SESSION['userID']}' WHERE `requestID` = '{$requestID}'";
        $conn -> query($sqlSetToContacted);
    }
?>
<form id="message" method="POST" class="form form--fill">
<input type="hidden" name="requestID" value="<?php echo htmlspecialchars($requestID); ?>">
<input type="hidden" name="email" value="<?php echo htmlspecialchars($email); ?>">
    <fieldset class="form__fieldset">
        <legend class="form__legend">Email Contact</legend>
        <label for="emailMessage" class="form__label">Message to Send: </label>
    <textarea name="emailMessage" id="emailMessage" class="form__largeText">Write the message here....</textarea>
    <br>
    <input name="form__submitInput" type="submit" value="Send Message" class="form__submitInput">
    </fieldset>
    <br>
</form>
<script src="./chosenLib/chosen.jquery.js" type="text/javascript"></script>
    <script>
        $("#demoRequests").chosen({no_results_text: "Oops, nothing found!"});
    </script>