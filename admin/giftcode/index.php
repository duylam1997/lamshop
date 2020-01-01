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
                        <h4 class="page-title">Quản Lý Mã Khuyến Mãi</h4>
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
                            <div style="float: right">
                                <a href="/admin/giftcode/add.php" class="btn btn-primary">Thêm</a>
                            </div>
                            <table class="table table-striped">
                                <thead>
                                <tr>
                                    <th> STT </th>
                                    <th> Mã khuyến mãi </th>
                                    <th> Giá trị</th>
                                    <th> Số lượng  </th>
                                    <th> Thời gian </th>
                                    <th> Chức Năng </th>
                                </tr>
                                </thead>
                                <tbody>
                                <?php
                                $sql = 'Select * from makhuyenmai';
                                $querySql = $database->fetch_sql($sql);
                                $stt=0;
                                while ($object = mysqli_fetch_assoc($querySql)) {
                                    $stt++;
                                    ?>
                                    <tr>
                                        <td><?php echo $stt;?></td>
                                        <td><?php echo $object['maKM']?></td>
                                        <td><?php echo $object['qty']?></td>
                                        <td><?php echo $object['value']?></td>
                                        <td><?php echo date( "m/d/Y", strtotime($object['ngaybatdau'])) ?> đến <?php echo date( "m/d/Y", strtotime($object['ngayketthuc'])) ?></td>
                                        <td>
                                            <a href="/admin/giftcode/edit.php?id=<?php echo $object['id_km']?>" class="btn btn-behance">Sửa</a>
                                            <a href="/admin/giftcode/del.php?id=<?php echo $object['id_km']?>" class="btn btn-danger">Xóa</a>
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
            <script>
                $(document).ready(function () {
                    $('.qty-update').click(function () {
                        var id = $(this).data('id');
                        var qty = $('.qty-new').val();
                        $.ajax({
                            url: '/admin/products/updateqty.php',
                            type: 'POST',
                            data: {
                                'id' : id,
                                'qty' : qty
                            },
                            success: function(data){
                                $('#result-qty').html(data);
                                $('#form-qty').hide();
                                $('.modal-backdrop').hide();
                                $('.qty-new').val('');
                            },
                            error: function (){
                                alert('Có lỗi xảy ra');
                            }
                        });
                    })
                })
            </script>
            <!-- content-wrapper ends -->
            <?php include_once $_SERVER['DOCUMENT_ROOT'].'/templates/admin/inc/footer.php' ?>
