<?php 
if(isset($_GET["no"])){
    $no=$_GET["no"];
    $servername="localhost";
    $username="root";
    $password="";
    $database="miniprojet1";
    $connection = new mysqli($servername, $username, $password, $database);
    $sql="DELETE FROM product WHERE no=$no";
    $connection->query($sql);
}
header("location:/miniprojet1/index.php");
exit;
?>