<?php


class database
{
    private $connect;
    private $servername = 'localhost';
    private $username = 'root';
    private $password = '';
    private $database = 'lshop';

    public function __construct()
    {
        $this->connect = new mysqli($this->servername,$this->username,$this->password,$this->database);
        $this->connect->set_charset('utf-8');
        if($this->connect->connect_error) {
            die('Không thể kết nối database'.$connect->connect_error);
        }
    }
    //select table danh muc id cha = 0
    public function select_all_desc($table) {
        $sql = "Select * from {$table} where id_dacap=0";
        $query = mysqli_query($this->connect,$sql);
        $data = [];
        if ($query) {
            while ($result = mysqli_fetch_assoc($query)) {
                $data[] =$result;
            }
        }
        return  $data;
    }
    public function fetch_sql($sql) {
        return $query = mysqli_query($this->connect,$sql);

    }
    //select id
    public function fetch_id($table,$column,$value) {
        $sql = "Select * from {$table} where {$column} = $value ";
        return $this->fetch_sql($sql);
    }
    //add sql
    //select qui menu
    public function subcat($id)
    {
        $sqlSub   = "select * from danhmuc where id_dacap={$id} ";
        $querysub = mysqli_query($this->connect,$sqlSub);
        while ($resultSub=mysqli_fetch_assoc($querysub)) {
            $namesub = $resultSub['tendanhmuc'];
            $catId   = $resultSub['id_danhmuc'];
            echo '<ul style="padding:10px 0 0 50px;">';
            echo '<li>'.$namesub.'
                         <a href="/admin/categories/editsub.php?id='.$catId.'" style="font-size: 12px" >Sửa</a> 
                         <a href="/admin/categories/del.php?id='.$catId.'" style="font-size: 12px" >Xóa</a>
                 </li>';
            $this->subcat($catId);
            echo '</ul>';
        }
    }
    //select option add-categories
    public function selectCat($id,$char='')
    {
        $sqlSub   = "select * from danhmuc where id_dacap={$id} ";
        $querysub = mysqli_query($this->content,$sqlSub);
        while ($resultSub=mysqli_fetch_assoc($querysub)) {
            $namesub = $resultSub['tendanhmuc'];
            $catId   = $resultSub['id_danhmuc'];
            echo '<option value="'.$catId.'"> [--] '.$char.$namesub.'</option>';
            $this->selectCat($catId,$char.'[--]');
        }
    }
    //del table
    public function delTable($table,$column,$id)
    {
        $sqlDel  = "delete from {$table} where {$column}={$id}";
        return $querySqldel = mysqli_query($this->connect,$sqlDel);
    }
    //dell all cat
    public function dellallCat($id)
    {
        $sql = 'Select * from danhmuc';
        $queryDel = $this->fetch_sql($sql);
        foreach ($queryDel as $resultDel){
            $idsub = $resultDel['id_dacap'];
            $idcat = $resultDel['id_danhmuc'];
            if ($idsub==$id) {
                $delSub = $this->delTable("danhmuc","id_dacap",$id);
                $this->dellallCat($idcat);
            }
        }
    }
    //page
    public function page($table,$idpage)
    {
        $sqlTSD     = "select count(*) as TSD from {$table}";
        $queryTSD   = mysqli_query($this->connect,$sqlTSD);
        $result     = mysqli_fetch_assoc($queryTSD);
        $TSD        = $result['TSD'];
        $row_count  = 5;
        $TSTRANG    = ceil($TSD/$row_count);
        $offset     = ($idpage -1)*$row_count;
        return
            $arPage =[
                'offset'    => $offset,
                'TST'       => $TSTRANG,
                'row' => $row_count,
            ];
    }
    //name img
    public function namePic($pic)
    {
        $duongDan    = $pic['tmp_name'];
        $ten         = $pic['name'];
        $ten         = explode('.',$ten);
        $duoi        = end($ten);
        $ten         = 'SHOP-'.time().'.'.$duoi;
        return $ten;
    }
    public function uploadPic($pic,$file,$namepic) {
        $duongDan    = $pic['tmp_name'];
        $ten         = $pic['name'];
        $ten         = explode('.',$ten);
        $duoi        = end($ten);
        $ten         = 'SHOP-'.time().'.'.$duoi;
        $duongDanMoi = $_SERVER['DOCUMENT_ROOT'].'/'.$file.'/'.$namepic;
        move_uploaded_file($duongDan,$duongDanMoi);
    }
}
