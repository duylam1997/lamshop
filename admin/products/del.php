<?php
    include $_SERVER['DOCUMENT_ROOT'].'/functions/database.php';
    $database = new database();

    if (isset($_GET['id']) && !empty($_GET['id'])) {
        $del = $database->delTable('sanpham','id_sanpham',$_GET['id']);
        header('Location:/admin/products/?msg=del');
    }else {
        header('Location:/admin/');
    }