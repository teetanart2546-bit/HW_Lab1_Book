<!doctype html>
<html>
<head>
<meta charset="utf-8">
<title>Delete Book Data</title>
</head>
<body>

<?php
 $send = (isset($_POST['send']) ? $_POST['send'] : '');
 if ($send == '') {
		echo "<a href=index.php>กลับไปเมนูผู้ดูแลระบบ</a><p>";
?>
<?php
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
<form method="post" action="">
	<h3>แบบฟอร์มการลบข้อมูล</h3>
	<p>กรุณากรอกรหัสหนังสือที่ต้องการลบ</p>
	<p>รหัสหนังสือ: <input type="text" name="book_id" required></p>
	<p>
		<input type="submit" name="send" value="Submit">
		<input type="reset" name="cancel" value="Reset">
	</p>
	</form>
<?php } else {
	$book_id = (isset($_POST['book_id']) ? $_POST['book_id'] : '');
	require("inc/connectdb.inc.php");
	$sql = "USE bookdb";
	$conn->query($sql);
	$sql = "DELETE FROM booktable WHERE book_id = ?";
	$stmt = $conn->prepare($sql);
	$stmt->bind_param("s", $book_id);
	if ($stmt->execute()) {
		echo "<br>ลบข้อมูลสำเร็จ";
	} else {
		echo "<br>ไม่สามารถลบข้อมูลได้: " .$stmt->error;
	}
	$stmt->close();
	$conn->close();
	echo "<br><a href=deletestd_book.php>กลับหน้าจอการลบข้อมูล</a><br>";
	echo "<a href=index.php>กลับไปเมนูผู้ดูแลระบบ</a><br>";
} ?>
</body>
</html>
