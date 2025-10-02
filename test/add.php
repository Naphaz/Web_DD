<?php
    require_once 'config.php';
    $error = [];    
        if($_SERVER['REQUEST_METHOD'] == 'POST'){
            $std_id = trim($_POST['std_id']);
            $nickname = trim($_POST['nickname']);
            $f_name = trim($_POST['f_name']);
            $l_name = trim($_POST['l_name']);
            $mail = trim($_POST['mail']);
            $tel = trim($_POST['tel']);
            if(empty($std_id)||empty($nickname)||empty($f_name)||empty($l_name)||empty($mail)||empty($tel)){
                $error[] = "กรุณากรอกข้อมูลให้ครบทุกช่อง";
            }else{
                $sql = "SELECT * FROM tb_664230050 WHERE std_id = ? OR mail = ?";
                $stmt = $conn->prepare($sql);
                $stmt->execute([$std_id, $mail]);
                if($stmt->rowCount() > 0 ){
                    $error[] = "รหัสนักศึกษาหรืออีเมลนี้ถูกใช้ไปแล้ว";
                }
            }
            if(empty($error)){
                $sql = "INSERT INTO tb_664230050(std_id, nickname, f_name ,l_name,mail,tel) VALUES (?, ?, ?, ?,?,?)";
                $stmt = $conn->prepare($sql);
                $stmt->execute([$std_id, $nickname, $f_name, $l_name,$mail,$tel]);
                header ("Location: index.php ? Add=success");
                exit();
            }   
        }
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Add</title>
     <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.7/dist/css/bootstrap.min.css">
    <!-- DataTable CSS -->
    <link href="https://cdn.datatables.net/2.0.8/css/dataTables.dataTables.min.css" rel="stylesheet">
    <!-- jQuery -->
    <script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>
</head>

<body>
        <div class="container d-flex justify-content-center align-items-center min-vh-100">
            <div class="card shadow-lg p-4 w-100" style="max-width: 500px;">
                <h2 class="mb-0 text-center text-primary">เพิ่มนักศึกษา</h2>
                <?php if (!empty($error)): // ถ ้ำมีข ้อผิดพลำด ให้แสดงข ้อควำม ?>
                    <div class="alert alert-danger">
                    <ul>
                    <?php foreach ($error as $e): ?>
                    <li><?= htmlspecialchars($e) ?></li>
                    <!-- ใช ้ htmlspecialchars เพื่อป้องกัน XSS -->
                    <!-- < ? = คือ short echo tag ?> -->
                    <!-- ถ ้ำเขียนเต็ม จะได ้แบบด ้ำนล่ำง -->
                    <?php // echo "<li>" . htmlspecialchars($e) . "</li>"; ?>
                    <?php endforeach; ?>
                    </ul>
                    </div>
                    <?php endif; ?>
                 <form action="add.php" method="post">
                        <div class="mb-3">
                            <label for="std_id" class="form-label">รหัสนักศึกษา</label>
                            <div class="input-group">
                                <span class="input-group-text bg-light border-end-0">
                                    <i class="fas fa-user text-danger"></i>
                                </span>
                                <input type="text" name="std_id" id="std_id" class="form-control border-start-0" placeholder="เช่น 664230050" value="<?= isset($_POST['std_id']) ? htmlspecialchars($_POST['std_id']) : '' ?>" required>
                            </div>
                        </div> 
                        <div class="mb-3">
                            <label for="fname" class="form-label">ชื่อเล่น</label>
                            <div class="input-group">
                                <span class="input-group-text bg-light border-end-0">
                                    <i class="fas fa-id-card text-danger"></i>
                                </span>
                                <input type="text" name="nickname" id="nickname" class="form-control border-start-0" placeholder="ชื่อเล่น" value="<?= isset($_POST['nickname']) ? htmlspecialchars($_POST['nickname']) : '' ?>" required>
                        </div>
                        </div>
                        <div class="mb-3">
                            <label for="f_name" class="form-label">ชื่อ</label>
                            <div class="input-group">
                                <span class="input-group-text bg-light border-end-0">
                                    <i class="fas fa-id-card text-danger"></i>
                                </span>
                                <input type="text" name="f_name" id="f_name" class="form-control border-start-0" placeholder="ชื่อ" value="<?= isset($_POST['f_name']) ? htmlspecialchars($_POST['f_name']) : '' ?>" required>
                            </div>
                        </div>
                       
                        <div class="mb-3">
                            <label for="l_name" class="form-label">นามสกุล</label>
                            <div class="input-group">
                                <span class="input-group-text bg-light border-end-0">
                                    <i class="fas fa-id-card text-danger"></i>
                                </span>
                                <input type="text" name="l_name" id="l_name" class="form-control border-start-0" placeholder="นามสกุล" value="<?= isset($_POST['l_name']) ? htmlspecialchars($_POST['l_name']) : '' ?>" required>
                            </div>
                        </div>
                        
                        <div class="mb-3">
                            <label for="mail" class="form-label">อีเมล</label>
                            <div class="input-group">
                                <span class="input-group-text bg-light border-end-0">
                                    <i class="fas fa-envelope text-danger"></i>
                                </span>
                                <input type="mail" name="mail" id="mail" class="form-control border-start-0" placeholder="example@gmail.com" value="<?= isset($_POST['mail']) ? htmlspecialchars($_POST['mail']) : '' ?>" required>
                            </div>
                        </div>
                        <div class="mb-3">
                            <label for="Tel" class="form-label">เบอร์โทร</label>
                            <div class="input-group">
                                <span class="input-group-text bg-light border-end-0">
                                    <i class="fas fa-id-card text-danger"></i>
                                </span>
                                <input type="text" name="tel" id="tel" class="form-control border-start-0" placeholder="0631709822" value="<?= isset($_POST['tel']) ? htmlspecialchars($_POST['tel']) : '' ?>" required>
                            </div>
                        </div>
                     <div class="align-item-between">
                        <div class="d-grid mb-3">
                            <button type="submit" class="btn btn-danger btn-lg">
                                <i class="fas fa-user-plus me-2"></i>เพิ่มข้อมูล
                            </button>
                        </div>
                        <div class="text-center">
                            <a href="index.php" class="btn btn-outline-secondary">
                                <i class="fas fa-sign-in-alt me-1"></i>ดูรายการ
                            </a>
                        </div>
                    </div>
                    </form>
            </div>
        </div>
    <script scr="https://cdn.jsdelivr.net/npm/bootstrap@5.3.7/dist/js/bootstrap.bundle.min.js"></script>
        <!-- DataTables JS -->
        <script src="https://cdn.datatables.net/2.0.8/js/dataTables.min.js"></script>
        
        <script>
            let table = new DataTable('#productTable');


        </script>
</body>

</html>