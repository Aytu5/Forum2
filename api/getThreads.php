<?php
/**
 * Created by PhpStorm.
 * User: Alexander
 * Date: 12/6/2015
 * Time: 3:32 PM
 */

if(!isset($_GET["offset"]) || !isset($_GET["number"])){
    die();
}

$servername = "classdb.it.mtu.edu";
$username = "cs3425gr";
$password = "cs3425gr";
$dbname = "ajdavid";

$conn = new PDO("mysql:host=$servername;dbname=$dbname", $username, $password);
$conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

$stmnt = $conn->prepare("select id, created, name, username, content from threads where reply_to is null order by created limit :number offset :offset");
$stmnt->bindParam(':number', intVal($_GET["number"]), PDO::PARAM_INT);
$stmnt->bindParam(':offset', intVal($_GET["offset"]), PDO::PARAM_INT);
$stmnt->execute();
//$stmnt = $conn->prepare("select id, created, name, username from threads order by created limit 10 offset 0;");
//$stmnt->execute([]);
$resultSet = $stmnt->fetchAll(PDO::FETCH_ASSOC);



echo json_encode($resultSet);
