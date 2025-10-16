<!doctype html>
<html>
<head>
<meta charset="utf-8">
<title>Update Book Data</title>
</head>
<body>
<?php
    require("inc/connectdb.inc.php");
    $sql = "USE bookdb";
    $conn->query($sql);

    $title = (isset($_POST['title']) ? $_POST['title'] : '');
    $author = (isset($_POST['author']) ? $_POST['author'] : '');
    $publisher = (isset($_POST['publisher']) ? $_POST['publisher'] : '');
    $year_published = (isset($_POST['year_published']) ? (int)$_POST['year_published'] : 0);
    $price = (isset($_POST['price']) ? (float)$_POST['price'] : 0.0);
    $book_id = (isset($_POST['book_id']) ? $_POST['book_id'] : '');

    $stmt = $conn->prepare("UPDATE booktable SET title=?, author=?, publisher=?, year_published=?, price=? WHERE book_id=?");
    $stmt->bind_param("sssids", $title, $author, $publisher, $year_published, $price, $book_id);

    if ($stmt->execute() === TRUE) {
        echo "<br>แก้ไขข้อมูลสำเร็จ<br>";
    } else {
        echo "<br>ไม่สามารถแก้ไขข้อมูลได้ : " . $stmt->error;
    }

    $stmt->close();
    $conn->close();

    echo "<br><a href=updatestdform_book.php>กลับหน้าจอการแก้ไขข้อมูล</a><br>";
    echo "<a href=index.php>กลับไปเมนูผู้ดูแลระบบ</a><br>";
?>
</body>
</html>
