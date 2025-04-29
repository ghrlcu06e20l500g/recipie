<?php
    $name = "user";
    session_start();
	include "/membri/recipie/controllers/user.php";
    ob_start();
?>

<div class="row mb-3 align-items-center">
    <div class="col-12 col-xxl-3">
        <img src="<?php echo $profilePictureSrc ?? "../images/defaultProfilePicture.jpg" ?>" class="rounded-circle mt-3" style="height: 300px; width: 300px; object-fit: cover">
    </div>
    <div class="col-12 col-xxl-9">
        <h1 class="display-1">
            <?php echo ucwords(strtolower($user["username"])); ?>
        </h1>    
    </div>
</div>

<div class="d-flex">
    <button class="btn btn-primary shadow me-2" onclick="share()" style="white-space: nowrap">
        <img src="../images/share-fill.svg" style="filter: invert(100%)">
        Share
    </button>
    <?php if($currentUser): ?>
        <button type="button" class="btn btn-primary me-2" data-bs-toggle="modal" data-bs-target="#updateUserModal" style="white-space: nowrap">
            <img src="../images/gear-fill.svg" style="filter: invert(100%)">
            <span>Settings</span>
        </button>
        <button class="btn btn-warning me-2 shadow" onclick="window.location.href = 'logout.php'" style="white-space: nowrap">
            <img src="../images/box-arrow-left.svg">
            Logout
        </button>
    <?php endif ?>
</div>

<h2 class="display-2">Preferences</h2>
<table class="table table-striped">
    <tr>
        <td><img src="../images/capsule-pill.svg"></td>
        <th>
            Allergies
        </th>
        <?php if($currentUser): ?>
            <form method="POST" action="updateUserAllergens.php">
                <input type="hidden" name="userId" value="<?php echo $id ?>">
                <td>
                    <select multiple name="allergens[]" class="form-select">
                        <?php foreach(loadAllergens() as $allergen): ?>
                            <option 
                                value="<?php echo $allergen["id"] ?>"
                                <?php if(in_array($allergen["id"], array_column($userAllergens, "id"))) echo "selected" ?>    
                            >
                                <?php echo $allergen["name"] ?>
                            </option>
                        <?php endforeach ?>
                    </select>
                    <button type="button" class="btn btn-secondary shadow mt-2 ingredient-deselect-button" data-name="allergens[]">Clear Selection</button> 
                </td>
                <td>
                    <button type="submit" class="btn btn-primary shadow">
                        <img src="../images/pencil-square.svg" style="filter: invert(100%)">
                    </button>
                </td>
            </form>
        <?php else: ?>
            <td><?php echo implode(", ", array_column($userAllergens, "name")) ?></td>
            <td></td>
        <?php endif ?>
    </tr>
    <tr>
        <td><img src="../images/palette2.svg"></td>
        <th>
            Diet
        </th>
        <?php if($currentUser): ?>
            <form method="POST" action="updateUserDiet.php">
                <input type="hidden" name="id" value="<?php echo $id ?>">
                <td class="w-100">
                    <select required name="diet" class="form-select">
                        <option value="OMNIVOIRE" <?php if($user["diet"] == "OMNIVOIRE") echo "selected" ?>>Omnivoire</option>
                        <option value="VEGETARIAN" <?php if($user["diet"] == "VEGETARIAN") echo "selected" ?>>Vegetarian</option>
                        <option value="VEGAN" <?php if($user["diet"] == "VEGAN") echo "selected" ?>>Vegan</option>
                    </select>
                </td>
                <td>
                    <button type="submit" class="btn btn-primary">
                        <img src="../images/pencil-square.svg" style="filter: invert()">
                    </button>
                </td>
            </form>
        <?php else: ?>
            <td><?php echo ucwords(strtolower($user["diet"])) ?></td>
        <?php endif ?>
    </tr>
    <tr>
        <td><img src="../images/dash-lg.svg"></td>
        <th>
            Dislikes
        </th>
        <?php if($currentUser): ?>
            <form method="POST" action="updateUserDislikedIngredients.php">
                <input type="hidden" name="userId" value="<?php echo $id ?>">
                <td>
                    <select multiple name="dislikedIngredients[]" class="form-select ingredient-select">
                        <?php foreach(loadIngredients() as $ingredient): ?>
                            <option 
                                value="<?php echo $ingredient["id"] ?>"    
                                <?php if(in_array($ingredient["id"], array_column($userDislikedIngredients, "id"))) echo "selected" ?>
                            >
                                <?php echo ucwords(strtolower($ingredient["name"])) ?>
                            </option>
                        <?php endforeach ?>
                    </select>
                    <button type="button" class="btn btn-secondary shadow mt-2 ingredient-deselect-button" data-name="dislikedIngredients[]">Clear Selection</button> 
                </td>
                <td>
                    <button type="submit" class="btn btn-primary">
                        <img src="../images/pencil-square.svg" style="filter: invert(100%)">
                    </button>
                </td>
            </form>
        <?php else: ?>
            <td><?php echo implode(", ", array_column($userDislikedIngredients, "name")) ?></td>
            <td></td>
        <?php endif ?>
    </tr>
    <tr>
        <td><img src="../images/plus-lg.svg"></td>
        <th>
            Likes
        </th>
        <?php if($currentUser): ?>
            <form method="POST" action="updateUserLikedIngredients.php">
                <input type="hidden" name="userId" value="<?php echo $id ?>">
                <td>
                    <select multiple name="likedIngredients[]" class="form-select ingredient-select">
                        <?php foreach(loadIngredients() as $ingredient): ?>
                            <option 
                                value="<?php echo $ingredient["id"] ?>"    
                                <?php if(in_array($ingredient["id"], array_column($userLikedIngredients, "id"))) echo "selected" ?>
                            >
                                <?php echo ucwords(strtolower($ingredient["name"])) ?>
                            </option>
                        <?php endforeach ?>
                    </select>
                    <button type="button" class="btn btn-secondary shadow mt-2 ingredient-deselect-button" data-name="likedIngredients[]">Clear Selection</button> 
                </td>
                <td>
                    <button type="submit" class="btn btn-primary">
                        <img src="../images/pencil-square.svg" style="filter: invert(100%)">
                    </button>
                </td>
            </form>
        <?php else: ?>
            <td><?php echo implode(", ", array_column($userLikedIngredients, "name")) ?></td>
            <td></td>
        <?php endif ?>
    </tr>
    <tr>
        <td><img src="../images/heart.svg"></td>
        <th>
            Loves
        </th>
        <?php if($currentUser): ?>
            <form method="POST" action="updateUserLovedIngredients.php">
                <input type="hidden" name="userId" value="<?php echo $id ?>">
                <td>
                    <select multiple name="lovedIngredients[]" class="form-select ingredient-select">
                        <?php foreach(loadIngredients() as $ingredient): ?>
                            <option 
                                value="<?php echo $ingredient["id"] ?>"    
                                <?php if(in_array($ingredient["id"], array_column($userLovedIngredients, "id"))) echo "selected" ?>
                            >
                                <?php echo ucwords(strtolower($ingredient["name"])) ?>
                            </option>
                        <?php endforeach ?>
                    </select>
                    <button type="button" class="btn btn-secondary shadow mt-2 ingredient-deselect-button" data-name="lovedIngredients[]">Clear Selection</button> 
                </td>
                <td>
                    <button type="submit" class="btn btn-primary">
                        <img src="../images/pencil-square.svg" style="filter: invert(100%)">
                    </button>
                </td>
            </form>
        <?php else: ?>
            <td><?php echo implode(", ", array_column($userLovedIngredients, "name")) ?></td>
            <td></td>
        <?php endif ?>
    </tr>
