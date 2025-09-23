<?php

require_once '../config.php';
require_once 'auth_admin.php'; 


// ตรวจสอบวำ่ ไดส้ ง่ id สนิ คำ้มำหรอื ไม่
if (!isset($_GET['id'])) {
header("Location: products.php");
exit;
}

$product_id = $_GET['id'];

//ดึงข้อมูลสินค้า
$stmt = $conn->prepare("SELECT * FROM products WHERE product_id = ?");
$stmt->execute([$product_id]);
$product = $stmt->fetch(PDO::FETCH_ASSOC);
if (!$product) {
echo "<h3> ไม่พบข้อมูลสินค้า </h3>";
exit;
}

// ดึงหมวดหมู่ทั้งหมด
$categories = $conn->query("SELECT * FROM categories")->fetchAll(PDO::FETCH_ASSOC);

// เมื่อมีการส่งฟอร์ม
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
$name = trim($_POST['product_name']);
$description = trim($_POST['description']);
$price = (float)$_POST['price'];
$stock = (int)$_POST['stock'];
$category_id = (int)$_POST['category_id'];

// ค่ำรูปเดิมจำกฟอร์ม
$oldImage = $_POST['old_image'] ?? null;
$removeImage = isset($_POST['remove_image']); // true/false
if ($name && $price > 0) {

// เตรียมตัวแปรรูปที่จะบันทึก
$newImageName = $oldImage; // default: คงรูปเดิมไว้
// 1) ถ ้ำมีติ๊ก "ลบรูปเดิม" → ตั้งให้เป็น null
if ($removeImage) {
$newImageName = null;
}
// 2) ถ ้ำมีอัปโหลดไฟล์ใหม่ → ตรวจแลว้เซฟไฟลแ์ละตัง้ชอื่ ใหมท่ ับคำ่
if (!empty($_FILES['product_image']['name'])) {
$file = $_FILES['product_image'];
// ตรวจชนิดไฟล์แบบง่ำย (แนะน ำ: ตรวจ MIME จริงด ้วย finfo)
$allowed = ['image/jpeg', 'image/png'];
if (in_array($file['type'], $allowed, true) && $file['error'] === UPLOAD_ERR_OK) {
// สรำ้งชอื่ ไฟลใ์หม่
$ext = strtolower(pathinfo($file['name'], PATHINFO_EXTENSION));
$newImageName = 'product_' . time() . '.' . $ext;
$uploadDir = realpath(__DIR__ . '/../product_images');
$destPath = $uploadDir . DIRECTORY_SEPARATOR . $newImageName;
// ย้ำยไฟล์อัปโหลด
if (!move_uploaded_file($file['tmp_name'], $destPath)) {
// ถ ้ำย้ำยไม่ได ้ อำจตั้ง flash message แลว้คงใชรู้ปเดมิ ไว ้
$newImageName = $oldImage;
}
}
}

// อัปเดต DB
$sql = "UPDATE products
SET product_name = ?, description = ?, price = ?, stock = ?, category_id = ?, image = ?
WHERE product_id = ?";
$args = [$name, $description, $price, $stock, $category_id, $newImageName, $product_id];
$stmt = $conn->prepare($sql);
$stmt->execute($args);
// ลบไฟล์เก่ำในดิสก์ ถ ้ำ:
// - มีรูปเดิม ($oldImage) และ
// - เกดิ กำรเปลยี่ นรปู (อัปโหลดใหมห่ รอื สั่งลบรปู เดมิ)
if (!empty($oldImage) && $oldImage !== $newImageName) {
$baseDir = realpath(__DIR__ . '/../product_images');
$filePath = realpath($baseDir . DIRECTORY_SEPARATOR . $oldImage);
if ($filePath && strpos($filePath, $baseDir) === 0 && is_file($filePath)) {
@unlink($filePath);
}
}
header("Location: products.php");
exit;
}
}
?>

