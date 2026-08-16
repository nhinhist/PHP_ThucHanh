<?php

session_start();

/*
    Tạo mảng lưu danh sách bài viết.
    Session giúp dữ liệu không bị mất ngay khi tải lại trang.
*/

if (!isset($_SESSION["danhSachBaiViet"])) {
    $_SESSION["danhSachBaiViet"] = [];
}


/*
    Hàm xác định trạng thái bài viết
    dựa vào vai trò của người đăng.
*/

function xacDinhTrangThai($vaiTro)
{
    if ($vaiTro == "Tác giả") {
        return "Chờ kiểm duyệt";
    } elseif ($vaiTro == "Biên tập viên") {
        return "Đã duyệt";
    } elseif ($vaiTro == "Quản trị viên") {
        return "Đã xuất bản";
    } else {
        return "Chưa xác định";
    }
}


/*
    Xử lý dữ liệu khi người dùng nhấn nút Đăng bài.
*/

if (isset($_POST["dangBai"])) {

    $tieuDe = $_POST["tieuDe"];
    $tacGia = $_POST["tacGia"];
    $chuyenMuc = $_POST["chuyenMuc"];
    $vaiTro = $_POST["vaiTro"];
    $noiDung = $_POST["noiDung"];

    // Xác định trạng thái bài viết
    $trangThai = xacDinhTrangThai($vaiTro);

    // Tổ chức dữ liệu bằng mảng
    $baiViet = [
        "tieuDe" => $tieuDe,
        "tacGia" => $tacGia,
        "chuyenMuc" => $chuyenMuc,
        "vaiTro" => $vaiTro,
        "noiDung" => $noiDung,
        "trangThai" => $trangThai
    ];

    // Thêm bài viết vào danh sách
    $_SESSION["danhSachBaiViet"][] = $baiViet;

    $thongBao = "Thêm bài viết thành công!";
}

?>

<!DOCTYPE html>
<html lang="vi">

<head>

    <meta charset="UTF-8">

    <meta name="viewport"
          content="width=device-width, initial-scale=1.0">

    <title>HNMU News - Quản lý bài viết</title>

    <style>

        * {
            box-sizing: border-box;
        }

        body {
            font-family: Arial, sans-serif;
            background-color: #f2f4f7;
            margin: 0;
            padding: 30px;
        }

        .container {
            width: 1000px;
            max-width: 95%;
            margin: auto;
            background-color: white;
            padding: 30px;
            border-radius: 15px;
            box-shadow: 0 0 10px #ccc;
        }

        .header {
            text-align: center;
            margin-bottom: 30px;
        }

        .header h1 {
            margin-bottom: 10px;
            color: #333;
        }

        .header p {
            color: #666;
        }

        h2 {
            color: #333;
            border-bottom: 2px solid #ddd;
            padding-bottom: 10px;
        }

        label {
            display: block;
            margin-top: 15px;
            margin-bottom: 5px;
            font-weight: bold;
        }

        input,
        select,
        textarea {
            width: 100%;
            padding: 10px;
            border: 1px solid #ccc;
            border-radius: 6px;
            font-size: 15px;
        }

        textarea {
            height: 150px;
            resize: vertical;
        }

        button {
            margin-top: 20px;
            padding: 12px 25px;
            border: none;
            border-radius: 6px;
            background-color: #333;
            color: white;
            font-size: 15px;
            cursor: pointer;
        }

        button:hover {
            background-color: #555;
        }

        .thongbao {
            margin-top: 20px;
            padding: 15px;
            background-color: #e8f5e9;
            border-radius: 6px;
            color: #2e7d32;
            font-weight: bold;
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
            text-align: left;
            vertical-align: top;
        }

        th {
            background-color: #eeeeee;
            text-align: center;
        }

        .trang-thai {
            font-weight: bold;
        }

        .noi-dung {
            max-width: 250px;
        }

    </style>

</head>

<body>

<div class="container">

    <div class="header">

        <h1>HNMU NEWS</h1>

        <p>
            Cổng thông tin tin tức dành cho khoa và câu lạc bộ
        </p>

    </div>


    <h2>Đăng bài viết</h2>


    <form method="POST">

        <label for="tieuDe">
            Tiêu đề bài viết:
        </label>

        <input
            type="text"
            id="tieuDe"
            name="tieuDe"
            placeholder="Nhập tiêu đề bài viết"
            required
        >


        <label for="tacGia">
            Tác giả:
        </label>

        <input
            type="text"
            id="tacGia"
            name="tacGia"
            placeholder="Nhập tên tác giả"
            required
        >


        <label for="chuyenMuc">
            Chuyên mục:
        </label>

        <select
            id="chuyenMuc"
            name="chuyenMuc"
        >

            <option value="Tin tức">
                Tin tức
            </option>

            <option value="Công nghệ">
                Công nghệ
            </option>

            <option value="Sự kiện">
                Sự kiện
            </option>

            <option value="Hoạt động CLB">
                Hoạt động CLB
            </option>

        </select>


        <label for="vaiTro">
            Vai trò người đăng:
        </label>

        <select
            id="vaiTro"
            name="vaiTro"
        >

            <option value="Tác giả">
                Tác giả
            </option>

            <option value="Biên tập viên">
                Biên tập viên
            </option>

            <option value="Quản trị viên">
                Quản trị viên
            </option>

        </select>


        <label for="noiDung">
            Nội dung bài viết:
        </label>

        <textarea
            id="noiDung"
            name="noiDung"
            placeholder="Nhập nội dung bài viết..."
            required
        ></textarea>


        <button
            type="submit"
            name="dangBai"
        >
            Đăng bài
        </button>

    </form>


    <?php

    if (isset($thongBao)) {

        echo "<div class='thongbao'>";
        echo $thongBao;
        echo "</div>";

    }

    ?>


    <h2>Danh sách bài viết</h2>


    <table>

        <tr>

            <th>STT</th>

            <th>Tiêu đề</th>

            <th>Tác giả</th>

            <th>Chuyên mục</th>

            <th>Vai trò</th>

            <th>Trạng thái</th>

            <th>Nội dung</th>

        </tr>


        <?php

        $stt = 1;

        foreach ($_SESSION["danhSachBaiViet"] as $baiViet) {

        ?>

        <tr>

            <td>
                <?php echo $stt; ?>
            </td>

            <td>
                <?php echo htmlspecialchars($baiViet["tieuDe"]); ?>
            </td>

            <td>
                <?php echo htmlspecialchars($baiViet["tacGia"]); ?>
            </td>

            <td>
                <?php echo $baiViet["chuyenMuc"]; ?>
            </td>

            <td>
                <?php echo $baiViet["vaiTro"]; ?>
            </td>

            <td class="trang-thai">
                <?php echo $baiViet["trangThai"]; ?>
            </td>

            <td class="noi-dung">
                <?php echo htmlspecialchars($baiViet["noiDung"]); ?>
            </td>

        </tr>

        <?php

            $stt++;

        }

        ?>

    </table>

</div>

</body>

</html>
