<?php
// Establish database connection
$servername = "localhost";
$username = "your_username";
$password = "your_password";
$dbname = "your_database_name";
$conn = new mysqli($servername, $username, $password, $dbname);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Handle form submission
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $username = $_POST["username"];
    $password = $_POST["password"];

    // Query the database
    $sql = "SELECT * FROM users WHERE username = '$username'";
    $result = $conn->query($sql);

    if ($result->num_rows > 0) {
        // User found, compare password
        $row = $result->fetch_assoc();
        $storedPassword = $row["password"];
        if (password_verify($password, $storedPassword)) {
            // Authentication successful
            echo "Login successful!";
        } else {
            // Invalid password
            echo "Invalid password!";
        }
    } else {
        // User not found
        echo "User not found!";
    }
}

// Close database connection
$conn->close();
?>
