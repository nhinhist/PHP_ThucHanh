<?php

// Mảng lưu danh sách khóa học
$danhSachKhoaHoc = [];

// Hàm xác định mức học phí
function xacDinhHocPhi($tinChi)
{
    if ($tinChi >= 3) {
        return "Học phí cao";
    } else {
        return "Học phí cơ bản";
    }
}

// Kiểm tra người dùng đã nhấn nút Thêm chưa
if (isset($_POST["them"])) {

    $tenKhoaHoc = $_POST["tenKhoaHoc"];
    $tinChi = $_POST["tinChi"];
    $loaiHocPhan = $_POST["loaiHocPhan"];

    $khoaHoc = [
        "ten" => $tenKhoaHoc,
        "tinChi" => $tinChi,
        "loai" => $loaiHocPhan,
        "hocPhi" => xacDinhHocPhi($tinChi)
    ];

    // Thêm khóa học vào mảng
    $danhSachKhoaHoc[] = $khoaHoc;
}

?>

<!DOCTYPE html>
<html lang="vi">

<head>

    <meta charset="UTF-8">

    <meta name="viewport"
          content="width=device-width, initial-scale=1.0">

    <title>Quản lý khóa học</title>

    <style>

        body {
            font-family: Arial, sans-serif;
            background-color: #f2f2f2;
            margin: 0;
            padding: 40px;
        }

        .container {
            width: 800px;
            max-width: 95%;
            margin: auto;
            background-color: white;
            padding: 30px;
            border-radius: 15px;
            box-shadow: 0 0 10px #ccc;
        }

        h1 {
            text-align: center;
            color: #333;
        }

        h2 {
            color: #444;
        }

        label {
            display: block;
            margin-top: 15px;
            margin-bottom: 5px;
            font-weight: bold;
        }

        input,
        select {
            width: 100%;
            padding: 10px;
            box-sizing: border-box;
            border: 1px solid #ccc;
            border-radius: 5px;
        }

        button {
            margin-top: 20px;
            padding: 10px 25px;
            border: none;
            border-radius: 5px;
            background-color: #333;
            color: white;
            cursor: pointer;
        }

        button:hover {
            background-color: #555;
        }

        table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 20px;
        }

        th,
        td {
            border: 1px solid #ccc;
            padding: 10px;
            text-align: center;
        }

        th {
            background-color: #eee;
        }

        .thongbao {
            margin-top: 20px;
            padding: 15px;
            background-color: #f5f5f5;
            border-radius: 5px;
        }

    </style>

</head>

<body>

<div class="container">

    <h1>QUẢN LÝ KHÓA HỌC</h1>

    <h2>Nhập thông tin khóa học</h2>

    <form method="POST">

        <label>Tên khóa học:</label>

        <input
            type="text"
            name="tenKhoaHoc"
            placeholder="Nhập tên khóa học"
            required
        >

        <label>Số tín chỉ:</label>

        <input
            type="number"
            name="tinChi"
            min="1"
            required
        >

        <label>Loại học phần:</label>

        <select name="loaiHocPhan">

            <option value="Bắt buộc">
                Bắt buộc
            </option>

            <option value="Tự chọn">
                Tự chọn
            </option>

        </select>

        <button type="submit" name="them">
            Thêm khóa học
        </button>

    </form>


    <?php if (isset($_POST["them"])): ?>

        <div class="thongbao">

            Đã thêm khóa học thành công!

        </div>

    <?php endif; ?>


    <h2>Danh sách khóa học</h2>

    <table>

        <tr>

            <th>STT</th>

            <th>Tên khóa học</th>

            <th>Số tín chỉ</th>

            <th>Loại học phần</th>

            <th>Mức học phí</th>

        </tr>

        <?php

        $stt = 1;

        foreach ($danhSachKhoaHoc as $khoaHoc):

        ?>

        <tr>

            <td>
                <?php echo $stt; ?>
            </td>

            <td>
                <?php echo $khoaHoc["ten"]; ?>
            </td>

            <td>
                <?php echo $khoaHoc["tinChi"]; ?>
            </td>

            <td>
                <?php echo $khoaHoc["loai"]; ?>
            </td>

            <td>
                <?php echo $khoaHoc["hocPhi"]; ?>
            </td>

        </tr>

        <?php

            $stt++;

        endforeach;

        ?>

    </table>

</div>

</body>

</html>
