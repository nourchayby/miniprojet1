<?php
$servername="localhost";
$username="root";
$password="";
$database="miniprojet1";  
$connection = new mysqli($servername, $username, $password, $database);
$name = $details ="";
$errorMessage = $successMessage ="";
if ($_SERVER ['REQUEST_METHOD']=='POST'){
    $name= $_POST["name"];
    $details= $_POST["details"];
    do{
        if(empty($name)|| empty($details)){
            $errorMessage="All the fields are required";
        break;
        }
        $sql = "INSERT INTO product (name,details)".
           " VALUES('$name' ,'$details')";
        $result=$connection ->query($sql);
        if(!$result){
            $errorMessage="invalid query " . $connection->error;
            break;

    }
    $name =$details ="";
    $successMessage ="product added correctly";
    header("location:/miniprojet1/index.php");
    exit;

       }

    while(false);


    }

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.4.1/dist/css/bootstrap.min.css" 
          integrity="sha384-Vkoo8x4CGsO3+Hhxv8T/Q5PaXtkKtu6ug5TOeNV6gBiFeWPGFN9MuhOf23Q9Ifjh" crossorigin="anonymous">
    <title>Product</title>
</head>
<body>
    <div class="container my-5">
        <h2> Create New </h2>



        <form action="" method="POST">
            <div class="form-group row">
                <label class="col-sm-3 col-form-label">name</label>
                <div class="col-sm-6">
                    <input type="text" class="form-control" name="name" value="">
                </div>
            </div>
            <div class="form-group row">
                <label class="col-sm-3 col-form-label">details</label>
                <div class="col-sm-6">
                    <input type="text" class="form-control" name="details" value="">
                </div>
            </div> 
            <div class="form-group row">
                <div class="offset-sm-3 col-sm-3">
                    <button type="submit" class="btn btn-primary btn-block">Submit</button>
                </div>
                <div class="col-sm-3">
                    <a class="btn btn-outline-primary btn-block" href="../miniprojet1/index.php" role="button">Cancel</a>
                </div>
            </div>
        </form>
    </div>

    <script src="https://code.jquery.com/jquery-3.4.1.slim.min.js" 
            integrity="sha384-J6qa4849blE2jt3WXh6nORtpv1ykd78M9Om9UvZ4E2kI5QkI5IQ5JpDtQOfVxHz/"
            crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.4.1/dist/js/bootstrap.bundle.min.js" 
            integrity="sha384-6H1UoVbHTDkA8EMLljh7YIV14j4uazE+OlqU1a65JStn5X4gdbCCn5EE5QJv6Ow/"
            crossorigin="anonymous"></script>
    <nav>
        <ul class="pagination">
            <li class="page-item">
                <a class="page-link" href="index.php">Précédent</a>
            </li>
            <li class="page-item"><a class="page-link" href="index.php">1</a></li>
            <li class="page-item active"><a class="page-link" href="create.php">2</a></li>
            <li class="page-item"><a class="page-link" href="edit.php">3</a></li>+
            <li class="page-item">
                <a class="page-link" href="edit.php">Suivant</a>
            </li>
        </ul>
    </nav>
</body>
</html>
