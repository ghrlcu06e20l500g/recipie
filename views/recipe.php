<?php
    $name = "recipe";
    session_start();
	include "/membri/recipie/controllers/recipe.php";
    ob_start();
?>

<h1 class="display-1"><?php echo ucwords(strtolower($recipe["name"])) ?></h1>
<p class="text-muted">
    <span>Made by</span>
    <a href="user.php?id=<?php echo $recipe["userId"] ?>">
        <?php echo ($currentUser)? "You :D": ucwords(strtolower(string: $recipe["username"])) ?>
    </a>
    <br>
    <span><?php echo $recipe["portions"] ?> portions</span>
</p>

<div class="d-flex">
    <?php if($_SESSION["user"] != null): ?>
        <?php if($bookmarked): ?>
            <form method="POST" action="deleteBookmark.php">
                <input type="hidden" name="recipeId" value="<?php echo $_GET["id"] ?>">
                <button type="submit" class="btn btn-primary shadow me-2" style="white-space: nowrap">
                    <img src="../images/bookmark-fill.svg" style="filter: invert(100%)">
                    <span>Drop Bookmark</span>
                </button>
            </form>
        <?php else: ?>
            <form method="POST" action="createBookmark.php" style="white-space: nowrap">
                <input type="hidden" name="recipeId" value="<?php echo $id ?>">
                <button type="submit" class="btn btn-primary shadow me-2" style="white-space: nowrap">
                    <img src="../images/bookmark.svg" style="filter: invert(100%)">
                    <span>Bookmark</span>
                </button>
            </form>
        <?php endif ?>
    <?php else: ?>
        <button type="submit" class="btn btn-primary shadow me-2" style="white-space: nowrap" onclick="window.location.href = 'login.php'">
            <img src="../images/person-fill.svg" style="filter: invert(100%)">
            <span>Login to Bookmark</span>
        </button>
    <?php endif ?>
    <button class="btn btn-primary shadow me-2" onclick="share()" style="white-space: nowrap">
        <img src="../images/share-fill.svg" style="filter: invert(100%)">
        Share
    </button>
    <?php if($currentUser): ?>
        <button type="button" class="btn btn-primary me-2" data-bs-toggle="modal" data-bs-target="#updateRecipeModal" style="white-space: nowrap">
            <img src="../images/gear-fill.svg" style="filter: invert(100%)">
            <span>Settings</span>
        </button>
    <?php endif ?>
</div>

