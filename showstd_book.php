<!doctype html>
<html>
<head>
<meta charset="utf-8">
<title>Untitled Document</title>
</head>
<body>
<?php
echo "<a href=index.php>กลับไปเมนูผู้ดูแลระบบ</a><p>";
	require("inc/connectdb.inc.php");
	$sql = "USE bookdb";
	$conn->query($sql);
	$sql = "SELECT * FROM booktable;";
	$result = $conn->query($sql);
    echo "<table width='800'>";
    echo "<tr bgcolor=#0099FF >";
    echo "<td width='15%'><font color=#FFFFFF>รหัสหนังสือ</td><td><font color=#FFFFFF>ชื่อหนังสือ</td><td><font color=#FFFFFF>ชื่อผู้แต่ง</td><td><font color=#FFFFFF>ชื่อสำนักพิมพ์</td><td><font color=#FFFFFF>ปีที่พิมพ์</td><td><font color=#FFFFFF>ราคา</td>";
    echo "</tr>";
    $count = 0;
    while ($dbarr = $result->fetch_array()){
        if ($count == 0){
            echo "<tr bgcolor=#E0EEEE>";
            $count = 1;
        } else {
            echo "<tr bgcolor=#C6E2FF>";
            $count = 0;
        }
        echo "<td>".$dbarr['book_id']."</td><td>".$dbarr['title']."</td><td>".$dbarr['author']."</td><td>".$dbarr['publisher']."</td><td>".$dbarr['year_published']."</td><td>".$dbarr['price'];
        echo "</tr>";
    }
    echo "</table>";
    $conn->close();
    ?>
    </body>
    </html>