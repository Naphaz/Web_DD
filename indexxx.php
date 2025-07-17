<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>PHP Basic</title>
</head>
<body>
    <h1>Welcome to PHP Basic</h1>
    <p>This is a simple PHP Application.</p> <hr>
    <h1 style="color: red;">Basic PHP Syntax</h1>
        <pre>
            &lt;?php
                echo "Hello World";
            ?&gt;
        </pre>
    <h3>Result</h3>
        <div style="color: blue;">
        <?php
            echo  "Hello World!<br>";
            print "<span style='color:black';>Naphat Krodsuwan</span>";
        ?>
        </div>
        <hr>
        <h1 style="color: red;">PHP Variables</h1>
        <pre>
            &lt;?php
                $greeting = "Hello, World;";
                echo $greeting;
            ?&gt;
        </pre>
        <h3>Result</h3>
             <?php
                $greeting = "Hello, World;";
                echo "<span style='color:blue';>$greeting</span>";
            ?>
        <hr>
        <h1>Integer Variable Example</h1>
        <?php
            $age = 20;
            echo "<span style='color:blue';>I am ".$age." years old </span>";
        ?>
        <hr>
        <h1>Calculate With Variable</h1>
            <?php
                $x = 5;
                $y = 4;
                $r = $x + $y ;
                echo "<span style='color:blue';>The Sum of $x and $y is $r </span>"
            ?>
        <hr>
        <h1>คำนวณพื้นที่สามเหลี่ยม</h1>
            <?php
                $base = 10;
                $hi = 5;
                $r = 0.5 * $base * $hi ;
                echo "<span style='color:blue';>พื้นที่ของสามเหลี่ยมคือ $r ตารางหน่วย</span>"
            ?>
        <hr>
        <h1>คำนวณอายุจากปีเกิด</h1>
        <?php
            $age = 2547;
            $now = 2568;
            $re = $now - $age;
            echo "<span style='color:blue';>อายุของคุณคือ $re ปี</span>";
        ?>
        <hr>
        <h1><a href="HW02_calmon.php">Calculate</a></h1>
</body>
</html>
