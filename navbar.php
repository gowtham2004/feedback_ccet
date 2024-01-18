<?php
function isActive($page)
{
    $currentPage = basename($_SERVER['PHP_SELF']);
    return ($currentPage === $page) ? 'active' : '';
}
?>
<nav class="navbar fixed-top navbar-expand-lg bg-body-tertiary">
    <div class="container-fluid">
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarTogglerDemo01"
            aria-controls="navbarTogglerDemo01" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarTogglerDemo01">
            <a class="navbar-brand" href="./">
                <img src="https://www.chettinadtech.ac.in/assets/images/CCET_Logo.png" alt="Chettinad CET">
            </a>

            <?php
                if(isset($_SESSION["faculty_id"])){
            ?>

            <ul class="ms-3 navbar-nav me-auto mb-2 mb-lg-0">
                <li class="ms-3 nav-item">
                    <a class="nav-link <?php echo isActive('index.php');?>"  aria-current="page" href="index.php">Home</a>
                </li>
                <li class="ms-3 nav-item">
                    <a class="nav-link <?php echo isActive('report.php');?>"  href="report.php">Report</a>
                </li>
            </ul>
            <div class="d-flex">
                <span class="navbar-text me-3">
                    <?php echo "Welcome " . $_SESSION["name"] . "!!"; ?>
                </span>
                <a href="logout.php" class="btn btn-danger"><i class="fa fa-sign-out"></i> LogOut</a>
            </div>
            <?php } ?>
        </div>
    </div>
</nav>