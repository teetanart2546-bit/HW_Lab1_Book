<!doctype html>
<html>
<head>
<meta charset="utf-8">
<title>Manage Book Data</title>
</head>
<body>
<?php
    $send = (isset($_POST['send']) ? $_POST['send'] : '');
    if ($send == '') {
        echo "<a href='index.php'>กลับไปเมนูผู้ดูแลระบบ</a><p>";
?>
<form method="post" action="">
<h3>แบบฟอร์มการจัดการข้อมูลหนังสือ</h3>
<p>รหัสหนังสือ: <input type="text" name="book_id" required></p>
<p>ชื่อหนังสือ: <input type="text" name="title" required></p>
<p>ชื่อผู้แต่ง: <input type="text" name="author" required></p>
<p>ชื่อสำนักพิมพ์: <input type="text" name="publisher" required></p>
<p>ปีที่พิมพ์: <input type="number" name="year_published" min="1900" max="<?php echo date('Y'); ?>" required></p>
<p>ราคา: <input type="number" name="price" step="0.01" required></p>
<p>
    <input type="submit" name="send" value="Submit">
    <input type="reset" name="cancel" value="Reset">
</p>
</form>
<?php
    } else {
        $book_id = (isset($_POST['book_id']) ? $_POST['book_id'] : '');
        $title = (isset($_POST['title']) ? $_POST['title'] : '');
        $author = (isset($_POST['author']) ? $_POST['author'] : '');
        $publisher = (isset($_POST['publisher']) ? $_POST['publisher'] : '');
        $year_published = (isset($_POST['year_published']) ? (int)$_POST['year_published'] : 0);
        $price = (isset($_POST['price']) ? (float)$_POST['price'] : 0.0);

        require("inc/connectdb.inc.php");

        // Select the database
        $sql = "USE bookdb";
        $conn->query($sql);

        // Insert the data
        $sql = "INSERT INTO booktable (book_id, title, author, publisher, year_published, price) VALUES (?, ?, ?, ?, ?, ?);";
        $stmt = $conn->prepare($sql);
        $stmt->bind_param("ssssdi", $book_id, $title, $author, $publisher, $year_published, $price);

        if ($stmt->execute()) {
            echo "<br>การเพิ่มข้อมูลหนังสือลงในฐานข้อมูลสำเร็จ";
        } else {
            echo "<br>ไม่สามารถเพิ่มข้อมูลใหม่ลงในฐานข้อมูลได้: " . $stmt->error;
        }

        echo "<br><a href='insertstd_book.php'>กลับหน้าเว็บการเพิ่มข้อมูล</a><br>";
        echo "<a href='index.php'>กลับไปเมนูผู้ดูแลระบบ</a><br>";

        $stmt->close();
        $conn->close();
    }
?>
</body>
</html>
