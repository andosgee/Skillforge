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
    ?>
    <div id="manageCompany" class="content">
        <div class="content__wrapper content__wrapper--form">
            <?php include "includes/manageuserform.php";
            include "includes/editusersform.php";
            include "includes/changepassword.php";?>
        </div>
    </div>

</body>

<?php
include "includes/footer.php";
?>
</html>