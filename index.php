<?php

session_start();

if (isset($_POST['logout'])) {
	session_destroy();
	unset($_SESSION['login']);
	header("Location: login.php");
}

?>


<!DOCTYPE html>
<html>
<head>
	<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0-beta.2/css/bootstrap.min.css" integrity="sha384-PsH8R72JQ3SOdhVi3uxftmaW6Vc51MKb0q5P2rRUpPvrszuE4W1povHYgTpBfshb" crossorigin="anonymous">
	<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
	<link rel="stylesheet" type="text/css" href="css/style.css">
	<title></title>
</head>
<body>
	<div class="container">
		<div class="row">
<?php
if (isset($_SESSION["login"])) {
?>
			<div class="col-1">
				<form method="POST">
					<button class="btn btn-danger mt-1" name="logout">Log out</button>
				</form>
			</div>
			<div class="col-2">
<?php				
echo "You are logged in! Your level is " . $_SESSION['lygis'];
?>
			</div>
		
<?php				
} else {
?>
			<div class="col-1">
				<form method="POST">
					<a class="btn btn-danger mt-1" name="login" href="http://localhost/Projektas/php cars/login.php">Log in</a>
				</form>
			</div>
			<div class="col-1">
				<form method="POST">
					<a class="btn btn-success mt-1" name="login" href="http://localhost/Projektas/php cars/register.php">Register</a>
				</form>
			</div>
			</div>
<?php
}
?>
		<div class="row">
			<div class="col-4 mt-3">
				<h3>Prideti automobili</h3>
				<input id="owner" class="form-control mt-3" type="text" name="owner" placeholder="Owner">
				<input id="license" class="form-control mt-3" type="text" name="license" placeholder="License">
				<select id="make" class="form-control mt-3">
					<option value="volvo">Volvo</option>
					<option value="saab">Saab</option>
					<option value="mercedes">Mercedes</option>
					<option value="audi">Audi</option>
				</select> 
				<select id="model" class="form-control mt-3">
					<option value="model1">Model1</option>
					<option value="model2">Model2</option>
					<option value="model3">Model3</option>
					<option value="model4">Model4</option>
				</select> 
				<input id="submit" class="form-control btn btn-primary mt-3" type="button" name="submit" value="Submit" 
				<?php 
				if (isset($_SESSION["login"])) {
				if ($_SESSION['lygis'] < 1) { echo "disabled"; } 
				}
				?>
				>
			</div>
			<div class="col-8">
				<h1>Automobiliu sarasas</h1>
				<div class="row">
					<div class="col-lg-3">
						<div class="input-group">
							<select id="make_filter" class="form-control mt-3">
								<option value="">Make</option>
								<option value="volvo">Volvo</option>
								<option value="saab">Saab</option>
								<option value="mercedes">Mercedes</option>
								<option value="audi">Audi</option>
							</select> 
						</div>
					</div>
					<div class="col-lg-3">
						<div class="input-group">
							<select id="model_filter" class="form-control mt-3">
								<option value="">Model</option>
								<option value="model1">Model1</option>
								<option value="model2">Model2</option>
								<option value="model3">Model3</option>
								<option value="model4">Model4</option>
							</select>
						</div>
					</div>
					<div class="col-lg-3">
						<div class="input-group">
							<input id="owner_filter" class="form-control mt-3" type="text" name="owner_filter" placeholder="Owner">
						</div>
					</div>
					<div class="col-lg-3">
						<div class="input-group">
							<input id="last_filter" class="form-control mt-3 btn btn-success" type="button" name="last_filter" value="Last 10">
						</div>
					</div>
				</div>
				<table class="table">
					<thead>
						<tr>
							<th scope="col">ID</th>
							<th scope="col">Owner</th>
							<th scope="col">License</th>
							<th scope="col">Model</th>
							<th scope="col">Make</th>
							<th scope="col">Date</th>
						</tr>
					</thead>
					<tbody id="lentele">
					</tbody>
				</table>
			</div>
		</div>
	</div>
	<script src="script.js"></script>
</body>
</html>