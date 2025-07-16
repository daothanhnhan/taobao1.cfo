<?php
    // $rows = $acc->getList("dang_ky_goi","","","id","desc",$trang, 20, "dang-ky-goi");//var_dump($rows);
    function filter_phone ($q) {
        $limit = 20;
        global $conn_vn;
        $q = trim($q);
        $sql = "SELECT * FROM user1 INNER JOIN dang_ky_goi ON user1.id = dang_ky_goi.user_id WHERE user1.phone LIKE '%$q%'";//echo $sql;
        $result = mysqli_query($conn_vn, $sql);
        $num = mysqli_num_rows($result);

        if (isset($_GET['trang'])) {
            $trang = $_GET['trang'];
            $start = ($trang-1)*$limit;
        } else {
            $trang = 1;
            $start = 0;
        }

        $sql = "SELECT * FROM user1 INNER JOIN dang_ky_goi ON user1.id = dang_ky_goi.user_id WHERE user1.phone LIKE '%$q%'  Limit $start,$limit";
        // echo $sql;
        $result = mysqli_query($conn_vn, $sql);
        $rows['data'] = array();
        while ($row = mysqli_fetch_assoc($result)) {
            $rows['data'][] = $row;//echo '1';
        }
// echo $trang;
        $config = array(
                'current_page'  => $trang, // Trang hiện tại
                'total_record'  => $num, // Tổng số record
                'total_page'    => 1, // Tổng số trang
                'limit'         => $limit,// limit
                'start'         => 0, // start
                'link_full'     => 'index.php?page=dang-ky-goi&search='.$q.'&trang={trang}',// Link full có dạng như sau: domain/com/page/{page}
                'link_first'    => 'index.php?page=dang-ky-goi&search='.$q,// Link trang đầu tiên
                'range'         => 9, // Số button trang bạn muốn hiển thị 
                'min'           => 0, // Tham số min
                'max'           => 0  // tham số max, min và max là 2 tham số private
            );

            $pagination = new Pagination;
            $pagination->init($config);

        $rows['paging'] = $pagination->htmlPaging();

        return $rows;
    }

    if (isset($_GET['search']) && $_GET['search'] != '') {
        // $rows = $action->getSearchAdmin('dang_ky_goi',array('phone'), $_GET['search'],$trang,20,$_GET['page']);
        $rows = filter_phone($_GET['search']);
    }else{
        // echo '<pre>';
        $rows = $acc->getList("dang_ky_goi","","","id","desc",$trang, 20, "dang-ky-goi");//var_dump($rows);
    }
    // echo '<pre>';
    // var_dump($rows);
?>	
    <div class="boxPageNews">
        <div class="searchBox">
            <form action="">
                <input type="hidden" name="page" value="dang-ky-goi" required="">
                <button type="submit" class="btnSearchBox" name="">Tìm kiếm</button>
                <input type="text" class="txtSearchBox" name="search" />                                    
            </form>
        </div>
        <!-- <h1><a href="index.php?page=them-thuong-hieu">Thêm</a></h1> -->
        <table class="table table-hover">
            <thead>
                <tr>
                    <th>STT</th>
                    <th>Số điện thoại</th>
                    <th>Gói</th>
                    <th>Kích Hoạt</th>
                    <th>Mã</th>
                </tr>
            </thead>
            <tbody>
                <?php 
                    $d = 0;
                    foreach ($rows['data'] as $row) {
                        $d++;
                        $user = $action->getDetail('user1', 'id', $row['user_id']);
                    ?>
                        <tr>
                            <td><?= $d ?></td>
                            <td><?= $user['phone']?></td>
                            <td>
                                <?= $row['goi']?>
                            </td>
                            <td>
                                <input type="checkbox" name="" onclick="kich_hoat(<?= $row['id'] ?>)" <?= $row['state']==1 ? 'checked' : '' ?> >
                            </td>
                            <!-- <td style="float: none;"><a href="index.php?page=xoa-thuong-hieu&id=<?= $row['id'] ?>" style="float: none;" onclick="return confirm('Bạn có chắc muốn xóa.')">Xóa</a> | <a href="index.php?page=sua-thuong-hieu&id=<?= $row['id'] ?>" style="float: none;">Sửa</a></td> -->
                            <td>CAF2LI<?= $row['id'] ?></td>
                        </tr>
                    <?php
                    }
                ?>
            </tbody>
        </table>
    	
        <div class="paging">             
        	<?= $rows['paging'] ?>
		</div>
    </div>
    <p class="footerWeb">Cảm ơn quý khách hàng đã tin dùng dịch vụ của chúng tôi<br />Sản phẩm thuộc Công ty TNHH Phát Triển Thương Hiệu Cafe Link Việt Nam</p>             

<script>
    function kich_hoat (id) {
        // alert(id);
        const xhttp = new XMLHttpRequest();
          xhttp.onload = function() {
            // document.getElementById("demo").innerHTML = this.responseText;
                alert(this.responseText);
            }
          xhttp.open("GET", "/functions/ajax/kich_hoat.php?id="+id, true);
          xhttp.send();
    }
</script>