<?php
    include $_SERVER['DOCUMENT_ROOT'].'/functions/database.php';
    $database = new database();
    $sql = "Select * from sanpham where id_sanpham ={$_POST['id']}";
    $objectQty = $database->fetch_sql($sql);
    $result = mysqli_fetch_assoc($objectQty);
    if (isset($_POST['qty']) && !empty($_POST['qty'])) {
        $qtyTotal = $result['soluong'] + $_POST['qty'];
        $sql2 = "Update sanpham set soluong = {$qtyTotal} where id_sanpham = {$_POST['id']}";
        $database->fetch_sql($sql2);
        echo $qtyTotal;
    }else {
        echo $result['soluong'];
    }
    ?>
