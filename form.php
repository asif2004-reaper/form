<?php
require 'db.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $name = trim($_POST["name"]);
    $age  = (int) $_POST["age"];

    if ($name !== "" && $age > 0) {
        $stmt = $conn->prepare("INSERT INTO students (name, age) VALUES (?, ?)");
        $stmt->bind_param("si", $name, $age);
        $stmt->execute();
        $stmt->close();

        header("Location: form.php");
        exit;
    }
}

// all records
$result = $conn->query("SELECT id, name, age FROM students ORDER BY id DESC");
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Input-Form</title>
</head>
<style>
    body {
        text-align: center;
        margin: auto;
    }

    table {
        margin: 0 auto;
        border-collapse: collapse;
        min-width: 400px;
    }
</style>

<body>
    <h1>School login form</h1>

    <h3>Add Record</h3>
    <form action="form.php" method="POST">
        Name:<input type="text" name="name" id="name" required><br><br>
        Age: <input type="number" name="age" id="age" min="1" required><br><br>
        <button type="submit">SUBMIT</button>
    </form>

    <h3>Display</h3>
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
</body>

</html>
<?php $conn->close(); ?>
