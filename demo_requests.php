<!DOCTYPE html>
<html lang="en">
<?php 
    include "includes/head.php";
    checkInternalSession();
?>

<body>
    <?php
        include "includes/headernav.php";
        include "includes/nav.php";
        echo"<div class='content'>
        <div class='content__wrapper content__wrapper--form'>";
        include "includes/demorequestcontact.php";
        include "includes/demorequestmakecontact.php";
        echo"</div></div>";
    ?>

</body>

<?php
include "includes/footer.php";
?>
</html>