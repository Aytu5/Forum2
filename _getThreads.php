<?php
/**
 * Created by PhpStorm.
 * User: Alexander
 * Date: 12/1/2015
 * Time: 2:50 PM
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

    $stmnt = $conn->prepare("select id, created, name, username from threads order by created limit :number offset :offset");
    $stmnt->execute(array(":number" => $_GET["number"], ":offset" => $_GET["offset"]));
    $resultSet = $stmnt->fetchAll(PDO::FETCH_BOTH);

    echo json_encode($resultSet);
