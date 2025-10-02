<?php
session_start();
    require_once 'config.php';
$std_id = (int)$_GET['id'];

$stmt = $conn->prepare("SELECT * FROM tb_664230050 WHERE std_id = ? ");
$stmt->execute([$std_id]);
$user = $stmt->fetch(PDO::FETCH_ASSOC);

$error = null;
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
$f_name = trim($_POST['f_name']);
$l_name = trim($_POST['l_name']);
$mail = trim($_POST['mail']);
if ($f_name === '' || $mail === '') {
$error = "กรุณากรอกข้อมูลให้ครบถ้วน";
} elseif (!filter_var($mail, FILTER_VALIDATE_EMAIL)) {
$error = "รูปแบบอีเมลไม่ถูกต้อง";
}
if (!$error) {
$chk = $conn->prepare("SELECT 1 FROM tb_664230050 WHERE (f_name = ? OR email = ?) AND user_id != ?");
$chk->execute([$username, $email, $user_id]);
if ($chk->fetch()) {
$error = "ชื่อผู้ใช้หรืออีเมลนี้มีอยู่แล้วในระบบ";
}
}
}
// สร ้ำง SQL UPDATE แบบยืดหยุ่น (ถ ้ำไม่เปลี่ยนรหัสผ่ำนจะไม่แตะ field password)
// เขียน update แบบปกต:ิ ถำ้ไมซ่ ้ำ -> ท ำ UPDATE
// if (!$error) {
// $upd = $pdo->prepare("UPDATE users SET username = ?, full_name = ?, email = ? WHERE user_id = ?");
// $upd->execute([$username, $full_name, $email, $user_id]);
// // TODO-11: redirect กลับหน้ำ users.php หลังอัปเดตส ำเร็จ
// header("Location: users.php");
// exit;
// }




// TODO-10: ถำ้ไมซ่ ้ำ -> ท ำ UPDATE
// SQL แนะน ำ:
// UPDATE users SET username = ?, full_name = ?, email = ? WHERE user_id = ?
// OPTIONAL: อัปเดตค่ำ $user เพอื่ สะทอ้ นคำ่ ทชี่ อ่ งฟอรม์ (หำกมีerror)
$user['f_name'] = $username;
$user['l_name'] = $full_name;
$user['email'] = $email;

?>

<!DOCTYPE html>
<html lang="th">
<head>
<meta charset="UTF-8">
<title>แก้ไขสมาชิก</title>
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
<link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css" rel="stylesheet">
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
<style>
    
</style>
</head>
<body class="container mt-4">
    <div class="card shadow-lg p-4">
        <h2 class="text-center mb-4"><i class="fas fa-user-edit me-2"></i>แก้ไขข้อมูลสมาชิก</h2>
        <a href="users.php" class="btn btn-secondary mb-3"><i class="fas fa-arrow-left me-1"></i>กลับหน้ารายชื่อสมาชิก</a>
        <?php if (isset($error)): ?>
        <div class="alert alert-danger"><i class="fas fa-exclamation-circle me-2"></i><?= htmlspecialchars($error) ?></div>
        <?php endif; ?>
        <form method="post" class="row g-3">
            <div class="col-md-6">
                <label class="form-label">ชื่อผู้ใช้</label> 
                <input type="text" name="username" class="form-control" required value="<?= htmlspecialchars($user['username']) ?>">
            </div>
            <div class="col-md-6">
                <label class="form-label">ชื่อ - นามสกุล</label>
                <input type="text" name="full_name" class="form-control" value="<?= htmlspecialchars($user['full_name']) ?>">
            </div>
            <div class="col-md-6">
                <label class="form-label">อีเมล</label>
                <input type="email" name="email" class="form-control" required value="<?= htmlspecialchars($user['email']) ?>">
            </div>
            <div class="col-12">
                <button type="submit" class="btn btn-primary"><i class="fas fa-save me-1"></i>บันทึกการแก้ไข</button>
            </div>
            <div class="col-md-6 mt-3">
                <label class="form-label">รหัสผ่านใหม่ <small class="text-muted">(ถ้าไม่ต้องการเปลี่ยนให้เว้นว่าง)</small></label>
                <input type="password" name="password" class="form-control">
            </div>
            <div class="col-md-6 mt-3">
                <label class="form-label">ยืนยันรหัสผ่านใหม่</label>
                <input type="password" name="confirm_password" class="form-control">
            </div>
        </form>
    </div>
</body>
</html>
