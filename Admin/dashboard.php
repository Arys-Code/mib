<?php
// Database connection
include '../config.php';
session_start();

// Handle form submissions
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    if (isset($_POST['add'])) {
        $name = $_POST['name'];
        $description = $_POST['description'];
        $conn->query("INSERT INTO barang (name, description) VALUES ('$name', '$description')");
    } elseif (isset($_POST['edit'])) {
        $id = $_POST['id'];
        $name = $_POST['name'];
        $description = $_POST['description'];
        $conn->query("UPDATE barang SET name='$name', description='$description' WHERE id=$id");
    } elseif (isset($_POST['delete'])) {
        $id = $_POST['id'];
        $conn->query("DELETE FROM barang WHERE id=$id");
    }
}

// Fetch items
$result = $conn->query("SELECT * FROM barang");
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Dashboard</title>
</head>
<link rel="stylesheet" href="atmin.css">
<body>
    <h1>Admin Dashboard</h1>

    <h2>Add Item</h2>
    <form method="POST">
        <input type="text" name="name" placeholder="Item Name" required>
        <textarea name="description" placeholder="Item Description" required></textarea>
        <button type="submit" name="add">Add Item</button>
    </form>

    <h2>Items</h2>
    <table border="1">
        <tr>
            <th>ID</th>
            <th>Name</th>
            <th>Description</th>
            <th>Actions</th>
        </tr>
        <?php while ($row = $result->fetch_assoc()): ?>
        <tr>
            <td><?php echo $row['id']; ?></td>
            <td><?php echo $row['name']; ?></td>
            <td><?php echo $row['description']; ?></td>
            <td>
                <form method="POST" style="display:inline;">
                    <input type="hidden" name="id" value="<?php echo $row['id']; ?>">
                    <input type="text" name="name" value="<?php echo $row['name']; ?>" required>
                    <textarea name="description" required><?php echo $row['description']; ?></textarea>
                    <button type="submit" name="edit">Edit</button>
                </form>
                <form method="POST" style="display:inline;">
                    <input type="hidden" name="id" value="<?php echo $row['id']; ?>">
                    <button type="submit" name="delete">Delete</button>
                </form>
            </td>
        </tr>
        <?php endwhile; ?>
    </table>
</body>
</html>

<?php
$conn->close();
?>