<?php
$hoTen = "";
$email = "";
$chuDe = "Hỗ trợ kỹ thuật";
$noiDung = "";

$errors = [];
$success = "";

if ($_SERVER["REQUEST_METHOD"] == "POST") {

    // Lấy dữ liệu từ form
    $hoTen = trim($_POST["hoTen"] ?? "");
    $email = trim($_POST["email"] ?? "");
    $chuDe = $_POST["chuDe"] ?? "Hỗ trợ kỹ thuật";
    $noiDung = trim($_POST["noiDung"] ?? "");

    /* =========================
       1. KIỂM TRA HỌ TÊN
       ========================= */
    if ($hoTen == "") {
        $errors["hoTen"] = "Họ tên không được để trống.";
    }

    /* =========================
       2. KIỂM TRA EMAIL
       ========================= */
    if ($email == "") {
        $errors["email"] = "Email không được để trống.";
    } elseif (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        $errors["email"] = "Email không đúng định dạng.";
    }

    /* =========================
       3. KIỂM TRA NỘI DUNG
       ========================= */
    $doDaiNoiDung = mb_strlen($noiDung);

    if ($noiDung == "") {
        $errors["noiDung"] = "Nội dung không được để trống.";
    } elseif ($doDaiNoiDung < 10 || $doDaiNoiDung > 500) {
        $errors["noiDung"] = "Nội dung phải từ 10 đến 500 ký tự.";
    }

    /* =========================
       4. KIỂM TRA ẢNH
       ========================= */
    if (
        isset($_FILES["anhDaiDien"]) &&
        $_FILES["anhDaiDien"]["error"] != UPLOAD_ERR_NO_FILE
    ) {

        $file = $_FILES["anhDaiDien"];

        // Kiểm tra lỗi upload
        if ($file["error"] != UPLOAD_ERR_OK) {
            $errors["anhDaiDien"] = "Có lỗi khi tải ảnh lên.";
        } else {

            // Kiểm tra phần mở rộng
            $duoiFile = strtolower(
                pathinfo($file["name"], PATHINFO_EXTENSION)
            );

            $dinhDangChoPhep = [
                "jpg",
                "jpeg",
                "png",
                "gif"
            ];

            if (!in_array($duoiFile, $dinhDangChoPhep)) {
                $errors["anhDaiDien"] =
                    "Chỉ chấp nhận JPG, JPEG, PNG hoặc GIF.";
            }

            // Kiểm tra dung lượng
            if ($file["size"] > 2 * 1024 * 1024) {
                $errors["anhDaiDien"] =
                    "Ảnh không được lớn hơn 2MB.";
            }
        }
    }

    /* =========================
       5. NẾU KHÔNG CÓ LỖI
       ========================= */
    if (empty($errors)) {

        // Nếu có upload ảnh
        if (
            isset($_FILES["anhDaiDien"]) &&
            $_FILES["anhDaiDien"]["error"] == UPLOAD_ERR_OK
        ) {

            // Tạo thư mục uploads
            if (!is_dir("uploads")) {
                mkdir("uploads", 0777, true);
            }

            // Tạo tên file mới
            $tenFile =
                time() . "_" .
                basename($_FILES["anhDaiDien"]["name"]);

            $duongDan = "uploads/" . $tenFile;

            move_uploaded_file(
                $_FILES["anhDaiDien"]["tmp_name"],
                $duongDan
            );
        }

        $success = "Gửi liên hệ thành công!";

        // Xóa dữ liệu sau khi gửi thành công
        $hoTen = "";
        $email = "";
        $chuDe = "Hỗ trợ kỹ thuật";
        $noiDung = "";
    }
}
?>

<!DOCTYPE html>
<html lang="vi">

<head>

    <meta charset="UTF-8">

    <meta name="viewport"
          content="width=device-width, initial-scale=1.0">

    <title>Liên hệ</title>

    <style>

        * {
            box-sizing: border-box;
        }

        body {
            margin: 0;
            background: #f1f3f5;
            font-family: Arial, Helvetica, sans-serif;
        }

        /* Khung form */
        .form-container {
            width: 630px;
            max-width: 95%;
            margin: 20px auto;
            padding: 32px;
            background: white;
            border-radius: 14px;
            box-shadow: 0 2px 10px rgba(0, 0, 0, 0.08);
        }

        /* Tiêu đề */
        h1 {
            text-align: center;
            color: #174f7c;
            font-size: 32px;
            margin: 0 0 16px;
        }

        .description {
            text-align: center;
            color: #777;
            font-size: 16px;
            margin-bottom: 32px;
        }

        /* Label */
        label {
            display: block;
            font-size: 16px;
            font-weight: bold;
            color: #333;
            margin-bottom: 8px;
            margin-top: 20px;
        }

        /* Input */
        input,
        select,
        textarea {
            width: 100%;
            padding: 12px;
            border: 1px solid #d2d2d2;
            border-radius: 7px;
            font-size: 16px;
            font-family: Arial, sans-serif;
        }

        input,
        select {
            height: 43px;
        }

        input:focus,
        select:focus,
        textarea:focus {
            outline: none;
            border-color: #2185d0;
            box-shadow: 0 0 3px rgba(33, 133, 208, 0.5);
        }

        textarea {
            height: 134px;
            resize: vertical;
        }

        /* Ô lỗi */
        .input-error {
            border: 1px solid red !important;
            background: #fff5f5;
        }

        /* Thông báo lỗi */
        .error {
            color: #ef3e3e;
            font-size: 14px;
            margin-top: 8px;
        }

        /* Gợi ý */
        .note {
            color: #777;
            font-size: 13px;
            margin-top: 7px;
        }

        /* Upload */
        .file-input {
            padding: 9px;
            background: #fafafa;
        }

        /* Thành công */
        .success {
            background: #e1f5e9;
            border: 1px solid #35a866;
            color: #188044;
            padding: 12px;
            border-radius: 7px;
            text-align: center;
            margin-bottom: 20px;
        }

        /* Nút gửi */
        button {
            width: 100%;
            height: 44px;
            margin-top: 22px;
            border: none;
            border-radius: 7px;
            background: #287bbd;
            color: white;
            font-size: 16px;
            font-weight: bold;
            cursor: pointer;
        }

        button:hover {
            background: #216ca8;
        }

        /* Responsive */
        @media (max-width: 600px) {

            .form-container {
                padding: 25px 20px;
                margin: 10px auto;
            }

            h1 {
                font-size: 28px;
            }

        }

    </style>

