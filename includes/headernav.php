<header class="header">
    <img class="header__logo" src="assets/image/logo/SkillForge.svg" alt="Skillforge Logo">
    <h1 class="header__h1">SKILLFORGE | Crafting Skills & Forging Success</h1>
    <?php 
        $pageName = getPageTitle();
        if($pageName == "Home") {
            echo"<a class='header__link' href='login.php'>Login</a>";
        }elseif($pageName =="Login" or $pageName == "Staff Login") {
            echo "<a class='header__link' href='index.php'>Home</a>";
        // }elseif($pageName =="Staff Login"){
        //     echo "<a class='header__link' href='index.php'>Home</a>";
        }else{
            echo "<a class='header__link' href='logout.php'>Logout</a>";
        }
    ?>
</header>
<nav class="navigation">
    <a href="#about" class="navigation__link">About Us</a>
    <a href="#contact" class="navigation__link">Contact Us</a>
    <a href="#request" class="navigation__link">Request a Demo</a>
</nav>