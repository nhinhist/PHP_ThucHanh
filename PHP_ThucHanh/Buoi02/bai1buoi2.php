<!DOCTYPE html>
<html lang="vi">

<head>
    <meta charset="UTF-8">
    <title>Bài 1 - Xếp loại điểm</title>
</head>

<body>

<h2>BÀI 1: XẾP LOẠI ĐIỂM</h2>

<form method="POST">

    <label>Nhập điểm:</label>

    <input type="number"
           name="diem"
           min="0"
           max="10"
           step="0.1"
           required>

    <button type="submit">Xếp loại</button>

</form>

<?php

if (isset($_POST["diem"])) {

    $diem = $_POST["diem"];

    if ($diem >= 8) {
        $xepLoai = "Giỏi";
    } elseif ($diem >= 6.5) {
        $xepLoai = "Khá";
    } elseif ($diem >= 5) {
        $xepLoai = "Trung bình";
    } else {
        $xepLoai = "Chưa đạt";
    }

    echo "<h3>Điểm: $diem</h3>";
    echo "<h3>Xếp loại: $xepLoai</h3>";
}

?>

</body>

</html>
