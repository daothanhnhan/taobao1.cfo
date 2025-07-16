tạo một đương link đên file hoadon.php trong chi tiết hóa đơn
ví dụ: http://a-zcanvas.com/admin/template/excel/hoadon.php?id=76
<a href="/admin/template/excel/hoadon.php?id=<?= $rowOrder['id_cart'] ?>">Xuất hóa đơn</a> (thêm dòng code này vào vị trí cần xuất hóa đon)

một file thông tin bằng excel sẽ tự động download.
thư mục excel để trong thư mục template