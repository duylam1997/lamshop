<?php
include $_SERVER['DOCUMENT_ROOT'].'/functions/database.php';
$database = new database();

if (isset($_GET['id']) && !empty($_GET['id'])) {
    $del = $database->delTable('nguoidung','id_nguoidung',$_GET['id']);
    header('Location:/admin/users/?msg=del');
}else {
    header('Location:/admin/');
}