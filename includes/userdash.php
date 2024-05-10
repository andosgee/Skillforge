<div id="userDashboard" class="content">
    <?PHP 
        echo "<h1 class='content__h1'>User Dashboard - What would you like to do {$_SESSION['firstName']}?</h1>";
    ?>
    <div class="content_wrapper">
        <div class="content__tiles">
            <div class="content__tiles__item">
                My Details
                <br>
                Modify your details here.
            </div>
            <div class="content__tiles__item">
                My Module History
                <br>
                View your completed modules here.
            </div>
            <div class="content__tiles__item">
                Required Modules
                <br>
                You have X modules that need to be completed.
            </div>
            <div class="content__tiles__item">
                Module Search
                <br>
                Search for a Module to complete here.
            </div>
        </div>
    </div>
</div>