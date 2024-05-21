
<form id="id" method="GET" class="form form--details">
    <fieldset class="form__fieldset">
        <legend class="form__legend">Select Company</legend>
        <!-- <select name="companySelect" id="companies" class="form__select" onchange="populateFormByID(this.value)"> -->
        <select name="companySelect" id="companies" data-palceholder="Select Company" class="form__select" onchange="populateFormByID(this.value, './includes/editcompanyform.php')">
            <option value="0">Select an option..</option>
            <?php
            $sqlGetCompanies = 'SELECT * FROM `companies`';
            $companyList = $conn->query($sqlGetCompanies);
            while ($row = $companyList->fetch_assoc()) {
            echo "<option value='{$row['companyID']}'>{$row['name']}</option>";
            }
            ?>
        </select>
    </fieldset> 
</form>