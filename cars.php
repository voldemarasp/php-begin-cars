<?php
header("Content-type:application/json");
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "cars";

if (!empty($_POST["owner"])) {
try {
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
$owner = htmlspecialchars($_POST["owner"]);
$license = htmlspecialchars($_POST["license"]);
$model = htmlspecialchars($_POST["model"]);
$make = htmlspecialchars($_POST["make"]);
$date = date('l jS \of F Y h:i:s A');
    $stmt->execute();

    //echo "New record created successfully";
    }
catch(PDOException $e)
    {
    //echo $sql . "<br>" . $e->getMessage();
    }

$conn = null;
}


try {
    $conn = new PDO("mysql:host=$servername;dbname=$dbname", $username, $password);
    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    
    if (isset($_GET['make_filter']) || isset($_GET['model_filter']) || isset($_GET['owner_filter'])) {
    	$make = $_GET['make_filter'];
    	$model = $_GET['model_filter'];
    	$owner = $_GET['owner_filter'];
    $stmt = $conn->query("SELECT * FROM cars WHERE make LIKE '%{$make}%' AND model LIKE '%{$model}%' AND owner LIKE '%{$owner}%'");
    $result = $stmt->fetchAll(PDO::FETCH_ASSOC);
    
    } elseif (isset($_GET['last_filter'])) {
    $stmt = $conn->query("SELECT * FROM cars ORDER BY id DESC LIMIT 10");
    $result = $stmt->fetchAll(PDO::FETCH_ASSOC);
    } else {
    $stmt = $conn->query("SELECT * FROM cars");
    $result = $stmt->fetchAll(PDO::FETCH_ASSOC);        
    }
    
    $conn = null;
	}
	catch(PDOException $e)
    {
    //echo $sql . "<br>" . $e->getMessage();
    }

echo json_encode($result);
