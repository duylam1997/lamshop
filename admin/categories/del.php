<?php
include $_SERVER['DOCUMENT_ROOT'].'/functions/database.php';
    $database = new database();
    $getID = $_GET['id'];
    $dellAll    = $database->dellallCat($getID);
    $del = $database->delTable("danhmuc","id_danhmuc",$getID);
    header('Location:/admin/categories/');
    //$dellAll    = $db->dellallCat($getID);

