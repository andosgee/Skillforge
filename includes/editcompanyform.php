<?php 
$error = '';
$companyID = $companyName = $unitStreet = $addressLn1 = $addressLn2 = $country =$city = $zip = $state = $phone ='';
if(isset($_GET['id']) && !empty($_GET['id'])){
    if ($_GET ['id'] == '0'){
        $error = "Please Select a Company";
    }else{
    //Refresh connection and functions for async request
    $error = "";
     include "../includes/functions.php";
     $conn = OpenCon();
    $id = $_GET['id'];
    $sqlCompany = "SELECT * FROM `companies` WHERE  `companyID` = '{$id}'";
    
    $result = $conn -> query($sqlCompany);
    if (isset($result)){
        while ($row = $result -> fetch_assoc()) {
            $companyID = $row['companyID'];
            $companyName = $row["name"];
            $phone = $row["phoneNumber"];
            $unitStreet = $row["unitStreetNum"];
            $addressLn1 = $row['Address1'];
            $addressLn2 = $row['Address2'];
            $city = $row['City'];
            $zip = $row['Zip'];
            $state = $row['State'];
            $country = $row['Country'];
        }
    }}

?>

<form id="detailsDisplay" class="form form--details">
    <fieldset class="form__fieldset">
        <legend class="form__legend">Details</legend>
        <label class="form__label">Company Name: </label><?php echo $companyName; ?>
        <br>
        <label class="form__label">Phone Number: </label>+<?php echo $phone; ?>
        <br>
        <label class="form__label">Unit/Street Number: </label><?php echo $unitStreet; ?>
        <br>
        <label class="form__label">Address Line 1: </label><?php echo $addressLn1; ?>
        <br>
        <label class="form__label">Address Line 2: </label><?php echo $addressLn2; ?>
        <br>
        <label class="form__label">State: </label><?php echo $state; ?>
        <br>
        <label class="form__label">Zip/Post Code: </label><?php echo $zip; ?>
        <br>
        <label class="form__label">Country: </label><?php echo $country; ?>
    </fieldset>
</form>

<?php }?>

<?php 
    if (isset($_POST['form__submitInput'])){
        $companyID = secure($_POST['companyID']);
        $fields = [
            'name' => isset($_POST['companyName']) ? secure($_POST['companyName']) : null,
            'unitStreetNum' => isset($_POST['unitStreetNumber']) ? secure($_POST['unitStreetNumber']) : null,
            'Address1' => isset($_POST['addressLine1']) ? secure($_POST['addressLine1']) : null,
            'Address2' => isset($_POST['addressLine2']) ? secure($_POST['addressLine2']) : null,
            'Country' => isset($_POST['countrySelect']) ? secure($_POST['countrySelect']) : null,
            'City' => isset($_POST['city']) ? secure($_POST['city']) : null,
            'Zip' => isset($_POST['zip']) ? secure($_POST['zip']) : null,
            'State' => isset($_POST['state']) ? secure($_POST['state']) : null,
            'phoneNumber' => isset($_POST['companyPhone']) ? secure($_POST['companyPhone']) : null,
        ];
        // Prepare the update statement
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
        $update_sql = "UPDATE companies SET " . implode(", ", $update_fields) . " WHERE companyID = ?";
        
        $update_params[] = $companyID; // Adding company_id to the parameters list
        $types .= 'i'; // Adding the type for company_id
        

        $stmt = $conn->prepare($update_sql);
        if ($stmt === false) {
            die("Prepare failed: " . $conn->error);
        }

        $stmt->bind_param($types, ...$update_params);

        if ($stmt->execute()) {
            echo "Company updated successfully";
        } else {
            echo "Error updating Company: " . $stmt->error;
        }

        $stmt->close();
    } else {
        echo "No fields to update";
    } 
}
?>

<form id="modify" method="POST" class="form form--fill">
    <fieldset class="form__fieldset">
        <legend class="form__legend">Manage Company Details</legend>
        Only fill in what needs to be updated.
        <br>
        <input type="hidden" name="companyID" value="<?php echo htmlspecialchars($companyID); ?>">
        <label for="companyName" class="form__label">Company Name: </label>
        <input type='text' id='companyName' class='form__textInput' name='companyName'>
        <br>
        <label for="unitStreetNumber" class="form__label">Unit/Street Number:</label>
        <input type="text" id="unitStreetNumber" class="form__textNum" name="unitStreetNumber" >
        <br>
        <label for="addressLine1" class="form__label">Address Line 1:</label>
        <input type="text" id="addressLine1" class="form__textInput" name="addressLine1" >
        <br>
        <label for="addressLine2" class="form__label">Address Line 2:</label>
        <input type="text" id="addressLine2" class="form__textInput" name="addressLine2">
        <br>
        <label for="countrySelect" class="form__label">Country:</label>
        <select name="countrySelect" id="countries" data-palceholder="Select Country" class="form__select" >
        <?php 
            include "countryList.php";
        ?>
        </select>
        <p></p>
        <label for="city" class="form__label">City:</label>
        <input type="text" id="city" class="form__textInput" name="city" >
        <br>
        <label for="zip" class="form__label">Zip/Post Code:</label>
        <input type="text" id="zip" class="form__textNum" name="zip">
        <br>
        <label for="state" class="form__label">State:</label>
        <input type="text" id="state" class="form__textInput" name="state">
        <br>
        <label for="companyPhone" class="form__label">Contact Nmber:</label>
        <input type="tel" name="companyPhone" id="companyPhone" class="form__telInput" placeholder="(64)1235846" >
        <br>
        <input name="form__submitInput" type="submit" value="Update Details" class="form__submitInput">
    </fieldset>
    </form>
    <script src="./chosenLib/chosen.jquery.js" type="text/javascript"></script>
    <script>
        $("#countries").chosen({no_results_text: "Oops, nothing found!"});
        $("#companies").chosen({no_results_text: "Oops, nothing found!"});
    </script>