<h2 class="display-2">Ingredients</h2>
<table class="table table-striped">
    <thead>
        <th>Ingredient</th>
        <th>Quantity</th>
        <th></th>
        <th></th>
    </thead>
    <tbody>
        <?php if($currentUser): ?>
            <?php foreach($recipeIngredients as $recipeIngredient): ?>
                <tr>
                    <form method="POST" action="updateRecipeIngredient.php">
                        <input type="hidden" name="recipeId" value="<?php echo $id ?>">
                        <td>
                            <select required name="ingredientId" class="form-select">
                                <?php foreach(loadIngredients() as $ingredient): ?>
                                    <option 
                                        value="<?php echo $ingredient["id"] ?>"
                                        <?php if($ingredient["name"] === $recipeIngredient["name"]) echo "selected" ?>
                                    >
                                        <?php echo $ingredient["name"] ?>
                                    </option>
                                <?php endforeach ?>
                            </select>
                        </td>
                        <td>
                            <div class="d-flex align-items-center">
                                <div class="form-check mr-2">
                                    <input type="checkbox" name="quantityNull" class="form-check-input quantityCheckboxInput"
                                        <?php if($recipeIngredient["quantity"] == null) echo "checked" ?>
                                        data-row-id="<?php echo $recipeIngredient["recipeId"]."-".$recipeIngredient["ingredientId"] ?>"
                                    >
                                    <label for="quantityNull" class="form-check-label">A.N.</label>
                                </div>
                                <input type="number" min="1" step="1" name="quantity" class="form-control ms-2 quantityNumberInput"
                                    value="<?php echo ($recipeIngredient["quantity"] ?? 0) ?>"
                                    data-row-id="<?php echo $recipeIngredient["recipeId"]."-".$recipeIngredient["ingredientId"] ?>"
                                >
                            </div>
                        </td>
                        <td>
                            <button type="submit" class="btn btn-primary">
                                <img src="../images/pencil-square.svg" style="filter: invert(100%)">
                            </button>
                        </td>
                    </form>
                    <form method="POST" action="deleteRecipeIngredient.php">
                        <input type="hidden" name="recipeId" value=<?php echo $id ?>> 
                        <input type="hidden" name="ingredientId" value=<?php echo $recipeIngredient["id"] ?>> 
                        <td>
                            <button type="submit" class="btn btn-warning">
                                <img src="../images/trash-fill.svg" style="filter: invert(100%)">
                            </button>
                        </td>
                    </form>
                </tr>
            <?php endforeach ?>
            <form method="POST" action="createRecipeIngredient.php">
                <input type="hidden" name="recipeId" value="<?php echo $id ?>">
                <tr>
                    <td>
                        <select required name="ingredientId" class="form-select">
                            <?php foreach(loadIngredients() as $ingredient): ?>
                                <option value="<?php echo $ingredient["id"] ?>">
                                    <?php echo $ingredient["name"] ?>
                                </option>
                            <?php endforeach ?>
                        </select>
                    </td>
                    <td>
                        <div class="d-flex align-items-center">
                            <div class="form-check mr-2">
                                <input type="checkbox" name="quantityNull" class="form-check-input quantityCheckboxInput" data-row-id="new">
                                <label for="quantityNull" class="form-check-label">A.N.</label>
                            </div>
                            <input type="number" min="1" step="1" value="1" name="quantity" class="form-control ms-2 quantityNumberInput" data-row-id="new">
                        </div>
                    </td>
                    <td>
                        <button type="submit" class="btn btn-primary">
                            <img src="../images/plus-lg.svg" style="filter: invert(100%)">
                        </button>
                    </td>
                    <td></td>
                </tr>
            </form>
        <?php else: ?>
            <?php foreach($recipeIngredients as $ingredient): ?>
                <tr>
                    <td><?php echo $ingredient["name"] ?></td>
                    <?php if($ingredient["quantity"]): ?>
                        <td><?php echo $ingredient["quantity"].suffix($ingredient["measurementType"]) ?></td>
                    <?php else: ?>
                        <td>As Needed</td>
                    <?php endif ?>
                    <td></td>
                    <td></td>
                </tr>
            <?php endforeach ?>
        <?php endif ?>
    </tbody>
</table>

<h2 class="display-2">Containers</h2>
<?php if($currentUser): ?>
    <table class="table table-striped">
        <thead>
            <th class="w-25">Type</th>
            <th>Capacity</th>
            <th>Name</th>
            <th></th>
            <th></th>
        </thead>
        <tbody>
            <?php foreach($recipeContainers as $container): ?>
                <tr>
                    <form method="POST" action="updateContainer.php">
                        <input type="hidden" name="id" value="<?php echo $container["id"] ?>">
                        <td>
                            <select required name="type" class="form-select">
                                <option value="BOWL" <?php if($container["type"] == "BOWL") echo "selected" ?>>Bowl</option>
                                <option value="PAN" <?php if($container["type"] == "PAN") echo "selected" ?>>Pan</option>
                                <option value="POT" <?php if($container["type"] == "POT") echo "selected" ?>>Pot</option>
                            </select>
                        </td>
                        <td>
                            <div class="input-group">
                                <input required type="number" min="1" step="1" name="capacity" value="<?php echo $container["capacity"] ?>" class="form-control">
                                <span class="input-group-text" id="basic-addon1">ml</span>
                            </div>
                        </td>
                        <td><input required type="text" name="name" value="<?php echo $container["name"] ?>" class="form-control"></td>
                        <td>
                            <button type="submit" class="btn btn-primary">
                                <img src="../images/pencil-square.svg" style="filter: invert(100%)">
                            </button>
                        </td>
                    </form>
                    <form method="POST" action="deleteContainer.php">
                        <input type="hidden" name="id" value="<?php echo $container["id"] ?>">
                        <td>
                            <button type="submit" class="btn btn-warning">
                                <img src="../images/trash-fill.svg" style="filter: invert(100%)">
                            </button>
                        </td>
                    </form>
                </tr>
            <?php endforeach ?>
            <tr>
                <form method="POST" action="createContainer.php">
                    <input type="hidden" name="recipeId" value="<?php echo $id ?>">
                    <td>
                        <select required name="type" class="form-select">
                            <option value="BOWL">Bowl</option>
                            <option value="PAN">Pan</option>
                            <option value="POT">Pot</option>
                        </select>
                    </td>
                    <td>
                        <div class="input-group">
                            <input required type="number" min="1" step="1" name="capacity" class="form-control">
                            <span class="input-group-text" id="basic-addon1">ml</span>
                        </div>
                    </td>
                    <td><input required type="text" name="name" class="form-control"></td>
                    <td>
                        <button type="submit" class="btn btn-primary">
                            <img src="../images/plus-lg.svg" style="filter: invert(100%)">
                        </button>
                    </td>
                    <td></td>
                </form>
            </tr>
        </tbody>
    </table>
