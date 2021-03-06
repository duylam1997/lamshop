<?php
include $_SERVER['DOCUMENT_ROOT'].'/functions/database.php';
$database = new database();

//add categories
if (isset($_GET['id']) && !empty($_GET['id'])) {
    $queryEdit = $database->fetch_id('danhmuc','id_danhmuc',$_GET['id']);
    $result = mysqli_fetch_assoc($queryEdit);
    if (isset($_POST['submit'])) {
        $editName = $_POST['tendanhmuc'];
        $sql = "Update danhmuc set tendanhmuc='{$editName}' where id_danhmuc={$_GET['id']}";
        $result = $database->fetch_sql($sql);
        if ($result) {
            header('Location:/admin/categories/?msg=edit');
        }
    }
}else {
    header('Location:/admin/categories/');
}
if (isset($_POST['cancel'])) {
    header('Location:/admin/categories/');
}

//header
include_once  $_SERVER['DOCUMENT_ROOT'].'/templates/admin/inc/header.php';
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
                <h4 class="page-title">Thêm danh mục</h4>
            </div>
        </div>
    </div>
    <!-- Page Title Header Ends-->
    <div class="row">
        <div class="col-lg-12 grid-margin stretch-card">
            <div class="row flex-grow">
                <div class="col-12">
                    <div class="card">
                        <div class="card-body">
                            <form class="forms-sample" method="post">
                                <div class="form-group">
                                    <label for="exampleInputEmail1">Tên danh muc</label>
                                    <input type="text" class="form-control" name="tendanhmuc" value="<?php echo $result['tendanhmuc']; ?>" >
                                </div>
                                <button type="submit" name="submit" class="btn btn-success mr-2">Sửa</button>
                                <button name="cancel" class="btn btn-pinterest">Quay lại</button>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- content-wrapper ends -->
<?php include_once $_SERVER['DOCUMENT_ROOT'].'/templates/admin/inc/footer.php' ?>