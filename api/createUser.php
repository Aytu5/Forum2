<?php
    if(!isset($_POST["username"]) || !isset($_POST["password"])){
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
    $stmnt = $conn->prepare("select * from users where username = :username");
    $stmnt->execute(array(":username" => $_POST["username"]));
    $stmnt->setFetchMode(PDO::FETCH_BOTH);
    $resultSet = $stmnt->fetchAll();
    if(sizeof($resultSet) != 0){
        echo "username already taken";
        $conn->rollBack();
        die();
    }
    $stmnt = $conn->prepare("insert into users values(:username, null, :password, :salt)");
    $salt = rand();
    $result = $stmnt->execute(array(":username" => $_POST["username"], ":password" => crypt($_POST["password"],$salt), ":salt" => $salt));
    if($result != 1){
        echo "an error occured :(";
        $conn->rollBack();
        header('Location: http://classdb.it.mtu.edu/~ajdavid/HW9/Forum2/createAccount.html');
    }
    $conn->commit();
    echo "account created";
    header('Location: http://classdb.it.mtu.edu/~ajdavid/HW9/Forum2/');