<?php else: ?>
    <?php if(!empty($recipeContainers)): ?>
        <table class="table table-striped">
            <thead>
                <th>Type</th>
                <th>Capacity</th>
                <th>Name</th>
                <th></th>
                <th></th>
            </thead>
            <tbody>
                <?php foreach($recipeContainers as $container): ?>
                    <tr>
                        <td><?php echo ucwords(strtolower(string: $container["type"])) ?></td>
                        <td><?php echo $container["capacity"] ?>ml</td>
                        <td><?php echo $container["name"] ?></td>
                        <td></td>
                        <td></td>
                    </tr>
                <?php endforeach ?>
            </tbody>
        </table>
    <?php else: ?>
        <p>This recipe has no containers.</p>
    <?php endif ?>
<?php endif ?>

<h2 class="display-2">Steps</h2>
<?php foreach($recipeSteps as $index => $step): ?>
    <div class="card shadow mb-2">
        <div class="card-body">
            <div class="d-flex align-items-center justify-content-between">
                <p class="card-text text-break">
                    <?php 
                        $result = ($index + 1).". ";

                        if($step["action"] != null) $result .= ucwords(strtolower($step["action"]));
                        if($step["ingredientName"] != null) {
                            if($step["quantity"] != null) {
                                $result .= $step["quantity"].suffix($step["mesurementType"])." of ".ucwords(strtolower($step["ingredientName"]));
                            } else {
                                $result .= " the ".ucwords(strtolower($step["ingredientName"]));
                            }
                        }
                        if($step["containerName"] != null) {
                            $result .= " in \"".$step["containerName"]."\"";
                        }
                        if($step["minutes"] != null) {
                            $result .= " for ".$step["minutes"]." minutes";
                        }

                        if($result === ($index + 1).". ") {
                            $result .= "Do Nothing";
                        }

                        $result .= ".";
                        echo $result;
                    ?>
                </p>
                <?php if($currentUser): ?>
                    <div class="d-flex">
                        <button class="btn btn-primary" style="white-space: nowrap" data-bs-toggle="modal" data-bs-target="#updateStepModal-<?php echo $step["id"] ?>">
                            <img src="../images/pencil-square.svg" style="filter: invert(100%)">
                            <span>Edit</span>
                        </button>
                        <form method="POST" action="deleteStep.php">
                            <input type="hidden" name="id" value="<?php echo $step["id"] ?>">
                            <input type="hidden" name="recipeId" value="<?php echo $id ?>">

                            <button class="btn btn-warning ms-2" style="white-space: nowrap">
                                <img src="../images/trash-fill.svg">
                                <span>Delete</span>
                            </button>
                        </form>
                    </div>
                <?php endif ?>
            </div>
        </div>
    </div>
    <div class="modal fade" id="updateStepModal-<?php echo $step["id"] ?>" tabindex="-1">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h1 class="modal-title fs-5">Edit this Step</h1>
                </div>
                <form method="POST" action="updateStep.php">
                    <div class="modal-body">
                        <input type="hidden" name="id" value="<?php echo $step["id"] ?>">
                        <input type="hidden" name="recipeId" value="<?php echo $id ?>">

                        <label for="action" class="form-label">Action</label>
                        <select name="action" class="form-select">
                            <option value="" <?php if($step["action"] === null) echo "selected" ?>>None</option>
                            <option value="ADD" <?php if($step["action"] === "ADD") echo "selected" ?>>Add</option>
                            <option value="COOK" <?php if($step["action"] === "COOK") echo "selected" ?>>Cook</option>
                            <option value="BAKE" <?php if($step["action"] === "BAKE") echo "selected" ?>>Bake</option>
                            <option value="BOIL" <?php if($step["action"] === "BOIL") echo "selected" ?>>Boil</option>
                            <option value="ROAST" <?php if($step["action"] === "ROAST") echo "selected" ?>>Roast</option>
                            <option value="WHISK" <?php if($step["action"] === "WHISK") echo "selected" ?>>Whisk</option>
                        </select>

                        <label for="recipeIngredientId" class="form-label">Ingredient</label>
                        <select name="recipeIngredientId" class="form-select" id="updateStepIngredientSelect-<?php echo $step["id"] ?>">
                            <option value="" <?php if($step["ingredientName"] == null) echo "selected" ?>>None</option>
                            <?php foreach($recipeIngredients as $ingredient): ?>
                                <option 
                                    value="<?php echo $ingredient["id"] ?>"
                                    data-max-quantity="<?php echo $ingredient["quantity"] ?>"  
                                    data-measurement-type="<?php echo $ingredient["measurementType"] ?>"
                                    <?php if($step["ingredientName"] === $ingredient["name"]) echo "selected" ?>     
                                >
                                    <?php echo ucwords(strtolower($ingredient["name"])) ?>
                                </option>
                            <?php endforeach ?>
                        </select>

                        <div id="updateStepSpecifyQuantityCheckGroup-<?php echo $step["id"] ?>" class="form-check mr-2 mt-2" 
                            style="<?php echo ($step["ingredientName"] == null)? "none": "block" ?>"
                        >
                            <input type="checkbox" name="specifyQuantity" class="form-check-input" 
                                id="updateStepSpecifyQuantityCheckbox-<?php echo $step["id"] ?>" 
                                <?php if($step["quantity"] != null) echo "checked" ?>
                            >
                            <label for="specifyQuantity" class="form-check-label">Specify Quantity</label>
                        </div>

                        <div id="updateStepQuantity-<?php echo $step["id"] ?>" 
                            style="display: <?php echo ($step["quantity"] === null)? "none": "block" ?>"
                        >
                            <label for="quantity">Quantity</label>
                            <div class="input-group">
                                <input type="number" min="1" step="1" name="quantity" class="form-control" value="<?php echo $step["quantity"] ?>">
                                <div class="input-group-text">ml</div>
                            </div>
                        </div>

                        <label for="containerId" class="form-label">Container</label>
                        <select name="containerId" class="form-select">
                            <option value="" <?php if($step["containerName"] == null) echo "selected" ?>>None</option>
                            <?php foreach($recipeContainers as $container): ?>
                                <option 
                                    value="<?php echo $container["id"] ?>"
                                    <?php if($step["containerName"] === $container["name"]) echo "selected" ?>     
                                >
                                    <?php echo ucwords(strtolower($container["name"])) ?>
                                </option>
                            <?php endforeach ?>
                        </select>
                        
                        <div class="form-check mr-2 mt-2">
                            <input type="checkbox" name="specifyMinutes" class="form-check-input"
                                id="updateStepSpecifyMinutesCheckbox-<?php echo $step["id"] ?>"
                                <?php if($step["minutes"] != null) echo "checked" ?>
                            >
                            <label for="specifyMinutes" class="form-check-label">Specify Minutes</label>
                        </div>

                        <div id="updateStepMinutes-<?php echo $step["id"] ?>" 
                            style="display: <?php echo ($step["minutes"] == null)? "none": "block" ?>"
                        >
                            <label for="minutes">Minutes</label>
                            <div class="input-group">
                                <input type="number" min="1" max="314159265" step="1" name="minutes" class="form-control" value="<?php echo $step["minutes"] ?>">
                                <div class="input-group-text">m</div>
                            </div>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary shadow" data-bs-dismiss="modal">Nevermind</button>
                        <button type="submit" class="btn btn-primary shadow">Update</button>
                    </div>
                </form>
            </div>
        </div>
    </div>    
