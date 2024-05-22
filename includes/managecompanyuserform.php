<form id="id" method="GET" class="form form--details">
    <fieldset class="form__fieldset">
        <legend class="form__legend">Select User</legend>
        <select name="userSelect" id="users" data-palceholder="Select Company" class="form__select" onchange="populateFormByID(this.value, './includes/editcompanyusersform.php')">
            <option value="">---</option>
            <?php
            $sqlGetUsers = "SELECT * FROM `userData` WHERE `companyID` = '{$_SESSION['companyID']}'";
            $userList = $conn->query($sqlGetUsers);
            while ($row = $userList->fetch_assoc()) {
            echo "<option value='{$row['userID']}'>{$row['firstName']} {$row['lastName']}</option>";
            }
            ?>
        </select>
    </fieldset> 
</form>