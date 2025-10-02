<?php
    session_start();
    require_once 'config.php';
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>List Student</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.7/dist/css/bootstrap.min.css">
    <!-- DataTable CSS -->
    <link href="https://cdn.datatables.net/2.0.8/css/dataTables.dataTables.min.css" rel="stylesheet">
    <!-- jQuery -->
    <script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>
    <style>
        .container {
            max-width: 800px;
        }
    </style> 
</head>
<body>
    <?php
        $sql = "SELECT * FROM tb_664230050";
        $stmt = $conn->prepare($sql);
        $stmt->execute();
        $data = $stmt->fetchAll(PDO::FETCH_ASSOC);
    ?>
    <?php if (isset($_GET['add']) && $_GET['add'] === 'success'): ?>
                    <div class="alert alert-success">เพิ่มข้อมูลสำเร็จ</div>
                    <?php endif; ?>
                    <?php if (!empty($error)): ?>
                    <div class="alert alert-danger"><?= htmlspecialchars($error) ?></div>
                    <?php endif; ?>
        <div class="container mt-5">
            <h1>รายการนักศึกษา</h1>
            
            <form action="" method="POST" class="mb-3">
                <a href="add.php" class="btn btn-outline-danger">
                        <i>เพิ่มนักศึกษา</i>
                </a>
            </form>
             <form action="" method="POST" class="mb-3">
                <a href="edit_std.php" class="btn btn-outline-danger">
                        <i>แก้ไขข้อมูล</i>
                </a>
            </form>
             <form action="" method="POST" class="mb-3">
                <a href="add.php" class="btn btn-outline-danger">
                        <i>ลบข้อมูล</i>
                </a>
            </form>
                <table id="productTable"  class="table table-striped table-bordered">
                    <thead>
                        <tr>
                            <th>#</th>
                            <th>Student ID</th>
                            <th>Nickname</th></th>
                            <th>Name</th>
                            <th>Last Name</th>
                            <th>Email</th>
                            <th>Phone</th>
                            <th>Created At</th>
                            
                        </tr>
                    </thead>    
                    <tbody>
                    <?php
                        if (isset($_POST['std_id']) && !empty($_POST['std_id'])){
                            $filterPrice = $_POST['std_id'];
                            $filtertb_664230050 = array_filter ($tb_664230050 , function($tb_664230050)use($filterPrice){
                                return $tb_664230050['std_id'] == $filterPrice;
                            }); 
                        $filtertb_664230050 = array_values($filtertb_664230050);


                        }else{
                            $filtertb_664230050 = $data;
                        }


                        foreach($filtertb_664230050 as $index => $tb_664230050 ){
                        echo "<tr><td>".($index+1).
                        "</td><td>".$tb_664230050 ["std_id"].
                        "</td><td>".$tb_664230050["nickname"].
                        "</td><td>".$tb_664230050["f_name"].
                        "</td><td>".$tb_664230050["l_name"].
                        "</td><td>".$tb_664230050["mail"].
                        "</td><td>".$tb_664230050["tel"].
                        "</td><td>".$tb_664230050["created_at"].
                        "</td></tr>";
                    }
                    ?>

                    </tbody>
                </table>
        </div>
        <script scr="https://cdn.jsdelivr.net/npm/bootstrap@5.3.7/dist/js/bootstrap.bundle.min.js"></script>
        <!-- DataTables JS -->
        <script src="https://cdn.datatables.net/2.0.8/js/dataTables.min.js"></script>
        
        <script>
            let table = new DataTable('#productTable');


        </script>
</body>
</html>