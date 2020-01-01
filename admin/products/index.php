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
                <h4 class="page-title">Quản Lý Sản Phẩm</h4>
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
                        <a href="/admin/products/add.php" class="btn btn-primary">Thêm</a>
                    </div>
                    <table class="table table-striped">
                        <thead>
                        <tr>
                            <th> STT </th>
                            <th> Sản Phẩm </th>
                            <th> Danh Mục </th>
                            <th> Hình Ảnh  </th>
                            <th> Số lượng </th>
                            <th> Giá      </th>
                            <th> Chức Năng </th>
                        </tr>
                        </thead>
                        <tbody>
                            <?php
                                $sql = 'Select sanpham.*,danhmuc.tendanhmuc from sanpham inner join danhmuc on sanpham.id_danhmuc = danhmuc.id_danhmuc';
                                $querySql = $database->fetch_sql($sql);
                                $stt=0;
                                while ($object = mysqli_fetch_assoc($querySql)) {
                                    $stt++;
                            ?>
                            <tr>
                                <td><?php echo $stt;?></td>
                                <td><?php echo $object['sanpham']?></td>
                                <td><?php echo $object['tendanhmuc']?></td>
                                <td>
                                    <img src="/file/<?php echo $object['hinhanh']?>" alt="" style="width: 100px;height: 100px">
                                </td>
                                <td>
                                    <p id="result-qty"><?php echo $object['soluong']?></p>
                                    <button class="btn btn-pinterest" data-toggle="modal" data-target="#form-qty">Thêm số lướng</button>
                                    <!--modal qty-->
                                    <div id="form-qty" class="modal fade" role="dialog">
                                        <div class="modal-dialog">
                                            <div class="modal-content">
                                                <div id="result-qty"></div>
                                                <div class="modal-header">
                                                    <h4 class="modal-title">Cập nhập số lượng</h4>
                                                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                                                </div>
                                                <div>
                                                    <form action="" method="post">
                                                        <div class="modal-body">
                                                            <div class="form-group">
                                                                <label for="">Nhâp số lượng</label>
                                                                <input type="number" class="form-control qty-new" name="qty-update" style="display: block;">
                                                            </div>
                                                        </div>
                                                        <div class="modal-footer">
                                                            <button type="button" class="btn btn-primary qty-update" data-id="<?php echo $object['id_sanpham'] ?>" >Cập nhập</button>
                                                            <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                                                        </div>
                                                    </form>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <!--modal qty-->
                                </td>
                                <td><?php echo number_format($object['gia'])?></td>
                                <td>
                                    <a href="" class="btn btn-info" data-toggle="modal" data-target="#myModal">Chi tiết</a>
                                    <!--form modal-->
                                    <div class="modal fade" id="myModal" role="dialog">
                                        <div class="modal-dialog">
                                            <!-- Modal content-->
                                            <div class="modal-content">
                                                <div class="modal-header">
                                                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                                                </div>
                                                <div class="modal-body">
                                                    <p>Tên sản phẩm: <?php echo $object['sanpham']?></p>
                                                    <p>Danh muc: <?php echo $object['tendanhmuc']?></p>
                                                    <p>Hình ảnh: <img src="/file/<?php echo $object['hinhanh']?>" style="width: 100px;height: 100px" alt=""></p>
                                                    <p>Giá: <?php echo $object['gia']?></p>
                                                    <p>Số lượng: <?php echo $object['soluong']?></p>
                                                    <p>Mô tả: <?php echo $object['mota']?></p>
                                                    <p>Chi tiết: <?php echo $object['chitiet']?></p>
                                                </div>
                                                <div class="modal-footer">
                                                    <button type="button" class="btn btn-default" data-dismiss="modal">Đóng</button>
                                                </div>
                                            </div>

                                        </div>
                                    </div>
                                    <a href="/admin/products/edit.php?id=<?php echo $object['id_sanpham']?>" class="btn btn-behance">Sửa</a>
                                    <a href="/admin/products/del.php?id=<?php echo $object['id_sanpham']?>" class="btn btn-danger">Xóa</a>
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
