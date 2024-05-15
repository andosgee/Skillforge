<?php 
    if (isset($_SESSION["internalLevel"])) {
        echo"
            <nav class='navigation'>
                <a href='./internal_dashboard.php' class='navigation__link'>Dashboard</a>
                <a href='./add_company.php' class='navigation__link'>Add Company</a>
                <a href='./manage_companies.php' class='navigation__link'>Manage Companies</a>
                <a href='./demo_requests.php' class='navigation__link'>Demo Requests</a>
                <a href='./contact_requests.php' class='navigation__link'>Contact Requests</a>
                <a href='./manage_internal_users.php' class='navigation__link'>Manage Users</a>
            </nav>
        ";
    }
?>