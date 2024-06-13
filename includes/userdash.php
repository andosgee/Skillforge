<div id="userDashboard" class="content">
    <?PHP 
        echo "<h1 class='content__h1'>User Dashboard - What would you like to do {$_SESSION['firstName']}?</h1>";
    ?>
    <div class="content__wrapper">
        <div class="content__tiles">
            <a href="./my_details.php" class="content__tiles__item">
                <h2>My Details</h2>
                Modify your details here.
                <p></p>
                <img class="content__tiles__item__image" src="./assets/image/logo/mydetails.svg" alt="My details icon.">
            </a>
            <a href="./module_History.php" class="content__tiles__item">
               <h2>My Module History</h2>
                View your completed modules here.
                <p></p>
                <img class="content__tiles__item__image" src="./assets/image/logo/modulehistory.svg" alt="Completed modules icon.">
            </a>
            <a href="./sample.php" class="content__tiles__item">
                <h2>Required Modules</h2>
                You have X modules that need to be completed.
                <p></p>
                <img class="content__tiles__item__image" src="./assets/image/logo/requiredmodules.svg" alt="Required Modules icon.">
            </a>
            <a href="./search_modules.php" class="content__tiles__item">
                <h2>Module Search</h2>
                Search for a Module to complete here.
                <p></p>
                <img class="content__tiles__item__image" src="./assets/image/logo/searchmodules.svg" alt="Module Search icon.">
            </a>
            <?php 
                $sqlGetAdmin = "SELECT ul.levelName
                FROM userdata ud
                INNER JOIN userlevel ul ON ud.level = ul.levelID
                WHERE ud.userID = '{$_SESSION['userID']}'
                AND ud.companyID = ul.companyID";          
                $result = $conn -> query( $sqlGetAdmin );
                if ($result && $result->num_rows > 0) {
                    // Fetch the result row
                    $row = $result->fetch_assoc();
                    // Extract the levelName
                    $levelName = $row['levelName'];
                    if ($levelName == 'Admin') {
                        echo "<a href='./reports.php' class='content__tiles__item'>
                        <h2>Reports</h2>
                        Generate Reports.
                        <p></p>
                        <img class='content__tiles__item__image' src='./assets/image/logo/generatereports.svg' alt='Reports icon.'>
                    </a>
                    <a href='./sample.php' class='content__tiles__item'>
                        <h2>Edit Module</h2>
                        Select a Module to Edit.
                        <p></p>
                        <img class='content__tiles__item__image' src='./assets/image/logo/editmodules.svg' alt='Edit Modules icon.'>
                    </a>
                    <a href='./sample.php' class='content__tiles__item'>
                        <h2>Assign Module</h2>
                        Select a Module to Assign.
                        <p></p>
                        <img class='content__tiles__item__image' src='./assets/image/logo/assignmodules.svg' alt='Assign Modules icon.'>
                    </a>
                    <a href='./create_module.php' class='content__tiles__item'>
                        <h2>Create Module</h2>
                        Create a module.
                        <p></p>
                        <img class='content__tiles__item__image' src='./assets/image/logo/createmodule.svg' alt='Create Modules icon.'>
                    </a>
                    <a href='./manage_company_users.php' class='content__tiles__item'>
                        <h2>Manage Users</h2>
                        Create and manage users.
                        <p></p>
                        <img class='content__tiles__item__image' src='./assets/image/logo/manageusers.svg' alt='Manage Users icon.'>
                    </a>";
                    }
                }
            ?>
        </div>
    </div>
</div>