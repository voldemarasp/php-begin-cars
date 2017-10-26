<?php

session_start();
$errors = [];
if (isset($_POST['logout'])) {
	session_destroy();
	unset($_SESSION['login']);
	header("Location: login.php");
}

function import_info($failo_kelias) {
	$failo_kelias_visas = "uploads/" . $failo_kelias;

	$myfile = fopen($failo_kelias_visas, "r") or die("Unable to open file!");
	
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "cars";

    $conn = new PDO("mysql:host=$servername;dbname=$dbname", $username, $password);
    // set the PDO error mode to exception
    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    // $sql = "INSERT INTO users (vardas, pavarde, emailas, telefonas)
    // VALUES ('$vardas', '$pavarde', '$emailas', '$telefonas')";
    // // use exec() because no results are returned
    // $conn->exec($sql);

 	$stmt = $conn->prepare("INSERT INTO cars (owner, license, model, make, date)
    VALUES (:owner, :license, :model, :make, :date)");
    $stmt->bindParam(':owner', $owner);
    $stmt->bindParam(':license', $license);
    $stmt->bindParam(':model', $model);
    $stmt->bindParam(':make', $make);
    $stmt->bindParam(':date', $date);

    // insert a row

	while (!feof($myfile)) {
	$informacija_perkelti[] = explode(",", fgets($myfile));
	}
	foreach ($informacija_perkelti as $value) {
	$owner = htmlspecialchars($value[1]);
	$license = htmlspecialchars($value[2]);
	$model = htmlspecialchars($value[3]);
	$make = htmlspecialchars($value[4]);
	$date = date('l jS \of F Y h:i:s A');
	$stmt->execute();
	}

}



if (isset($_POST["file_submit"])) {

	$target_dir = "uploads/";
	$target_file = $target_dir . basename($_FILES["fileToUpload"]["name"]);
	$uploadOk = 1;
	$imageFileType = pathinfo($target_file,PATHINFO_EXTENSION);

	if($imageFileType != "csv") {
		$errors[] = "Sorry, only CSV files are allowed.";
		$uploadOk = 0;
	}

	if ($uploadOk == 0) {
		$errors[] = "Sorry, your file was not uploaded.";
// if everything is ok, try to upload file
	} else {
		if (move_uploaded_file($_FILES["fileToUpload"]["tmp_name"], $target_file)) {
			$errors[] = "The file ". basename( $_FILES["fileToUpload"]["name"]). " has been uploaded";
			$file_name_import = basename( $_FILES["fileToUpload"]["name"]);
			import_info($file_name_import);
		} else {
			$errors[] = "Sorry, there was an error uploading your file.";
		}
	}

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
				<div class="col-md-5 col-lg-1">
					<form method="POST">
						<button class="btn btn-danger mt-1" name="logout">Log out</button>
					</form>
				</div>
				<div class="col-md-5 col-lg-2">
					<?php				
					echo "You are logged in! Your level is " . $_SESSION['lygis'];
					?>
				</div>

				<?php				
			} else {
				?>
				<div class="col-md-6 col-lg-1">
					<form method="POST">
						<a class="btn btn-danger mt-1" name="login" href="http://localhost/Projektas/php cars/login.php">Log in</a>
					</form>
				</div>
				<div class="col-md-6 col-lg-1">
					<form method="POST">
						<a class="btn btn-success mt-1" name="login" href="http://localhost/Projektas/php cars/register.php">Register</a>
					</form>
				</div>
			</div>
			<?php
		}
		?>
		<div class="row">
			<div class="col-sm-12 col-md-12 col-lg-4 mt-3">
				<h3>Prideti automobili</h3>
				<div id="prideti_error" class="red_error"></div>
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
				if (isset($_SESSION['login'])) {
				if ($_SESSION['login'] == "logged" && $_SESSION['lygis'] < 1) {
				 echo "disabled"; 
				}
				} else { echo "disabled"; }	
				?>
				>
				<div class="mt-5">
					<h3>Prideti CSVS</h3>
					<span class="red_error">
						<?php 
						foreach ($errors as $error) {
							echo $error;
						}
						?>
					</span>
					<form method="post" enctype="multipart/form-data">
						Select file to upload:
						<input class="form-control" type="file" name="fileToUpload" id="fileToUpload">
						<input class="form-control btn btn-dark mt-3" type="submit" value="Upload file" name="file_submit"
						<?php 
						if (isset($_SESSION['login'])) {
						if ($_SESSION['login'] == "logged" && $_SESSION['lygis'] < 1) {
						 echo "disabled"; 
						}
						} else { echo "disabled"; }	
						?>
						>
					</form>
				</div>
			</div>
			<div class="col-sm-12 col-md-12 col-lg-8">
				<h1>Automobiliu sarasas</h1>
				<div class="red_error"><?php if (!empty($_GET["error"])) { echo "Your level is to low"; } ?></div>
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
							<th scope="col">Delete</th>
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