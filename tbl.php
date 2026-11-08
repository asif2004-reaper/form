<?php
/**-- Run this once to create the database and table
CREATE DATABASE college;
USE college;
CREATE TABLE IF NOT EXISTS students (
    id   INT AUTO_INCREMENT PRIMARY KEY,
    name VARCHAR(100) NOT NULL,
    age  INT          NOT NULL
); */
$con = mysqli_connect("localhost", "root", "", "college", 3307);
if (!$con) {
    die("Connection failed: " . mysqli_connect_error());
}

if (isset($_POST['name']) && isset($_POST['age'])) {
    $name = mysqli_real_escape_string($con, $_POST['name']);
    $age = (int) $_POST['age'];

    mysqli_query($con, "INSERT INTO students(name, age) VALUES('$name', '$age')");
}
?>
<h2>Student Entry</h2>

<form method="post">
    Name: <input type="text" name="name" required>
    <br><br>

    Age: <input type="number" name="age" required>
    <br><br>

    <button type="submit">Save</button>
</form>

<h3>Student List</h3>

<?php
$result = mysqli_query($con, "SELECT * FROM students");

while ($row = mysqli_fetch_assoc($result)) {
    echo $row['id'] . " - " .
         htmlspecialchars($row['name']) . " - " .
         $row['age'] . "<br>";
}

mysqli_close($con);
?>
