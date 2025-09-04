<?php
    session_start();
    require_once 'config.php';
    $isLoggedIn = isset($_SESSION['user_id']);

    $stmt = $conn->query("SELECT p.*, c.category_name
    FROM products p
    LEFT JOIN categories c ON p.category_id = c.category_id
    ORDER BY p.created_at DESC");
    $products = $stmt->fetchAll(PDO::FETCH_ASSOC);
    
?>
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
            background: linear-gradient(135deg, #ff6b9d, #ffc0cb, #ff8fab, #ffb3c1);
            min-height: 100vh;
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
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
        h1 {
            color: #c53030;
            font-weight: 600;
            font-size: 2rem;
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
<body class="container mt-4">
    <div class="d-flex justify-content-between align-items-center mb-4">
        <h1>รายการสินค้า</h1>
            <div>
                <?php if ($isLoggedIn): ?>
                    <span class="me-3">ยินดีต้อนรับ, <?= htmlspecialchars($_SESSION['username']) ?> (<?=
                    $_SESSION['role'] ?>)</span>
                    <a href="profile.php" class="btn btn-info">ข้อมูลส่วนตัว</a>
                    <a href="cart.php" class="btn btn-warning">ดูตะกร้า</a>
                    <a href="logout.php" class="btn btn-secondary">ออกจากระบบ</a>
                    <?php else: ?>
                    <a href="login.php" class="btn btn-success">เข้าสู่ระบบ</a>
                    <a href="register.php" class="btn btn-primary">สมัครสมาชิก</a>
                    <?php endif; ?>
            </div>
    </div>
    <div class="row">
        <?php foreach ($products as $product): ?>
            <div class="col-md-4 mb-4">
                <div class="card h-100">
                    <div class="card-body">
                        <h5 class="card-title"><?= htmlspecialchars($product['product_name']) ?></h5>
                            <h6 class="card-subtitle mb-2 text-muted"><?= htmlspecialchars($product['category_name'])
                                ?></h6>
                                <p class="card-text"><?= nl2br(htmlspecialchars($product['description'])) ?></p>
                                    <p><strong>ราคา:</strong> <?= number_format($product['price'], 2) ?> บาท</p>
                                        <?php if ($isLoggedIn): ?>
                                            <form action="cart.php" method="post" class="d-inline">
                                                <input type="hidden" name="product_id" value="<?= $product['product_id']?>">
                                                <input type="hidden" name="quantity" value="1">
                                                <button type="submit" class="btn btn-sm btn-success">เพิ่มในตะกร้า</button>
                                            </form>
                                    <?php else: ?>
                                <small class="text-muted">เข้าสู่ระบบเพื่อสั่งซื้อ</small>
                            <?php endif; ?>
                        <a href="product_detail.php?id=<?= $product['product_id'] ?>" class="btn btn-sm btn-outline-primary float-end">ดูรายละเอียด</a>
                    </div>
                </div>
            </div>
        <?php endforeach; ?>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>