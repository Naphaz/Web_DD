<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>หน้าหลัก</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css" rel="stylesheet">
    <style>
        body {
            background: linear-gradient(135deg, #fef7f7 0%, #f8f2f2 100%);
            min-height: 100vh;
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
        }
        
        .main-container {
            min-height: 100vh;
            display: flex;
            align-items: center;
            justify-content: center;
            padding: 20px;
        }
        
        .welcome-card {
            background: white;
            border-radius: 12px;
            box-shadow: 0 8px 25px rgba(0, 0, 0, 0.08);
            padding: 2.5rem;
            text-align: center;
            max-width: 450px;
            width: 100%;
            border: 1px solid #f0e6e6;
        }
        
        h1 {
            color: #c53030;
            font-weight: 600;
            font-size: 2rem;
            margin-bottom: 1.5rem;
        }
        
        .user-info {
            background: linear-gradient(135deg, #fed7d7 0%, #feb2b2 100%);
            color: #742a2a;
            padding: 1.2rem;
            border-radius: 8px;
            margin: 1.5rem 0;
            border-left: 4px solid #e53e3e;
        }
        
        .user-info p {
            margin: 0;
            font-size: 1.1rem;
            font-weight: 500;
        }
        
        .user-icon {
            font-size: 2.5rem;
            color: #e53e3e;
            margin-bottom: 1rem;
        }
        
        .btn-logout {
            background: #e53e3e;
            border: none;
            padding: 10px 24px;
            border-radius: 6px;
            color: white;
            font-weight: 500;
            font-size: 1rem;
            transition: all 0.2s ease;
            text-decoration: none;
            display: inline-block;
        }
        
        .btn-logout:hover {
            background: #c53030;
            color: white;
        }
        
        .welcome-text {
            color: #a0aec0;
            font-size: 1rem;
            margin-bottom: 1.5rem;
        }
        
        @media (max-width: 768px) {
            .welcome-card {
                padding: 2rem;
                margin: 1rem;
            }
            
            h1 {
                font-size: 1.8rem;
            }
            
            .user-info p {
                font-size: 1rem;
            }
        }
    </style>
</head>
<body>
    <div class="main-container">
        <div class="welcome-card">
            <div class="user-icon">
                <i class="fas fa-user-circle"></i>
            </div>
            
            <h1>ยินดีต้อนรับเข้าสู่หน้าหลัก</h1>
            
            <p class="welcome-text">
                ยินดีต้อนรับสู่ระบบของเรา
            </p>
            
            <div class="user-info">
                <p>
                    <i class="fas fa-user me-2"></i>
                    ผู้ใช้ : [Username] ([Role])
                </p>
            </div>
            
            <div>
                <a href="logout.php" class="btn-logout">
                    <i class="fas fa-sign-out-alt me-2"></i>
                    ออกจากระบบ
                </a>
            </div>
        </div>
    </div>
    
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>