<?php endforeach ?>
<?php if($currentUser): ?>
    <button class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#createStepModal">
        <img src="../images/plus-lg.svg" style="filter: invert(100%)">
        <span>Create Step</span>
    </button>
<? endif ?>
<div class="modal fade" id="createStepModal" tabindex="-1">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h1 class="modal-title fs-5">Create a new Step</h1>
            </div>
            <form method="POST" action="createStep.php">
                <div class="modal-body">
                    <input type="hidden" name="id" value="<?php echo (count($recipeSteps) + 1) ?>">
                    <input type="hidden" name="recipeId" value="<?php echo $id ?>">

                    <label for="action" class="form-label">Action</label>
                    <select name="action" class="form-select">
                        <option value="">None</option>
                        <option value="ADD">Add</option>
                        <option value="COOK">Cook</option>
                        <option value="BAKE">Bake</option>
                        <option value="BOIL">Boil</option>
                        <option value="ROAST">Roast</option>
                        <option value="WHISK">Whisk</option>
                    </select>

                    <label for="recipeIngredientId" class="form-label">Ingredient</label>
                    <select name="recipeIngredientId" class="form-select" id="createStepIngredientSelect">
                        <option value="">None</option>
                        <?php foreach($recipeIngredients as $ingredient): ?>
                            <option 
                                value="<?php echo $ingredient["id"] ?>"
                                data-max-quantity="<?php echo $ingredient["quantity"] ?>"  
                                data-measurement-type="<?php echo $ingredient["measurementType"] ?>"      
                            >
                                <?php echo ucwords(strtolower($ingredient["name"])) ?>
                            </option>
                        <?php endforeach ?>
                    </select>

                    <div id="createStepSpecifyQuantityCheckGroup" class="form-check mr-2 mt-2" style="display: none">
                        <input type="checkbox" name="specifyQuantity" class="form-check-input" id="createStepSpecifyQuantityCheckbox">
                        <label for="specifyQuantity" class="form-check-label">Specify Quantity</label>
                    </div>
                    
                    <div id="createStepQuantity" style="display: none">
                        <label for="quantity">Quantity</label>
                        <div class="input-group">
                            <input type="number" min="1" step="1" name="quantity" class="form-control">
                            <div class="input-group-text">ml</div>
                        </div>
                    </div>

                    <label for="containerId" class="form-label">Container</label>
                    <select name="containerId" class="form-select">
                        <option value="">None</option>
                        <?php foreach($recipeContainers as $container): ?>
                            <option value="<?php echo $container["id"] ?>">
                                <?php echo ucwords(strtolower($container["name"])) ?>
                            </option>
                        <?php endforeach ?>
                    </select>
                    
                    <div class="form-check mr-2 mt-2">
                        <input type="checkbox" name="specifyMinutes" class="form-check-input" id="createStepSpecifyMinutesCheckbox">
                        <label for="specifyMinutes" class="form-check-label">Specify Minutes</label>
                    </div>

                    <div id="createStepMinutes" style="display: none">
                        <label for="minutes">Minutes</label>
                        <div class="input-group">
                            <input type="number" min="1" max="314159265" step="1" name="minutes" class="form-control">
                            <div class="input-group-text">m</div>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary shadow" data-bs-dismiss="modal">Nevermind</button>
                    <button type="submit" class="btn btn-primary shadow">Create</button>
                </div>
            </form>
        </div>
    </div>
