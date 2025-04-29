<?php
    $name = "home";
    session_start();
	include "/membri/recipie/controllers/home.php";
    ob_start();
?>

<form method="GET" action="home.php">
    <div class="input-group shadow mb-3">
        <input type="text" name="search" class="form-control" placeholder="Search for something...">
        <select name="searchFor" class="form-select">
            <option value="recipe" <?php echo ($searchFor === "recipe")? "selected": "" ?>>Recipe</option>
            <option value="user" <?php echo ($searchFor === "user")? "selected": "" ?>>User</option>
        </select>
        <button type="button" class="btn btn-secondary" id="filtersButton" style="filter: invert()" data-bs-toggle="modal" data-bs-target=
            "#<?php echo $searchFor ?? "recipe" ?>FiltersModal"
        >
            <img src="../images/funnel-fill.svg">
        </button>
        <button type="submit" class="btn btn-primary">
            <img src="../images/search.svg" style="filter: invert()">
            Search
        </button>
    </div>

    <div class="modal fade" id="recipeFiltersModal" tabindex="-1">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-body">
                    <label for="orderRecipeBy" class="form-label">Order By</label>
                    <select name="orderRecipeBy" class="form-select mb-2">
                        <option value="name" <?php echo ($orderRecipeBy === "name")? "selected": "" ?>>Name</option>
                        <option value="portions" <?php echo ($orderRecipeBy === "username")? "selected": "" ?>>Author Name</option>
                    </select>
                    <div class="form-check">
                        <input type="checkbox" name="recipeDesc" class="form-check-input" <?php echo ($recipeDesc)? "checked": "" ?>>
                        <label for="recipeDesc" class="form-label">Descending</label>
                    </div>
                    <label for="includeIngredients[]" class="form-label">Incude Ingredients</label>
                    <button type="button" class="btn btn-secondary shadow ingredient-deselect-button" data-name="includeIngredients[]">Clear Selection</button>
                    <select name="includeIngredients[]" class="form-select my-2 ingredient-select" multiple>
                        <?php foreach(loadIngredients() as $ingredient): ?>
                            <option 
                                value="<?php echo $ingredient["id"] ?>" 
                                <?php if(in_array($ingredient["id"], $includeIngredients)) echo "selected " ?>
                                <?php if(in_array($ingredient["id"], $excludeAllergens)) echo "disabled " ?>
                            >
                                <?php echo ucwords(strtolower($ingredient["name"])) ?>
                            </option>
                        <?php endforeach ?>
                    </select>
                    
                    <label for="excludeIngredients[]" class="form-label">Exclude Ingredients</label>
                    <button type="button" class="btn btn-secondary shadow ingredient-deselect-button" data-name="excludeIngredients[]">Clear Selection</button>
                    <select name="excludeIngredients[]" class="form-select my-2 ingredient-select" multiple>
                        <?php foreach(loadIngredients() as $ingredient): ?>
                            <option 
                                value="<?php echo $ingredient["id"] ?>" 
                                <?php if(in_array($ingredient["id"], $excludeAllergens)) echo "selected " ?>
                                <?php if(in_array($ingredient["id"], $includeIngredients)) echo "disabled " ?>
                            >
                                <?php echo ucwords(strtolower($ingredient["name"])) ?>
                            </option>
                        <?php endforeach ?>
                    </select>

                    <label for="excludeAllergens[]" class="form-label">Exclude Allergens</label>
                    <select name="excludeAllergens[]" class="form-select my-2" multiple>
                        <?php foreach(loadAllergens() as $allergen): ?>
                            <option 
                                value="<?php echo $allergen["id"] ?>" 
                                <?php if(in_array($allergen["id"], $excludeAllergens)) echo "selected" ?>
                            >
                                <?php echo ucwords(strtolower($allergen["name"])) ?>
                            </option>
                        <?php endforeach ?>
                    </select>
                </div>
                <div class="modal-footer">
                    <button type="submit" class="btn btn-primary shadow">Confirm</button>
                </div>
            </div> 
        </div>
    </div>

    <div class="modal fade" id="userFiltersModal" tabindex="-1">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-body">
                    <label for="orderUserBy" class="form-label">Order By</label>
                    <select name="orderUserBy" class="form-select mb-2">
                        <option value="username" <?php echo ($_GET["orderUserBy"] === "username")? "selected": "" ?>>Name</option>
                        <option value="recipeNumber" <?php echo ($_GET["orderUserBy"] === "recipeNumber")? "selected": "" ?>>Recipe Number</option>
                    </select>
                    <div class="form-check">
                        <input type="checkbox" name="userDesc" class="form-check-input" <?php echo ($_GET["userDesc"] != null)? "checked": "" ?>>
                        <label for="userDesc" class="form-label">Descending</label>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="submit" class="btn btn-primary shadow">Confirm</button>
                </div>
            </div> 
        </div>
    </div>
