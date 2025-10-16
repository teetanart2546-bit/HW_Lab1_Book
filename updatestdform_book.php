<!doctype html>
<html>
<head>
<meta charset="utf-8">
<title>Edit Book Data</title>
</head>
<body>
<?php
 $send = (isset($_POST['send']) ? $_POST['send'] : '');
 if ($send == '') {
		echo "<a href=index.php>กลับไปเมนูผู้ดูแลระบบ</a><p>";
?>
<form method="post" action="">
		<h3>แบบฟอร์มการแก้ไขข้อมูล</h3>
		<p>กรุณากรอกรหัสหนังสือที่ต้องการแก้ไข</p>
		<p>รหัสหนังสือ: <input type="text" name="book_id" required></p>
     	<p>
     		<input type="submit" name="send" value="Submit">
     		<input type="reset" name="cancel" value="Reset">
     	</p>
	</form>
<?php } else {
$book_id = (isset($_POST['book_id']) ? $_POST['book_id'] : '');
    echo "<a href=updatestdform_book.php>กลับหน้าจอการแก้ไขข้อมูล</a><br>";
	echo "<a href=index.php>กลับไปเมนูผู้ดูแลระบบ</a><p>";
    require("inc/connectdb.inc.php");
	$sql = "USE bookdb";
	$conn->query($sql);
	$sql = "SELECT * FROM booktable WHERE book_id = ?;";
	$stmt = $conn->prepare($sql);
	$stmt->bind_param("s", $book_id);
	$stmt->execute();
	$result = $stmt->get_result();
	if($result->num_rows > 0) {
		$dbarr = $result->fetch_array();
		echo "<form action=updatestd_book.php method='post'>";
		echo "รหัสหนังสือ: " . htmlspecialchars($book_id) . "<p>";
		echo "ชื่อหนังสือ: ";
        echo "<input type=hidden name=book_id value = '" . htmlspecialchars($book_id) . "'>";
		echo "<input type=text name=title value='" . htmlspecialchars($dbarr['title']) . "'><p>";
		echo "ชื่อผู้แต่ง: ";
		echo "<input type=text name=author value='" . htmlspecialchars($dbarr['author']) . "'><p>";
		echo "ชื่อสำนักพิมพ์: ";
		echo "<input type=text name=publisher value='" . htmlspecialchars($dbarr['publisher']) . "'><p>";
		echo "ปีที่พิมพ์: ";
		echo "<input type=number name=year_published value='" . htmlspecialchars($dbarr['year_published']) . "' min='1900' max='" . date('Y') . "'><p>";
		echo "ราคา: ";
		echo "<input type=number name=price value='" . htmlspecialchars($dbarr['price']) . "' step='0.01'><p>";
		echo "<input type=submit name=Submit value=Submit>";
		echo "<input type=reset name=reset value=Cancel>";
		echo "</form>";
	} else {
		echo "<p>ไม่พบข้อมูลหนังสือที่ต้องการแก้ไข</p>";
	}
	$stmt->close();
	$conn->close();
} //end else
?>
</body>
</html>