</div>

<div class="modal fade" id="updateRecipeModal" tabindex="-1">
    <form method="POST" action="updateRecipe.php">
        <input type="hidden" name="id" value="<?php echo $id ?>">
        <div class="modal-dialog">
            <div class="modal-content">
            <div class="modal-header">
                <h1 class="modal-title fs-5">Recipe Settings</h1>
            </div>
            <div class="modal-body">
                <label for="name" class="form-label">Name</label>
                <input required type="text" maxlength="32" name="name" class="form-control" value="<?php echo $recipe["name"] ?>">
                <label for="portions" class="form-label">Portions</label>
                <input required type="number" min="1" max="314159265" step="1" name="portions" class="form-control" value="<?php echo $recipe["portions"] ?>">
				<button type="button" class="btn btn-danger shadow mt-2" data-bs-toggle="modal" data-bs-target="#deleteRecipeModal" style="white-space: nowrap">
                    <img src="../images/trash-fill.svg" style="filter: invert(100%)">
                    <span>Delete</span>
                </button>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary shadow" data-bs-dismiss="modal">Nevermind</button>
                    <button type="submit" class="btn btn-primary shadow">Update</button>
            </div>
            </div>
        </div>
    </form>
</div>
<div class="modal fade" id="deleteRecipeModal" tabindex="-1">
    <div class="modal-dialog">
        <div class="modal-content">
        <div class="modal-header">
            <h1 class="modal-title fs-5">Want to actually delete this?</h1>
        </div>
        <div class="modal-body">
            You and other people who rely on this recipe will not be able to access it anymore.
        </div>
        <div class="modal-footer">
            <form method="POST" action="deleteRecipe.php">
                <input type="hidden" name="id" value="<?php echo $id ?>">
                <button type="submit" class="btn btn-danger shadow">Delete</button>
            </form>
            <button type="button" class="btn btn-secondary shadow" data-bs-dismiss="modal">Nevermind</button>
        </div>
        </div>
    </div>
</div>