<!DOCTYPE html>
<html lang="th">
<head>
    <meta charset="UTF-8">
    <title>แก้ไขสินค้า</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css" rel="stylesheet">
    <style>
        body {
            background: linear-gradient(135deg, #ff6b6b, #ee5a52);
            background-size: 400% 400%;
            animation: gradient-animation 15s ease infinite;
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
            min-height: 100vh;
        }
        @keyframes gradient-animation {
            0% { background-position: 0% 50%; }
            50% { background-position: 100% 50%; }
            100% { background-position: 0% 50%; }
        }
        .card {
            backdrop-filter: blur(10px);
            background: rgba(255, 255, 255, 0.95);
            border: none;
            border-radius: 20px;
            box-shadow: 0 20px 40px rgba(0, 0, 0, 0.1);
            transition: transform 0.3s ease;
        }
        .card:hover {
            transform: translateY(-5px);
        }
        .btn-secondary {
            background-color: #6c757d;
            border-color: #6c757d;
            transition: background-color 0.3s ease;
        }
        .btn-secondary:hover {
            background-color: #5c636a;
            border-color: #565e64;
        }
        .btn-primary {
            background-color: #0d6efd;
            border-color: #0d6efd;
            transition: background-color 0.3s ease;
        }
        .btn-primary:hover {
            background-color: #0b5ed7;
            border-color: #0a58ca;
        }
    </style>
</head>
<body class="container mt-4">
    <div class="card shadow-lg p-4">
        <h2><i class="fas fa-edit me-2"></i>แก้ไขสินค้า</h2>
        <a href="products.php" class="btn btn-secondary mb-3"><i class="fas fa-arrow-left me-1"></i>กลับไปยังรายการสินค้า</a>
        
        <form method="post" enctype="multipart/form-data" class="row g-3">
            <div class="col-md-6">
                <label class="form-label">ชื่อสินค้า</label>
                <input type="text" name="product_name" class="form-control" value="<?= htmlspecialchars($product['product_name']) ?>" required>
            </div>
            
            <div class="col-md-3">
                <label class="form-label">ราคา</label>
                <input type="number" step="0.01" name="price" class="form-control" value="<?= $product['price'] ?>" required>
            </div>
            <div class="col-md-3">
                <label class="form-label">จำนวนในคลัง</label>
                <input type="number" name="stock" class="form-control" value="<?= $product['stock']?>" required>
            </div>
            <div class="col-md-6">
                <label class="form-label">หมวดหมู่</label>
                <select name="category_id" class="form-select" required>
                    <option value="">เลือกหมวดหมู่</option>
                    <?php foreach ($categories as $cat): ?>
                    <option value="<?= $cat['category_id'] ?>" <?= ($product['category_id'] == $cat['category_id']) ? 'selected' : '' ?>>
                        <?= htmlspecialchars($cat['category_name']) ?>
                    </option>
                    <?php endforeach; ?>
                </select>
            </div>
            
            <div class="col-12">
                <label class="form-label">รายละเอียดสินค้า</label>
                <textarea name="description" class="form-control" rows="4"><?= htmlspecialchars($product['description']) ?></textarea>
            </div>
            
            <!-- แสดงรูปเดิม + เก็บค่าเก่า -->
            <div class="col-md-6">
                <label class="form-label d-block">รูปปัจจุบัน</label>
                <?php if (!empty($product['image'])): ?>
                <img src="../product_images/<?= htmlspecialchars($product['image']) ?>" width="120" height="120" class="rounded mb-2">
                <?php else: ?>
                <span class="text-muted d-block mb-2">ไม่มีรูป</span>
                <?php endif; ?>
                <input type="hidden" name="old_image" value="<?= htmlspecialchars($product['image']) ?>">
            </div>
            
            <!-- อัปโหลดรูปใหม่ (ทางเลือก) -->
            <div class="col-md-6">
                <label class="form-label">อัปโหลดรูปใหม่ (jpg, png)</label>
                <input type="file" name="product_image" class="form-control">
                <div class="form-check mt-2">
                    <input class="form-check-input" type="checkbox" name="remove_image" id="remove_image" value="1">
                    <label class="form-check-label" for="remove_image">ลบรูปเดิม</label>
                </div>
            </div>
            
            <div class="col-12">
                <button type="submit" class="btn btn-primary"><i class="fas fa-save me-1"></i>บันทึกการแก้ไข</button>
            </div>
        </form>
    </div>
</body>
</html>
