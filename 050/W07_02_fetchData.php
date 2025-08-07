<?php
 require_once 'W07_01_connectDB.php';
    $sql ="SELECT * FROM products";
    $result = $conn->query($sql);
    if($result->rowCount() > 0){
        //echo "<h2>พบข้อมูลในตาราง Product</h2>";
        // echo "$data[0][0] <br>";
      //  $data = $result->fetchAll(PDO::FETCH_NUM);
        //$data = $result->fetchAll(PDO::FETCH_ASSOC);
       // $data = $result->fetchAll(PDO::FETCH_BOTH);
       //print_r($data);
        // use prepared statment เพื่อป้องกัน sql injection
        // ใช้ execute() เพื่อรันคำสั่ง SQL
        //ใช้ fetchall() เพื่อดึงข้อมูลทั้งหมดในครั้งเดียว
        // ใช้ print_r() เพื่อแสดงข้อมูลทั้งหมดในรูปปบบ array
        $stmt = $conn->prepare($sql);
        $stmt->execute();
        $data = $stmt->fetchAll(PDO::FETCH_NUM);
       // echo "<br>";
        // echo "<pre>";
        //     print_r($data);
        // echo "</pre>";

        $stmt = $conn->prepare($sql);
        $stmt->execute();
        $data = $stmt->fetchAll(PDO::FETCH_ASSOC);
       // echo "<br>";
       // echo "<<<<<<<<<<<<<<>>>>>>>>>>>>>>";
        // echo "<pre>";
        //     print_r($data);
        // echo "</pre>";
       // echo "<<<<<<<<<<<<<<>>>>>>>>>>>>>>";
          // แสดงผลข้อมูลที่ดึงมา
        header('Content-Type: application/json'); // ระบุ Content-Type เป็น JSON
        echo json_encode($data, JSON_UNESCAPED_UNICODE | JSON_PRETTY_PRINT); // แปลงข้อมูลใน $arr เป็น JSON และแสดงผล


    }else{
        echo "<h2>ไม่พบข้อมูลในตาราง Product</h2>";
    }
?>