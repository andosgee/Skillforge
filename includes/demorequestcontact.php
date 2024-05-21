<form id="id" method="GET" class="form form--details">
    <fieldset class="form__fieldset">
        <legend class="form__legend">Select Demo Request</legend>
        <select name="demoSelect" id="demoRequests" data-palceholder="Select Contact" class="form__select" onchange="populateFormByID(this.value, './includes/demorequestmakecontact.php')">
            <option value="0">Select an option...</option>
            <?php
            $sqlGetRequests = 'SELECT * FROM `requestdemo` ORDER BY `contacted` ASC';
            $demoList = $conn->query($sqlGetRequests);
            while ($row = $demoList->fetch_assoc()) {
            echo "<option value='{$row['requestID']}'>{$row['firstName']} {$row['lastName']} | {$row['company']}</option>";
            }
            ?>
        </select>
    </fieldset> 
</form>