<script>
    const suffix = {
        "QUANTITY": "",
        "WEIGHT": "g",
        "VOLUME": "ml"
    };

    $(document).ready(function () {
        $(".quantityCheckboxInput").each(function() {
            const rowId = $(this).data("row-id");
            if($(this).prop("checked")) {
                $(`.quantityNumberInput[data-row-id="${rowId}"]`).css("visibility", "hidden");
            }
        });
        $(".quantityCheckboxInput").change(function() {
            const rowId = $(this).data("row-id");
            $(`.quantityNumberInput[data-row-id="${rowId}"]`)
                .css("visibility", this.checked? "hidden": "visible");
        });

        // create step modal
            $("#createStepIngredientSelect").change(function() {
                const value = $(this).val();
                const maxQuantity = $(this).find("option:selected").data("max-quantity");
                const measurementType = $(this).find("option:selected").data("measurement-type");
                const quantityInputGroup = $("#createStepQuantity");

                if(value === "") {
                    $("#createStepSpecifyQuantityCheckGroup").css("display", "none");
                } else {
                    $("#createStepSpecifyQuantityCheckGroup").css("display", "block");
                    quantityInputGroup.find(".form-control").attr("max", (maxQuantity != "")? maxQuantity: "314159265");
                    if(measurementType == "QUANTITY") {
                        quantityInputGroup.find('.input-group-text').css("display", "hidden");
                    } else {
                        quantityInputGroup.find('.input-group-text').css("display", "block");
                        quantityInputGroup.find('.input-group-text').html(suffix[measurementType]);
                    }
                }
            });
            $("#createStepSpecifyQuantityCheckbox").on("change", function() {
                if(this.checked) {
                    $("#createStepQuantity").find("input").attr("required", true);
                    $("#createStepQuantity").css("display", "block");
                } else {
                    $("#createStepQuantity").find("input").prop("required", false);
                    $("#createStepQuantity").css("display", "none");
                }
            });
            $("#createStepSpecifyMinutesCheckbox").on("change", function() {
                if(this.checked) {
                    $("#createStepMinutes").find("input").attr("required", true);
                    $("#createStepMinutes").css("display", "block");
                } else {
                    $("#createStepQuantity").find("input").prop("required", false);
                    $("#createStepMinutes").css("display", "none");
                }
            });

        // update step modals
        <?php foreach($recipeSteps as $step): ?>
            $("#updateStepIngredientSelect-<?php echo $step["id"] ?>").change(function() {
                const value = $(this).val();
                const maxQuantity = $(this).find("option:selected").data("max-quantity");
                const measurementType = $(this).find("option:selected").data("measurement-type");
                const quantityInputGroup = $("#updateStepQuantity-<?php echo $step["id"] ?>");

                if(value === "") {
                    $("#updateStepSpecifyQuantityCheckGroup-<?php echo $step["id"] ?>").css("display", "none");
                } else {
                    $("#updateStepSpecifyQuantityCheckGroup-<?php echo $step["id"] ?>").css("display", "block");
                    quantityInputGroup.find(".form-control").attr("max", (maxQuantity != "")? maxQuantity: "314159265");
                    if(measurementType == "QUANTITY") {
                        quantityInputGroup.find('.input-group-text').css("display", "hidden");
                    } else {
                        quantityInputGroup.find('.input-group-text').css("display", "block");
                        quantityInputGroup.find('.input-group-text').html(suffix[measurementType]);
                    }
                }
            });
            $("#updateStepSpecifyQuantityCheckbox-<?php echo $step["id"] ?>").on("change", function() {
                if(this.checked) {
                    $("updateStepQuantity-<?php echo $step["id"] ?>").find("input").attr("required", true);
                    $("#updateStepQuantity-<?php echo $step["id"] ?>").css("display", "block");
                } else {
                    $("#updateStepQuantity-<?php echo $step["id"] ?>").find("input").prop("required", false);
                    $("#updateStepQuantity-<?php echo $step["id"] ?>").css("display", "none");
                }
            });
            $("#updateStepSpecifyMinutesCheckbox-<?php echo $step["id"] ?>").on("change", function() {
                if(this.checked) {
                    $("#updateStepMinutes-<?php echo $step["id"] ?>").find("input").attr("required", true);
                    $("#updateStepMinutes-<?php echo $step["id"] ?>").css("display", "block");
                } else {
                    $("#updateStepQuantity-<?php echo $step["id"] ?>").find("input").prop("required", false);
                    $("#updateStepMinutes-<?php echo $step["id"] ?>").css("display", "none");
                }
            });
        <?php endforeach ?>
    });
</script>

<?php
    $content = ob_get_clean();
    require "template.php";
?>

