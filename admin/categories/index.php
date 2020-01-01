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
                        <h4 class="page-title">Quản Lý Danh Mục</h4>
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
                                    ?>
                                </div>
                                <?php
                            }
                            ?>
                            <div style="float: right">
                                <a href="/admin/categories/add.php" class="btn btn-primary">Thêm</a>
                            </div>
                            <table class="table table-striped">
                                <thead>
                                <tr>
                                    <th> STT </th>
                                    <th> Danh Mục </th>
                                    <th> Trạng Thái </th>
                                    <th> Chức Năng </th>
                                </tr>
                                </thead>
                                <tbody>
                                    <?php
                                        $danhmuc = $database->select_all_desc('danhmuc');
                                        $stt = 0;
                                        foreach ($danhmuc as $value) {
                                            $stt ++;
                                            ?>
                                            <tr>
                                                <td class="py-1">
                                                    <?php echo $stt;?>
                                                </td>
                                                <td> <?php echo $value['tendanhmuc']; $database->subcat($value['id_danhmuc']);?></td>
                                                <td>
                                                    <?php
                                                        if ($value['trangthai']==1) { ?>
                                                            <a href="/admin/categories/status.php?id=<?php echo $value['id_danhmuc']?>" class="btn btn-success" style="width: 60px">Ẩn</a>
                                                        <?php }else { ?>
                                                            <a href="/admin/categories/status.php?id=<?php echo $value['id_danhmuc']?>" class="btn btn-danger" style="width: 60px">Hiện</a>
                                                        <?php } ?>
                                                </td>
                                                <td>
                                                    <a href="/admin/categories/edit.php?id=<?php echo $value['id_danhmuc'] ?>" class="btn btn-dark">Sửa</a>
                                                    <a href="/admin/categories/del.php?id=<?php echo $value['id_danhmuc'] ?>" class="btn btn-behance">Xóa</a>
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
        <!-- content-wrapper ends -->
<?php include_once $_SERVER['DOCUMENT_ROOT'].'/templates/admin/inc/footer.php' ?>