<nav class="navbar navbar-expand-sm navbar-dark bg-secondary shadow">
    <div class="container-fluid">
        <a class="navbar-brand" href="index.php">
            <img src="../images/icon.svg" style="width: 20px">
            Reciπ
        </a>
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbar">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbar">
            <div class="navbar-nav">
                <a class="nav-link" href="index.php">
                    <img src="../images/house-fill.svg" style="filter: invert(100%)">
                    Home
                </a>
                <?php
                    if($_SESSION["user"] == null) {
                        require_once "guestNavbar.php";
                    } else {
                        require_once "loggedNavbar.php";
                    }
                ?>
            </div>
        </div>
    </div>
</nav>