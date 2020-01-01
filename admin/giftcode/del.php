<?php
include $_SERVER['DOCUMENT_ROOT'].'/functions/database.php';
$database = new database();

if (isset($_GET['id']) && !empty($_GET['id'])) {
    $del = $database->delTable('makhuyenmai','id_km',$_GET['id']);
    header('Location:/admin/giftcode/?msg=del');
}else {
    header('Location:/admin/');
}