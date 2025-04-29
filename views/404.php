<?php
    $name = "404";
    session_start();
	include "/membri/recipie/controllers/404.php";
    ob_start();
?>

<div class="vh-75 d-flex justify-content-center">
    <div class="card shadow align-self-center">
        <div class="card-body">
            <h1 class="display-1">Oh nooo D:</h1>
            <p>We coudn't find the page you were looking for.</p>
            <div class="d-flex justify-content-end">
                <button class="btn btn-primary text-end" onclick="window.location.href='home.php'">Back to Home.</button>
            </div>
        </div>
    </div>
</div>

<?php
    $content = ob_get_clean();
    require "template.php";
?>
