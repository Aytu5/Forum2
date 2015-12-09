<?php
/**
 * Created by PhpStorm.
 * User: Alexander
 * Date: 12/8/2015
 * Time: 11:10 AM
 */

session_start();

if(!isset($_SESSION["user"])  || !isset($_POST["content"]) || !isset($_POST["reply_to"])){
    echo "error :(";
    die();
}

$servername = "classdb.it.mtu.edu";
$username = "cs3425gr";
$password = "cs3425gr";
$dbname = "ajdavid";

$conn = new PDO("mysql:host=$servername;dbname=$dbname", $username, $password);
$conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

$conn->beginTransaction();
$stmnt = $conn->prepare("INSERT INTO threads(username, name, created, content, reply_to) VALUES (:user, :name, now(), :content, :reply_to)");
$stmnt->bindParam(":user", $_SESSION["user"]);
$name = (isset($_POST["name"]) ? $_POST["name"] : null);
$stmnt->bindParam(":name", $name );
$stmnt->bindParam(":content", $_POST["content"]);
$stmnt->bindParam(":reply_to", $_POST["reply_to"]);

$result = $stmnt->execute();
if($result == 1){
    $conn->commit();
    header("Location: http://classdb.it.mtu.edu/~ajdavid/HW9/Forum2/thread?id=".$_POST["reply_to"]);
}else{
    $conn->rollBack();
    header("Location: http://classdb.it.mtu.edu/~ajdavid/HW9/Forum2/");
}