</table>

<h2 class="display-2">Recipies</h2>
<?php if(!empty($userRecipes)): foreach($userRecipes as $recipe): ?>
    <a href="recipe.php?id=<?php echo $recipe["id"] ?>" class="text-decoration-none">
        <div class="card shadow mb-3">
            <div class="card-body">
                <h5 class="card-title"><?php echo $recipe["name"] ?></h5>
                <h6 class="card-subtitle mb-2 text-muted "><?php echo $recipe["portions"] ?> Portions</h6>
            </div>
        </div>
    </a>
<?php endforeach; else: ?>
    <p>No recipes here.</p>
<?php endif ?>

<?php if($currentUser): ?>
    <button class="btn btn-primary shadow" onclick="window.location.href='createRecipe.php'">
        <img src="../images/plus-lg.svg" style="filter: invert()">
        Create Recipe.
    </button>
<?php endif ?>

<div class="modal fade" id="updateUserModal" tabindex="-1">
    <form method="POST" action="updateUser.php" enctype="multipart/form-data">
        <input type="hidden" name="id" value="<?php echo $id ?>">
        <div class="modal-dialog">
            <div class="modal-content">
              <div class="modal-header">
                  <h1 class="modal-title fs-5">User Settings</h1>
              </div>
              <div class="modal-body">
                  <label for="email" class="form-label">Email</label>
                  <input required type="email" maxlength="126" name="email" class="form-control" value="<?php echo $user["email"] ?>">
                  <label for="username" class="form-label">Name</label>
                  <input required type="text" maxlength="32" name="username" class="form-control" value="<?php echo $user["username"] ?>">
                  <label for="profilePicture" class="form-label">Change Profile Picture</label>
                  <input type="file" name="profilePicture" accept="image/*" class="form-control" id="profilePictureInput">
                  <div class="form-check mt-2">
                      <input type="checkbox" name="changePassword" class="form-check-input" id="changePasswordCheck">
                      <div class="form-label">Change Password</div>
                  </div>
                  <div id="passwordField" style="display: none">
                      <label for="password">New Password</label>
                      <input type="password" maxlength="32" name="password" class="form-control">
                  </div>
                  <button type="button" class="btn btn-danger shadow mt-2" data-bs-toggle="modal" data-bs-target="#deleteUserModal" style="white-space: nowrap">
                      <img src="../images/trash-fill.svg" style="filter: invert(100%)">
                      <span>Delete Account</span>
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
<div class="modal fade" id="deleteUserModal" tabindex="-1">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h1 class="modal-title fs-5">Are you absolutely very very positively sure you want to do this?</h1>
            </div>
            <div class="modal-body">
                <p>You will lose forever:</p>
                <ul>
                    <li>All your food preference data.</li>
                    <li>All the recipies you bookmarked.</li>
                    <li>All the recipies you made.</li>
                </ul>
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
    $(document).ready(function () {
        $("#changePasswordCheck").on("change", function() {
            if(this.checked) {
                $("#passwordField").find("input").attr("required", true);
                $("#passwordField").css("display", "block");
            } else {
                $("#passwordField").find("input").prop("required", false);
                $("#passwordField").css("display", "none");
            }
        });
        $("#profilePictureInput").on("change", function() {
          	var fileInput = this;
          	var file = fileInput.files[0];

          	if(!file) {
              	alert("Please select a file.");
              	return;
          	}

          	var maxSize = 65535;
          	if(file.size > maxSize) {
              	alert("Error: File is too large. Maximum allowed size is 64KB.");
              	return;
          	}
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
    });
</script>

<?php
    $content = ob_get_clean();
    require "template.php";
?>

