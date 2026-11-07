<?php
require 'db.php';

// Handle form submission from index.html
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $name = trim($_POST["name"]);
    $age  = (int) $_POST["age"];

    if ($name !== "" && $age > 0) {
        $stmt = $conn->prepare("INSERT INTO students (name, age) VALUES (?, ?)");
        $stmt->bind_param("si", $name, $age);
        $stmt->execute();
        $stmt->close();
    }
}

// Fetch all records
$result = $conn->query("SELECT id, name, age FROM students ORDER BY id DESC");
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Student Records</title>
</head>
<style>
    body {
        text-align: center;
        margin: auto;
        font-family: Arial, sans-serif;
    }

    table {
        margin: 0 auto;
        border-collapse: collapse;
        min-width: 400px;
    }

    th, td {
        border: 1px solid #333;
        padding: 8px 16px;
    }

    th {
        background-color: #f0f0f0;
    }

    a {
        display: inline-block;
        margin-top: 15px;
    }
</style>

<body>
    <h1>Student Records</h1>

    <table>
        <thead>
            <tr>
                <th>ID</th>
                <th>Name</th>
                <th>Age</th>
            </tr>
        </thead>
        <tbody>
            <?php if ($result && $result->num_rows > 0): ?>
                <?php while ($row = $result->fetch_assoc()): ?>
                    <tr>
                        <td><?= htmlspecialchars($row['id']) ?></td>
                        <td><?= htmlspecialchars($row['name']) ?></td>
                        <td><?= htmlspecialchars($row['age']) ?></td>
                    </tr>
                <?php endwhile; ?>
            <?php else: ?>
                <tr>
                    <td colspan="3">No records found</td>
                </tr>
            <?php endif; ?>
        </tbody>
    </table>

    <a href="index.html">&larr; Back to Form</a>
</body>

</html>
<?php $conn->close(); ?>
