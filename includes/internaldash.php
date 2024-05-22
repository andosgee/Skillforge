<div id="internalDash" class="content">
    <?PHP 
        echo "<h1 class='content__h1'>Internal Dashboard - What would you like to do {$_SESSION['firstName']}?</h1>";
    ?>
    <div class="content__wrapper">
        <div class="content__tiles">
            <a href="./add_company.php" class="content__tiles__item">
                <h2>Add Company</h2>
                Add a new company here as well as the dedicated administrator.
                <p></p>
                <img class='content__tiles__item__image' src="./assets/image/logo/addcompany.svg" alt="Add Company Icon">
            </a>
            <a href="./manage_companies.php" class="content__tiles__item">
                <h2>Manage Companies</h2>
                Manage an existing company here.
                <p></p>
                <img class='content__tiles__item__image' src="./assets/image/logo/managecompany.svg" alt="Manage Company Icon">
            </a>
            <a href="./demo_requests.php" class="content__tiles__item">
                <h2>Demo Requests</h2>
                View the demonstration requests here.
                <p></p>
                <img class='content__tiles__item__image' src="./assets/image/logo/demorequest.svg" alt="Demo Requests Icon">
            </a>
            <a href="./manage_users.php" class="content__tiles__item">
                <h2>Manage Internal Users</h2>
                Manage the internal users of Skillforge.
                <p></p>
                <img class='content__tiles__item__image' src="./assets/image/logo/manageusers.svg" alt="Manage Internal Users Icon">
            </a>
        </div>
    </div>
</div>
