<?php
session_start();
include 'db_connect.php'; // Database connection

// Check if the user is logged in and is an Admin
if (!isset($_SESSION['role']) || $_SESSION['role'] !== 'Admin') {
    echo "<div style='color: red;'>Access denied. Admins only.</div>";
    exit;
}

// Handle form submissions (Add User)
if ($_SERVER["REQUEST_METHOD"] === "POST" && isset($_POST['add_user'])) {
    $username = htmlspecialchars($_POST["username"]);
    $password = password_hash($_POST["password"], PASSWORD_DEFAULT); // Securely hash password
    $firstname = htmlspecialchars($_POST["firstname"]);
    $lastname = htmlspecialchars($_POST["lastname"]);
    $department = htmlspecialchars($_POST["department"]);
    $pin = htmlspecialchars($_POST["pin"]);
    $RFID_UID = htmlspecialchars($_POST["RFID_UID"]);
    $role = isset($_POST["role"]) && $_POST["role"] === "Admin" ? "Admin" : "User"; // Default to "User"

    // Handle file upload (picture)
    if (isset($_FILES["picture"]) && $_FILES["picture"]["error"] == 0) {
        $picture = file_get_contents($_FILES["picture"]["tmp_name"]); // Convert file to binary
    } else {
        $picture = null; // No picture uploaded
    }

    // Prepare and execute SQL query to add a user
    $sql = "INSERT INTO users (picture, username, password, firstname, lastname, department, pin, RFID_UID, role) 
            VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?)";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("sssssssss", $picture, $username, $password, $firstname, $lastname, $department, $pin, $RFID_UID, $role);

    if ($stmt->execute()) {
        echo "<div style='color: green;'>User added successfully.</div>";
    } else {
        echo "<div style='color: red;'>Error adding user: " . $stmt->error . "</div>";
    }
    $stmt->close();
}

// Handle delete requests
if ($_SERVER["REQUEST_METHOD"] === "POST" && isset($_POST['delete_user'])) {
    $user_id = intval($_POST["user_id"]);

    // Prepare and execute SQL query to delete a user
    $sql = "DELETE FROM users WHERE id = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("i", $user_id);

    if ($stmt->execute()) {
        echo "<div style='color: green;'>User deleted successfully.</div>";
    } else {
        echo "<div style='color: red;'>Error deleting user: " . $stmt->error . "</div>";
    }
    $stmt->close();
}

// Retrieve all users to display
$sql = "SELECT id, firstname, lastname, username, department, pin, RFID_UID, role, picture FROM users";
$result = $conn->query($sql);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Management</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            margin: 0;
            padding: 20px;
            background-color: #f4f4f9;
        }
        h1 {
            text-align: center;
        }
        form {
            margin-bottom: 20px;
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
            background-color: #f2f2f2;
        }
        img {
            width: 50px;
            height: 50px;
            border-radius: 50%;
            object-fit: cover;
        }
    </style>
</head>
<body>
    <h1>Admin Management Page</h1>

    <h2>Add User</h2>
    <form method="POST" action="" enctype="multipart/form-data">
        <label>First Name:</label>
        <input type="text" name="firstname" required><br><br>
        <label>Last Name:</label>
        <input type="text" name="lastname" required><br><br>
        <label>Username:</label>
        <input type="text" name="username" required><br><br>
        <label>Password:</label>
        <input type="password" name="password" required><br><br>
        <label>Department:</label>
        <input type="text" name="department" required><br><br>
        <label>PIN:</label>
        <input type="text" name="pin" maxlength="4" pattern="\d{4}" title="Enter a 4-digit PIN" required><br><br>
        <label>RFID UID:</label>
        <input type="text" name="RFID_UID" maxlength="8" required><br><br>
        <label>Role:</label>
        <select name="role">
            <option value="User">User</option>
            <option value="Admin">Admin</option>
        </select><br><br>
        <label>Profile Picture:</label>
        <input type="file" name="picture" accept="image/*"><br><br>
        <button type="submit" name="add_user">Add User</button>
    </form>

    <h2>User List</h2>
    <table>
        <thead>
            <tr>
                <th>ID</th>
                <th>Picture</th>
                <th>First Name</th>
                <th>Last Name</th>
                <th>Username</th>
                <th>Department</th>
                <th>PIN</th>
                <th>RFID UID</th>
                <th>Role</th>
                <th>Actions</th>
            </tr>
        </thead>
        <tbody>
            <?php while ($row = $result->fetch_assoc()): ?>
            <tr>
                <td><?= htmlspecialchars($row['id']) ?></td>
                <td>
                    <?php if ($row['picture']): ?>
                        <img src="data:image/jpeg;base64,<?= base64_encode($row['picture']) ?>" alt="Profile Picture">
                    <?php else: ?>
                        <img src="https://via.placeholder.com/50" alt="No Image">
                    <?php endif; ?>
                </td>
                <td><?= htmlspecialchars($row['firstname']) ?></td>
                <td><?= htmlspecialchars($row['lastname']) ?></td>
                <td><?= htmlspecialchars($row['username']) ?></td>
                <td><?= htmlspecialchars($row['department']) ?></td>
                <td><?= htmlspecialchars($row['pin']) ?></td>
                <td><?= htmlspecialchars($row['RFID_UID']) ?></td>
                <td><?= htmlspecialchars($row['role']) ?></td>
                <td>
                    <form method="POST" action="" style="display: inline-block;">
                        <input type="hidden" name="user_id" value="<?= $row['id'] ?>">
                        <button type="submit" name="delete_user" style="color: red;">Delete</button>
                    </form>
                </td>
            </tr>
            <?php endwhile; ?>
        </tbody>
    </table>
</body>
</html>