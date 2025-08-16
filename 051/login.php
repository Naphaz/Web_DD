<?php
    session_start();
    require_once 'config.php';
    $error = '';
    if($_SERVER['REQUEST_METHOD'] == 'POST'){
        $usernameOrEmail = trim($_POST['username_or_email']);            
        $password = $_POST['password'];

        $sql = "SELECT * FROM users WHERE (username = ? OR email = ?)";
        $stmt = $conn->prepare($sql);
        $stmt->execute([$usernameOrEmail, $usernameOrEmail]);
        $user = $stmt->fetch(PDO::FETCH_ASSOC);

        if($user && password_verify($password, $user['password'])){


            $_SESSION['user_id'] = $user['user_id'];
            $_SESSION['username'] = $user['username'];
            $_SESSION['role'] = $user['role'];

            if($user['role'] === 'admin'){
                header("Location: admin/index.php");
            }else{
                header("Location: index.php");
            }
            exit();
        }else {
            $error = "ชื่อผู้ใช้หรือรหัสผ่านไม่ถูกต้อง";
        }

    }
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css">
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700&display=swap" rel="stylesheet">
    <style>
        body {
            font-family: 'Poppins', sans-serif;
            background: linear-gradient(135deg, #ff6b9d, #ffc0cb, #ff8fab, #ffb3c1);
            background-size: 400% 400%;
            animation: gradientShift 8s ease infinite;
            min-height: 100vh;
            position: relative;
        }

        body::before {
            content: '';
            position: absolute;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            background: 
                radial-gradient(circle at 20% 80%, rgba(255,182,193,0.3) 0%, transparent 50%),
                radial-gradient(circle at 80% 20%, rgba(255,105,180,0.3) 0%, transparent 50%),
                radial-gradient(circle at 40% 40%, rgba(255,20,147,0.2) 0%, transparent 50%);
            pointer-events: none;
        }

        @keyframes gradientShift {
            0% { background-position: 0% 50%; }
            50% { background-position: 100% 50%; }
            100% { background-position: 0% 50%; }
        }

        .container {
            position: relative;
            z-index: 1;
        }

        .login-card {
            background: rgba(255, 255, 255, 0.95);
            backdrop-filter: blur(20px);
            border-radius: 25px;
            box-shadow: 
                0 20px 40px rgba(255, 105, 180, 0.3),
                0 8px 32px rgba(255, 20, 147, 0.2),
                inset 0 1px 0 rgba(255, 255, 255, 0.8);
            border: 1px solid rgba(255, 182, 193, 0.3);
            padding: 3rem 2.5rem;
            margin-top: 8vh;
            position: relative;
            overflow: hidden;
        }

        .login-card::before {
            content: '';
            position: absolute;
            top: 0;
            left: 0;
            width: 100%;
            height: 2px;
            background: linear-gradient(90deg, #ff69b4, #ff1493, #dc143c, #ff69b4);
            background-size: 400% 100%;
            animation: borderGlow 3s ease infinite;
        }

        @keyframes borderGlow {
            0%, 100% { background-position: 0% 50%; }
            50% { background-position: 100% 50%; }
        }

        .login-header {
            text-align: center;
            margin-bottom: 2.5rem;
        }

        .login-title {
            font-size: 2.5rem;
            font-weight: 700;
            background: linear-gradient(135deg, #ff1493, #ff69b4, #dc143c);
            -webkit-background-clip: text;
            -webkit-text-fill-color: transparent;
            background-clip: text;
            margin-bottom: 0.5rem;
            text-shadow: 0 4px 8px rgba(255, 20, 147, 0.3);
        }

        .login-subtitle {
            color: #8b4566;
            font-weight: 400;
            font-size: 1.1rem;
        }

        .form-floating {
            margin-bottom: 1.5rem;
        }

        .form-control {
            border: 2px solid #ffc0cb;
            border-radius: 15px;
            padding: 1rem;
            font-size: 1rem;
            background: rgba(255, 255, 255, 0.9);
            transition: all 0.3s ease;
            box-shadow: 0 4px 15px rgba(255, 182, 193, 0.2);
        }

        .form-control:focus {
            border-color: #ff69b4;
            box-shadow: 
                0 0 0 0.2rem rgba(255, 105, 180, 0.25),
                0 8px 25px rgba(255, 20, 147, 0.3);
            transform: translateY(-2px);
            background: rgba(255, 255, 255, 1);
        }

        .form-label {
            color: #d14d72;
            font-weight: 600;
            font-size: 0.95rem;
            margin-bottom: 0.7rem;
        }

        .btn-success {
            background: linear-gradient(135deg, #ff1493, #ff69b4);
            border: none;
            border-radius: 15px;
            padding: 1rem 2.5rem;
            font-weight: 600;
            font-size: 1.1rem;
            box-shadow: 
                0 8px 20px rgba(255, 20, 147, 0.4),
                0 4px 10px rgba(255, 105, 180, 0.3);
            transition: all 0.3s ease;
            position: relative;
            overflow: hidden;
            width: 100%;
            margin-bottom: 1rem;
        }

        .btn-success::before {
            content: '';
            position: absolute;
            top: 0;
            left: -100%;
            width: 100%;
            height: 100%;
            background: linear-gradient(90deg, transparent, rgba(255, 255, 255, 0.3), transparent);
            transition: left 0.5s;
        }

        .btn-success:hover::before {
            left: 100%;
        }

        .btn-success:hover {
            background: linear-gradient(135deg, #ff69b4, #ff1493);
            transform: translateY(-3px);
            box-shadow: 
                0 12px 30px rgba(255, 20, 147, 0.5),
                0 6px 15px rgba(255, 105, 180, 0.4);
        }

        .btn-link {
            color: #ff1493;
            text-decoration: none;
            font-weight: 500;
            font-size: 1rem;
            padding: 0.8rem 1.5rem;
            border-radius: 12px;
            transition: all 0.3s ease;
            display: inline-block;
            background: rgba(255, 20, 147, 0.1);
            width: 100%;
            text-align: center;
        }

        .btn-link:hover {
            color: #dc143c;
            background: rgba(255, 20, 147, 0.2);
            transform: translateY(-2px);
        }

        .alert {
            border-radius: 15px;
            border: none;
            font-weight: 500;
            padding: 1rem 1.5rem;
            margin-bottom: 2rem;
        }

        .alert-success {
            background: linear-gradient(135deg, rgba(40, 167, 69, 0.1), rgba(25, 135, 84, 0.1));
            color: #155724;
            border-left: 4px solid #28a745;
            box-shadow: 0 4px 15px rgba(40, 167, 69, 0.2);
        }

        .alert-danger {
            background: linear-gradient(135deg, rgba(220, 53, 69, 0.1), rgba(220, 20, 60, 0.1));
            color: #721c24;
            border-left: 4px solid #dc3545;
            box-shadow: 0 4px 15px rgba(220, 53, 69, 0.2);
        }

        .floating-shapes {
            position: absolute;
            width: 100%;
            height: 100%;
            overflow: hidden;
            pointer-events: none;
        }

        .shape {
            position: absolute;
            border-radius: 50%;
            background: rgba(255, 105, 180, 0.1);
            animation: float 6s ease-in-out infinite;
        }

        .shape:nth-child(1) {
            width: 80px;
            height: 80px;
            top: 20%;
            left: 10%;
            animation-delay: 0s;
        }

        .shape:nth-child(2) {
            width: 120px;
            height: 120px;
            top: 60%;
            right: 10%;
            animation-delay: -2s;
            background: rgba(255, 20, 147, 0.1);
        }

        .shape:nth-child(3) {
            width: 60px;
            height: 60px;
            bottom: 30%;
            left: 20%;
            animation-delay: -4s;
            background: rgba(220, 20, 60, 0.1);
        }

        @keyframes float {
            0%, 100% { transform: translateY(0px) rotate(0deg); }
            25% { transform: translateY(-20px) rotate(90deg); }
            50% { transform: translateY(0px) rotate(180deg); }
            75% { transform: translateY(-10px) rotate(270deg); }
        }

        @media (max-width: 768px) {
            .login-card {
                margin: 2rem 1rem;
                padding: 2rem 1.5rem;
            }
            
            .login-title {
                font-size: 2rem;
            }
        }
    </style>
</head>
<body>
    <div class="floating-shapes">
        <div class="shape"></div>
        <div class="shape"></div>
        <div class="shape"></div>
    </div>
       
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-lg-5 col-md-7">
                <div class="login-card">
                    <div class="login-header">
                        <h1 class="login-title">เข้าสู่ระบบ</h1>
                        <p class="login-subtitle">ยินดีต้อนรับกลับ</p>
                    </div>

                    <?php if (isset($_GET['register']) && $_GET['register'] === 'success'): ?>
                    <div class="alert alert-success">สมัครสมาชิกสำเร็จ กรุณาเข้าสู่ระบบ</div>
                    <?php endif; ?>
                    <?php if (!empty($error)): ?>
                    <div class="alert alert-danger"><?= htmlspecialchars($error) ?></div>
                    <?php endif; ?>

                    <form method="post" class="row g-3">
                        <div class="col-12">
                            <label for="username_or_email" class="form-label">ชื่อผู้ใช้หรืออีเมล</label>
                            <input type="text" name="username_or_email" id="username_or_email" class="form-control" required>
                        </div>
                        <div class="col-12">
                            <label for="password" class="form-label">รหัสผ่าน</label>
                            <input type="password" name="password" id="password" class="form-control" required>
                        </div>
                        <div class="col-12">
                            <button type="submit" class="btn btn-success">เข้าสู่ระบบ</button>
                            <a href="register.php" class="btn btn-link">สมัครสมาชิก</a>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>