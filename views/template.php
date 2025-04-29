<!DOCTYPE html>

<html lang="en">
    <?php require_once "head.php" ?>
    
    <body>
        <nav class="navbar navbar-expand-sm navbar-dark bg-secondary shadow d-none d-sm-block">
            <div class="container-fluid">
                <a class="navbar-brand" href="home.php">
                    <img src="../images/icon.svg" style="width: 20px">
                    Reciπ
                </a>
                <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
                    <span class="navbar-toggler-icon"></span>
                </button>
                <div class="collapse navbar-collapse" id="navbarSupportedContent">
                    <ul class="navbar-nav me-auto mb-2 mb-lg-0">
                        <li class="nav-item">
                            <a class="nav-link <?php if($name === "home") echo "active" ?>" href="home.php">
                                <img src="../images/house-fill.svg" style="filter: invert(100%)">
                                Home
                            </a>
                        </li>
                        <?php if($_SESSION["user"] == null): ?>
                            <li class="nav-item">
                                <a class="nav-link" href="login.php">
                                    <img src="../images/person-fill.svg" style="filter: invert(100%)">
                                    Login
                                </a>
                            </li>
                        <?php else: ?>
                            <li class="nav-item">
                                <a class="nav-link <?php if($name === "bookmarks") echo "active" ?>" href="bookmarks.php">
                                    <img src="../images/bookmark-fill.svg" style="filter: invert(100%)">
                                    Bookmarks
                                </a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" href="createRecipe.php">
                                    <img src="../images/plus-lg.svg" style="filter: invert(100%)">
                                    Create Recipe
                                </a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link <?php if($name === "user" && $currentUser) echo "active" ?>" href=<?php echo "user.php?id=".$_SESSION["user"]["id"]; ?>>
                                    <img src="../images/person-fill.svg" style="filter: invert(100%)">
                                    Account
                                </a>
                            </li>
                        <?php endif ?>
                    </ul>
                    <div class="d-flex">
                        <div class="nav-item dropdown">
                            <a class="text-white text-decoration-none" data-bs-toggle="dropdown">
                                Theme
                                <img src="../images/highlights.svg" style="width: 20px; filter: invert(100%)">
                            </a>

                            <ul class="dropdown-menu dropdown-menu-end">
                                <li><a class="dropdown-item theme-dropdown-item default-dropdown-item" data-selection="default">Device Default</a></li>
                                <li><a class="dropdown-item theme-dropdown-item light-dropdown-item" data-selection="light">Light</a></li>
                                <li><a class="dropdown-item theme-dropdown-item dark-dropdown-item" data-selection="dark">Dark</a></li>
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
        </nav>

        <div class="container pt-3" style="padding-bottom: 80px">
            <?php echo $content ?>
        </div>

        <nav class="d-sm-none bg-secondary fixed-bottom shadow-lg">
            <div class="d-flex justify-content-around align-items-center text-white py-2">
                <a class="text-white text-center <?php if($name !== "home") echo "text-decoration-none" ?>" href="home.php">
                    <img src="../images/house-fill.svg" style="width: 20px; filter: invert(100%)"><br>
                    Home
                </a>
                <?php if($_SESSION["user"] == null): ?>
                    <a class="text-white text-center text-decoration-none" href="login.php">
                        <img src="../images/person-fill.svg" style="width: 20px; filter: invert(100%)"><br>
                        Login
                    </a>
                <?php else: ?>
                    <a class="text-white text-center <?php if($name !== "bookmarks") echo "text-decoration-none" ?>" href="bookmarks.php">
                        <img src="../images/bookmark-fill.svg" style="width: 20px; filter: invert(100%)"><br>
                        Bookmarks
                    </a>
                    <a class="text-white text-center text-decoration-none" href="createRecipe.php">
                        <img src="../images/plus-lg.svg" style="width: 20px; filter: invert(100%)"><br>
                        Create Recipe
                    </a>
                    <a class="text-white text-center <?php if($name !== "user" || !$currentUser) echo "text-decoration-none" ?>" href="user.php?id=<?php echo $_SESSION["user"]["id"]; ?>">
                        <img src="../images/person-fill.svg" style="width: 20px; filter: invert(100%)"><br>
                        Account
                    </a>
                <?php endif ?>
                <div class="text-center">
                    <a class="text-white text-decoration-none" data-bs-toggle="dropdown">
                        <img src="../images/highlights.svg" style="width: 20px; filter: invert(100%)"><br>
                        Theme
                    </a>

                    <ul class="dropdown-menu">
                        <li><a class="dropdown-item theme-dropdown-item default-dropdown-item" data-selection="default">Device Default</a></li>
                        <li><a class="dropdown-item theme-dropdown-item light-dropdown-item" data-selection="light">Light</a></li>
                        <li><a class="dropdown-item theme-dropdown-item dark-dropdown-item" data-selection="dark">Dark</a></li>
                    </ul>
                </div>
            </div>
        </nav>
    </body>
</html>
