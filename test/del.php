<?php

    if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['u_id'])) {
    $std_id = $_POST['u_id'];
    // ลบผูใ้ชจ้ำกฐำนขอ้ มลู
    $stmt = $conn->prepare("DELETE FROM tb_664230050 WHERE std_id = ?");
    $stmt->execute([$std_id]);
    // สง่ ผลลัพธก์ ลับไปยังหนำ้ 68users.php
    header("Location: index.php");
exit;
    }
?>