<?php
    include $_SERVER['DOCUMENT_ROOT'].'/functions/database.php';
    $database = new database();

    if (isset($_GET['id']) && !empty($_GET['id'])) {
        $object = $database->fetch_id('danhmuc','id_danhmuc',$_GET['id']);
        $result = mysqli_fetch_assoc($object);
        if ($result['trangthai']==0) {
            $sqlUpdate = "update danhmuc set trangthai = 1 where id_danhmuc = {$_GET['id']} ";
            $queryUpdate = $database->fetch_sql($sqlUpdate);
            if ($queryUpdate) {
                header('Location:/admin/categories/?msg=edit');
            }
        }else if($result['trangthai']==1){
            $sqlUpdate = "update danhmuc set trangthai = 0 where id_danhmuc = {$_GET['id']} ";
            $queryUpdate = $database->fetch_sql($sqlUpdate);
            if ($queryUpdate) {
                header('Location:/admin/categories/?msg=edit');
            }
        }
    }