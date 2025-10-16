<!doctype html>
<html>
<head>
<meta charset="utf-8">
<title>Setup Database</title>
</head>
<body>
<?php
    require("../inc/connectdb.inc.php");

    // Create database
    $sql = "DROP DATABASE IF EXISTS bookdb;";
    $conn->query($sql);
    $sql = "CREATE DATABASE bookdb DEFAULT CHARACTER SET utf8 DEFAULT COLLATE utf8_general_ci;";
    if ($conn->query($sql) === TRUE) {
        echo "Database created successfully<br>";
    } else {
        die("<br>Error creating database: " . $conn->error);
    }

    // Select database
    $sql = "USE bookdb;";
    $conn->query($sql);

    // Create table
    $sql = "CREATE TABLE booktable (
                book_id VARCHAR(13) PRIMARY KEY,
                title VARCHAR(255),
                author VARCHAR(255),
                publisher VARCHAR(255),
                year_published INT(4),
                price DECIMAL(10,2)
            );";
    if ($conn->query($sql) === TRUE) {
        echo "Table booktable created successfully<br>";
    } else {
        die("<br>Error creating table: " . $conn->error);
    }

    $conn->close();
?>
</body>
</html>
