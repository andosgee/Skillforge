<!DOCTYPE html>
<html lang="en">
<?php 
    include "includes/head.php";
    checkSession();
?>

<body>
    <?php
        include "includes/headernav.php";
        include "includes/userNav.php";
    ?>
    <div class="content">
        <div class="content__wrapper content__wrapper--form">
            <?php
                include "includes/managecompanyuserform.php";
                include "includes/editcompanyusersform.php";
            ?>
        </div>
    </div>

</body>

<?php
include "includes/footer.php";
?>
</html>