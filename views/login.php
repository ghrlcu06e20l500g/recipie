<!DOCTYPE html>

<html lang="en">
    <?php require_once("head.php"); ?>
    <body class="position-relative">
		<div class="container mt-3 position-absolute start-50 translate-middle-x">
        	<?php if($_GET["error"] != null): ?>
          		<div class="alert alert-warning mb-3 alert-dismissible fade show" role="alert">
            		<p><?php echo $_GET["error"] ?>
              		<button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
          		</div>
          	<?php endif ?>
        </div>
       	<div class="vh-100 d-flex justify-content-center">
         	<div class="card shadow align-self-center">
             	<div class="card-body">
                 	<h1 class="display-1">Log in</h1>
                  	<form method="POST" action="auth.php">
                    	<label for="username">Username</label>
                    	<input required type="text" name="username" class="form-control">

                    	<label for="password">Password</label>
                    	<input required type="password" name="password" class="form-control">

                    	<p class="mt-2">No account yet? <a href="signup.php">Sign up</a>.</p>
                    	<div class="d-flex justify-content-end">
                      		<button type="submit" class="btn btn-primary">Proceed</button>
                    	</div>
                  	</form>
             	</div>
           	</div>
      	</div>
    </body>
</html>