<?php
/**
 * Created by PhpStorm.
 * User: Alexander
 * Date: 12/7/2015
 * Time: 11:17 AM
 */

if(!isset($_GET["id"])){
    die();
}

$servername = "classdb.it.mtu.edu";
$username = "cs3425gr";
$password = "cs3425gr";
$dbname = "ajdavid";

$conn = new PDO("mysql:host=$servername;dbname=$dbname", $username, $password);
$conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

$stmnt = $conn->prepare("select id, username, name, created, content from threads where id = :id");
$stmnt->bindParam(":id", $_GET["id"], PDO::PARAM_INT);
$stmnt->execute();
$ret = $stmnt->fetch(PDO::FETCH_ASSOC);

$stmnt = $conn->prepare("select id, created, name, username, content, reply_to from threads where reply_to = :id");
$stmnt->bindParam(":id", $_GET["id"], PDO::PARAM_INT);
$stmnt->execute();
$ret["replies"] = $stmnt->fetchAll(PDO::FETCH_ASSOC);

//print_r($ret);
//echo "<br/><br/>";
$size = sizeof($ret["replies"]);

for($i = 0; $i < sizeof($ret); $i++){
    getComments($ret["replies"][$i], $conn);
//    if($ret["replies"][$i]["id"] == null){
//        $toRemove[] = $i;
//    }
}
//echo sizeof($ret);

array_splice($ret["replies"], $size, sizeof($ret["replies"]) - $size);

//$stack = new SplDoublyLinkedList();
//foreach( $ret["replies"] as $reply){
//    //$stack->push(&$reply);
//    getComments($reply, $conn);
//}

//while(!$stack->isEmpty()){
//    $Thisreply = $stack->shift();
//
//
//    $stmnt = $conn->prepare("select id, created, name, username, content, reply_to from threads where reply_to = :id");
//    $stmnt->bindParam(":id", $Thisreply["id"], PDO::PARAM_INT);
//    $stmnt->execute();
//    $results = $stmnt->fetchAll(PDO::FETCH_ASSOC);
//    if(sizeof($results) > 0) {
//        foreach ($results as $new) {
//            $stack->push($new);
//        }
//        $Thisreply["replies"] = $results;
//    }
//    print_r($Thisreply);
//    echo "<br/>";
//}

//print_r($ret);
//echo "<br/>";



echo json_encode($ret);

function getComments(&$reply, $conn){
    $stmnt = $conn->prepare("select id, created, name, username, content, reply_to from threads where reply_to = :id");
    $stmnt->bindParam(":id", $reply["id"], PDO::PARAM_INT);
    $stmnt->execute();
    $results = $stmnt->fetchAll(PDO::FETCH_ASSOC);
    if(sizeof($results) > 0) {
//        foreach ($results as $new) {
//            getComments($new, $conn);
//        }
        for($i = 0; $i < sizeof($results); $i++){
            getComments($results[$i], $conn);
        }
        $reply["replies"] = $results;
    }
}