</head>

<body>

<div class="form-container">

    <h1>Liên hệ</h1>

    <div class="description">
        Vui lòng nhập đầy đủ thông tin bên dưới.
    </div>

    <!-- Thông báo thành công -->
    <?php if ($success != ""): ?>

        <div class="success">
            <?php echo htmlspecialchars($success); ?>
        </div>

    <?php endif; ?>


    <form method="POST"
          enctype="multipart/form-data">

        <!-- ================= HỌ TÊN ================= -->

        <label for="hoTen">
            Họ tên
        </label>

        <input
            type="text"
            id="hoTen"
            name="hoTen"
            value="<?php echo htmlspecialchars($hoTen); ?>"
            placeholder="Nhập họ tên"
            class="<?php
                echo isset($errors["hoTen"])
                    ? "input-error"
                    : "";
            ?>"
        >

        <?php if (isset($errors["hoTen"])): ?>

            <div class="error">
                <?php echo $errors["hoTen"]; ?>
            </div>

        <?php endif; ?>


        <!-- ================= EMAIL ================= -->

        <label for="email">
            Email
        </label>

        <input
            type="email"
            id="email"
            name="email"
            value="<?php echo htmlspecialchars($email); ?>"
            placeholder="example@gmail.com"
            class="<?php
                echo isset($errors["email"])
                    ? "input-error"
                    : "";
            ?>"
        >

        <?php if (isset($errors["email"])): ?>

            <div class="error">
                <?php echo $errors["email"]; ?>
            </div>

        <?php endif; ?>


        <!-- ================= CHỦ ĐỀ ================= -->

        <label for="chuDe">
            Chủ đề
        </label>

        <select id="chuDe" name="chuDe">

            <option value="Hỗ trợ kỹ thuật"
                <?php
                if ($chuDe == "Hỗ trợ kỹ thuật")
                    echo "selected";
                ?>>
                Hỗ trợ kỹ thuật
            </option>

            <option value="Góp ý"
                <?php
                if ($chuDe == "Góp ý")
                    echo "selected";
                ?>>
                Góp ý
            </option>

            <option value="Hỏi đáp"
                <?php
                if ($chuDe == "Hỏi đáp")
                    echo "selected";
                ?>>
                Hỏi đáp
            </option>

            <option value="Khác"
                <?php
                if ($chuDe == "Khác")
                    echo "selected";
                ?>>
                Khác
            </option>

        </select>


        <!-- ================= NỘI DUNG ================= -->

        <label for="noiDung">
            Nội dung
        </label>

        <textarea
            id="noiDung"
            name="noiDung"
            placeholder="Nhập nội dung liên hệ..."
            class="<?php
                echo isset($errors["noiDung"])
                    ? "input-error"
                    : "";
            ?>"
        ><?php echo htmlspecialchars($noiDung); ?></textarea>


        <?php if (isset($errors["noiDung"])): ?>

            <div class="error">
                <?php echo $errors["noiDung"]; ?>
            </div>

        <?php else: ?>

            <div class="note">
                Nội dung phải từ 10 đến 500 ký tự.
            </div>

        <?php endif; ?>


        <!-- ================= ẢNH ĐẠI DIỆN ================= -->

        <label for="anhDaiDien">
            Ảnh đại diện
        </label>

        <input
            type="file"
            id="anhDaiDien"
            name="anhDaiDien"
            accept=".jpg,.jpeg,.png,.gif"
            class="file-input"
        >

        <div class="note">
            JPG, JPEG, PNG, GIF - tối đa 2MB.
        </div>

        <?php if (isset($errors["anhDaiDien"])): ?>

            <div class="error">
                <?php echo $errors["anhDaiDien"]; ?>
            </div>

        <?php endif; ?>


        <!-- ================= NÚT GỬI ================= -->

        <button type="submit">
            Gửi liên hệ
        </button>

    </form>

</div>

</body>
</html>