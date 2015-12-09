<?php
/**
 * Created by PhpStorm.
 * User: Alexander
 * Date: 12/8/2015
 * Time: 11:10 AM
 */

session_start();

if(!isset($_SESSION["user"]) || !isset($_POST["name"]) || !isset($_POST["content"])){
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
$stmnt = $conn->prepare("INSERT INTO threads(username, name, created, content, reply_to) VALUES (:user, :name, now(), :content, null)");
$stmnt->bindParam(":user", $_SESSION["user"]);
$stmnt->bindParam(":name", $_POST["name"]);
$stmnt->bindParam(":content", $_POST["content"]);

$result = $stmnt->execute();
if($result == 1){
    $id = $conn->lastInsertId();
    $conn->commit();
    header("Location: http://classdb.it.mtu.edu/~ajdavid/HW9/Forum2/thread?id=".$id);
}else{
    $conn->rollBack();
    header("Location: http://classdb.it.mtu.edu/~ajdavid/HW9/Forum2/");
}

function getId($conn){
    $stmnt = $conn->prepare("select id from threads where username = :user and name = :name and content = :content and reply_to is null");
    $stmnt->bindParam(":user", $_SESSION["user"]);
    $stmnt->bindParam(":name", $_POST["name"]);
    $stmnt->bindParam(":content", $_POST["content"]);
    $stmnt->execute();
    $result = $stmnt->fetch(PDO::FETCH_ASSOC);
    return $result["id"];
}