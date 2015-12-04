<?php
/**
 * Created by PhpStorm.
 * User: Alexander
 * Date: 12/2/2015
 * Time: 11:24 AM
 */
if(!isset($_SESSION)){
    session_start();
    echo json_encode($_SESSION);
}