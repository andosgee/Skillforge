<form id="id" method="GET" class="form form--details">
    <fieldset class="form__fieldset">
        <legend class="form__legend">Select User</legend>
        <select name="userSelect" id="users" data-palceholder="Select Company" class="form__select" onchange="populateFormByID(this.value, './includes/editusersform.php')">
            <option value="OwnUser">Myself</option>
            <?php
            $sqlGetUsers = 'SELECT * FROM `internallogin`';
            $userList = $conn->query($sqlGetUsers);
            while ($row = $userList->fetch_assoc()) {
            echo "<option value='{$row['internalID']}'>{$row['firstName']} {$row['lastName']}</option>";
            }
            ?>
        </select>
    </fieldset> 
</form>