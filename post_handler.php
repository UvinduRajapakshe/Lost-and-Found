<?php
// Establish a connection to MySQL (Make sure to replace these values with your own)
$servername = "your_server_name";
$username = "your_username";
$password = "your_password";
$dbname = "your_database_name";

$conn = new mysqli($servername, $username, $password, $dbname);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Handle the form submission
$item_type = $_POST['item_type'];
$name = $_POST['name'];
$location = $_POST['location'];
$description = $_POST['description'];
$contact_details = $_POST['contact_details'];

// Handle file upload
$image_path = "uploads/"; // Create a folder named 'uploads' in your project directory
$image_name = $_FILES['image']['name'];
$image_temp = $_FILES['image']['tmp_name'];
move_uploaded_file($image_temp, $image_path . $image_name);

// Insert data into the database
$sql = "INSERT INTO lost_found_items (item_type, name, location, description, contact_details, image_path) 
        VALUES ('$item_type', '$name', '$location', '$description', '$contact_details', '$image_path$image_name')";

// ... (previous code)

if ($conn->query($sql) === TRUE) {
    // Redirect to the home page
    header("Location: index.html");
    exit();
} else {
    echo "Error: " . $sql . "<br>" . $conn->error;
}

$conn->close();
?>
