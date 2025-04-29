<?php 
    $name = "bookmarks";
    session_start(); 
    require "/membri/recipie/controllers/bookmarks.php";
?>

<h1 class="display-1">Bookmarks</h1>
<?php if(!empty($bookmarks)): foreach($bookmarks as $bookmark): ?>
    <a href="recipe.php?id=<?php echo $bookmark["recipeId"] ?>" class="text-decoration-none">
        <div class="card shadow mb-3">
            <div class="card-body">
                <h5 class="card-title"><?php echo $bookmark["recipeName"] ?></h5>
                <h6 class="card-subtitle mb-2 text-muted "><?php echo $bookmark["portions"] ?> Portions</h6>
            </div>
        </div>
    </a>
<? endforeach; else: ?>
    <p>You don't have any bookmarked recipes.</p>
    <a href="index.php">Find some recipes to bookmark.</a>
<? endif ?>

<?php
    $content = ob_get_clean();
    require "template.php";
?>
