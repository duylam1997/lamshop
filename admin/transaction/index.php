<?php
//header
include_once  $_SERVER['DOCUMENT_ROOT'].'/templates/admin/inc/header.php';
include $_SERVER['DOCUMENT_ROOT'].'/functions/database.php';
$database = new database();
?>
<div class="container-fluid page-body-wrapper">
    <?php include_once  $_SERVER['DOCUMENT_ROOT'].'/templates/admin/inc/sidebar.php' ?>
    <!-- partial -->
    <div class="main-panel">
        <div class="content-wrapper">
            <!-- Page Title Header Starts-->
            <div class="row page-title-header">
                <div class="col-12">
                    <div class="page-header">
                        <h4 class="page-title">Quản Lý đơn hàng</h4>
                    </div>
                </div>
            </div>
            <!-- Page Title Header Ends-->
            <div class="row">
                <div class="col-lg-12 grid-margin stretch-card">
                    <div class="card">
                        <div class="card-body">
                            <?php
                            if (isset($_GET['msg'])) {
                                ?>
                                <div class="alert-light">
                                    <?php
                                    if($_GET['msg']=='add') {echo 'Thêm thành công';}
                                    if ($_GET['msg']=='edit') {echo 'Cập nhập thành công';}
                                    if ($_GET['msg']=='error') {echo 'Có lỗi xảy ra';}
                                    ?>
                                </div>
                                <?php
                            }
                            ?>
                            <table class="table table-striped">
                                <thead>
                                <tr>
                                    <th> STT </th>
                                    <th> Khách hàng </th>
                                    <th> Tổng tiền</th>
                                    <th> Trạng thái  </th>
                                    <th> Chức Năng </th>
                                </tr>
                                </thead>
                                <tbody>
                                <?php
                                $sql = 'Select donhang.*,nguoidung.nguoidung from donhang inner join nguoidung on donhang.id_nguoidung= nguoidung.id_nguoidung';
                                $querySql = $database->fetch_sql($sql);
                                $stt=0;
                                while ($object = mysqli_fetch_assoc($querySql)) {
                                    $stt++;
                                    ?>
                                    <tr>
                                        <td><?php echo $stt;?></td>
                                        <td><?php echo $object['nguoidung']?></td>
                                        <td><?php echo $object['tongTien']?></td>
                                        <td><?php echo $object['trangThaiGiaoHang']?></td>
                                        <td>
                                            <a href="/admin/users/edit.php?id=<?php echo $object['id_nguoidung']?>" class="btn btn-behance">Chi tiết</a>
                                            <a href="/admin/users/del.php?id=<?php echo $object['id_nguoidung']?>" class="btn btn-danger">Xóa</a>
                                        </td>
                                    </tr>
                                <?php } ?>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
                </di>
            </div>
            </script>
            <!-- content-wrapper ends -->
            <?php include_once $_SERVER['DOCUMENT_ROOT'].'/templates/admin/inc/footer.php' ?>
