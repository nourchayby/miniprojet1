<?php
$servername = "localhost";
$username = "root";
$password = "";
$database = "miniprojet1";
$connection = new mysqli($servername, $username, $password, $database);
if ($connection->connect_error) {
    die("Connection failed: " . $connection->connect_error);
}
$name = $details = "";
$no = "";
$errorMessage = $successMessage = "";

if ($_SERVER['REQUEST_METHOD'] == 'GET') {
    if (isset($_GET["no"]) ) {
        $no =  $_GET["no"]; 
        $sql = "SELECT * FROM product WHERE no = $no";
        $result = $connection->query($sql);
        if ($result && $result->num_rows > 0) {
            $row = $result->fetch_assoc();
            $name = $row["name"];
            $details = $row["details"];
        } else {
            $errorMessage = "Produit non trouvé.";
        }
    } else {
        $errorMessage = "ajout du produit.";
    }
}
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $no = isset($_POST["no"]) ? (int) $_POST["no"] : 0;
    $name = isset($_POST["name"]) ? $_POST["name"] : "";
    $details = isset($_POST["details"]) ? $_POST["details"] : "";

    if (empty($no) || empty($name) || empty($details)) {
        $errorMessage = "Tous les champs sont obligatoires.";
    } else {
        $sql = "UPDATE product SET name='$name', details='$details' WHERE no=$no";
        $result = $connection->query($sql);

        if ($result) {
            header("Location: /miniprojet1/index.php");
            exit;
        } else {
            $errorMessage = "Erreur SQL : " . $connection->error;
        }
    }
}
?>

<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.4.1/dist/css/bootstrap.min.css">
    <title>Modifier Produit</title>
</head>
<body>
    <div class="container my-5">
        <h2>Modifier le produit</h2>

        <?php if (!empty($errorMessage)): ?>
            <div class="alert alert-danger"><?= $errorMessage; ?></div>
        <?php endif; ?>

        <form action="" method="POST">
            <input type="hidden" name="no" value="<?= htmlspecialchars($no); ?>">
            
            <div class="form-group row">
                <label class="col-sm-3 col-form-label">Numéro</label>
                <div class="col-sm-6">
                    <input type="text" class="form-control" name="no" value="<?= htmlspecialchars($no); ?>" readonly>
                </div>
            </div>
            <div class="form-group row">
                <label class="col-sm-3 col-form-label">name</label>
                <div class="col-sm-6">
                    <input type="text" class="form-control" name="name" value="<?= htmlspecialchars($name); ?>">
                </div>
            </div>
            <div class="form-group row">
                <label class="col-sm-3 col-form-label">details</label>
                <div class="col-sm-6">
                    <input type="text" class="form-control" name="details" value="<?= htmlspecialchars($details); ?>">
                </div>
            </div>
            <div class="form-group row">
                <div class="offset-sm-3 col-sm-3">
                    <button type="submit" class="btn btn-primary btn-block">submit</button>
                </div>
                <div class="col-sm-3">
                    <a class="btn btn-outline-primary btn-block" href="../miniprojet1/index.php">cancel</a>
                </div>
            </div>
        </form>
    </div>
</body>
</html>