</form>

<?php if($searchFor === "recipe"): ?>
    <?php 
        $recipes = loadRecipes();
        if($recipes != null): foreach($recipes as $recipe):   
    ?>
        <a href="recipe.php?id=<?php echo $recipe["id"] ?>" class="text-decoration-none text-body">
            <div class="card shadow mb-3">
                <div class="card-body">
                    <h5 class="card-title"><?php echo $recipe["name"] ?></h5>
                    <h6 class="card-subtitle mb-2 text-muted">
                        <span>Made by</span> 
                        <a href="user.php?id=<?php echo $recipe["userId"] ?>">
                            <?php echo ($_SESSION["user"]["id"] == $recipe["userId"])? "You :D": ucwords(strtolower(string: $recipe["username"])) ?>
                        </a>
                    </h6>
                    <h6 class="card-subtitle mb-2 text-muted"><?php echo $recipe["portions"] ?> Portions</h6>
                </div>
            </div>
        </a>
    <?php endforeach; else: ?>
        <p>No recipes found.</p>
    <?php endif ?>
<?php else: ?>
    <?php 
        $users = loadUsers();
        if($users != null): foreach($users as $user):   
    ?>
        <a href="user.php?id=<?php echo $user["id"] ?>" class="text-decoration-none">
            <div class="card shadow mb-3">
                <div class="card-body">
                    <h5 class="card-title">
                        <?php echo ($_SESSION["user"]["id"] == $user["id"])? "You :D": ucwords(strtolower(string: $user["username"])) ?>
                    </h5>
                    <h6 class="card-subtitle mb-2 text-muted"><?php echo $user["recipeNumber"]." Recipe".(($user["recipeNumber"] == 1)? "": "s") ?></h6>
                </div>
            </div>
        </a>
    <?php endforeach; else: ?>
        <p>No users found.</p>
    <?php endif ?>
<?php endif ?>

<script>
    $("[name='searchFor']").change(function() {
        const value = $(this).val();
        $("#filtersButton").attr("data-bs-target", `#${value}FiltersModal`);
    });

    $(".ingredient-select").on("change", function() {
        let selected = [];
        $(".ingredient-select").each(function() {
            $(this).find("option:selected").each(function() {
                selected.push($(this).val());
            });
        });

        $(".ingredient-select").each(function() {
            let currentSelect = $(this);
            
            currentSelect.find("option").each(function() {
                let option = $(this);
                let optionValue = option.val();

                if(selected.includes(optionValue) && !option.is(":selected")) {
                    option.prop("disabled", true);
                } else {
                    option.prop("disabled", false);
                }
            });
        });
    });

    $(".ingredient-deselect-button").on("click", function() {
        const selectName = $(this).data("name"); 
        const select = $("select[name='" + selectName + "']");
        select.find("option").prop("selected", false);
        select.trigger("change");    
    });
</script>
<?php
    $content = ob_get_clean();
    require "template.php";
?>

