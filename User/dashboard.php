<?php
// Connect to the database
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "ujikom8";

$conn = new mysqli($servername, $username, $password, $dbname);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Fetch items from the database
$sql = "SELECT id, name, description, status, updated_at FROM items ORDER BY updated_at DESC";
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>User Dashboard</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            margin: 20px;
        }
        table {
            width: 100%;
            border-collapse: collapse;
        }
        table, th, td {
            border: 1px solid #ddd;
        }
        th, td {
            padding: 10px;
            text-align: left;
        }
        th {
            background-color: #f4f4f4;
        }
        .status-added {
            color: green;
        }
        .status-edited {
            color: orange;
        }
        .status-removed {
            color: red;
        }
    </style>
</head>
<body>
    <h1>User Dashboard</h1>
    <p>Below is the list of items added, edited, or removed by the admin:</p>

    <table>
        <thead>
            <tr>
                <th>ID</th>
                <th>Name</th>
                <th>Description</th>
                <th>Status</th>
                <th>Last Updated</th>
            </tr>
        </thead>
        <tbody>
            <?php if ($result->num_rows > 0): ?>
                <?php while ($row = $result->fetch_assoc()): ?>
                    <tr>
                        <td><?php echo htmlspecialchars($row['id']); ?></td>
                        <td><?php echo htmlspecialchars($row['name']); ?></td>
                        <td><?php echo htmlspecialchars($row['description']); ?></td>
                        <td class="status-<?php echo strtolower($row['status']); ?>">
                            <?php echo ucfirst($row['status']); ?>
                        </td>
                        <td><?php echo htmlspecialchars($row['updated_at']); ?></td>
                    </tr>
                <?php endwhile; ?>
            <?php else: ?>
                <tr>
                    <td colspan="5">No items found.</td>
                </tr>
            <?php endif; ?>
        </tbody>
    </table>

    <?php $conn->close(); ?>
</body>
</html>