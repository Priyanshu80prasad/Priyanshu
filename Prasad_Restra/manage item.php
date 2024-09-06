
<?php
// admin_dashboard.php

include 'includes/dbh.inc.php'; // Include database connection

// Handle Add Food
if (isset($_POST['add_food'])) {
    $food_name = $_POST['food_name'];
    $food_price = $_POST['food_price'];

    // Image upload logic
    $image = $_FILES['food_image']['name'];
    $target = "img/" . basename($image);

    if (move_uploaded_file($_FILES['food_image']['tmp_name'], $target)) {
        $sql = "INSERT INTO food (name, price, image) VALUES ('$food_name', '$food_price', '$image')";
        mysqli_query($conn, $sql);
        echo "Food item added successfully.";
    } else {
        echo "Failed to upload image.";
    }
}

// Handle Update Food
if (isset($_POST['update_food'])) {
    $food_id = $_POST['food_id'];
    $food_name = $_POST['food_name'];
    $food_price = $_POST['food_price'];
    
    $sql = "UPDATE food SET name='$food_name', price='$food_price' WHERE id=$food_id";
    
    // Update image if a new one is uploaded
    if (!empty($_FILES['food_image']['name'])) {
        $image = $_FILES['food_image']['name'];
        $target = "img/" . basename($image);
        if (move_uploaded_file($_FILES['food_image']['tmp_name'], $target)) {
            $sql = "UPDATE food SET name='$food_name', price='$food_price', image='$image' WHERE id=$food_id";
        }
    }

    mysqli_query($conn, $sql);
    echo "Food item updated successfully.";
}

// Handle Delete Food
if (isset($_GET['delete'])) {
    $food_id = $_GET['delete'];
    mysqli_query($conn, "DELETE FROM food WHERE id=$food_id");
    echo "Food item deleted successfully.";
}

// Fetch all food items
$food_items = mysqli_query($conn, "SELECT * FROM food");
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Admin Dashboard</title>
    <link rel="stylesheet" href="css/style.css"> <!-- Link to your stylesheet -->
    <style>/* General Body Style */
body {
    font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
    margin: 10;
    padding: 10;
    background-color: black;
}

/* Header Style */
h2 {
    background-color: brown;
    color: white;
    padding: 15px;
    margin: 10;
    text-align: center;
    font-size: 24px;
    border-bottom: 4px solid blue;
}

/* Navigation Links */
li a {
    text-decoration: none;
    color: yellow;
    font-size: 28px;
    margin: 10px;
    display: inline-block;
}

li a:hover {
    text-decoration: underline;
    color:red;
}

/* Form Style */
form {
    margin: 20px auto;
    padding: 20px;
    max-width: 600px;
    background-color: purple    ;
    border-radius: 8px;
    box-shadow: 0 4px 8px rgba(0,0,0,0.1);
}

input[type="text"],
input[type="number"],
input[type="file"] {
    display: block;
    width: calc(100% - 24px); /* Adjust width to account for padding */
    margin-bottom: 15px;
    padding: 12px;
    border: 1px solid blue;
    border-radius: 4px;
}

button {
    background-color: #007bff;
    color: white;
    border: none;
    padding: 12px 20px;
    text-align: center;
    text-decoration: none;
    display: inline-block;
    font-size: 16px;
    margin: 4px 2px;
    cursor: pointer;
    border-radius: 4px;
    transition: background-color 0.3s ease;
}

button:hover {
    background-color: red;
}

/* Table Style */
table {
    width: 100%;
    border-collapse: collapse;
    margin: 20px auto;
    max-width: 800px;
    background-color:white;
    border-radius: 8px;
    box-shadow: 0 4px 8px rgba(0,0,0,0.1);
}

th, td {
    border: 1px solid #ddd;
    padding: 12px;
    text-align: center;
}

th {
    background-color: #f8f9fa;
    color: #333;
}

tr:nth-child(even) {
    background-color: #f2f2f2;
}

img {
    max-width: 800px;
    height: auto;
    border-radius: 4px;
}

a {
    color: #dc3545;
    text-decoration: none;
    font-weight: bold;
}

a:hover {
    text-decoration: underline;
}

        </style>
</head>


<body>



<h2>Admin Dashboard - Manage Food Items</h2>
<li><a href="admin_dashboard.php">Admin Dashboard</a></li> <!-- Fixed the link -->

<!-- Add Food Form -->
<form method="POST" enctype="multipart/form-data">
    <input type="text" name="food_name" placeholder="Food Name" required>
    <input type="number" name="food_price" placeholder="Food Price" required>
    <input type="file" name="food_image" accept="image/*" required>
    <button type="submit" name="add_food">Add Food</button>
</form>

<h3>Current Menu</h3>
<table>
    <tr>
        <th>Food Name</th>
        <th>Price</th>
        <th>Image</th>
        <th>Action</th>
    </tr>
    <?php while ($row = mysqli_fetch_assoc($food_items)) { ?>
    <tr>
        <td><?php echo $row['name']; ?></td>
        <td><?php echo $row['price']; ?></td>
        <td><img src="img/<?php echo $row['image']; ?>" width="50"></td>
        <td>
            <!-- Edit Form -->
            <form method="POST" enctype="multipart/form-data" style="display: inline-block;">
                <input type="hidden" name="food_id" value="<?php echo $row['id']; ?>">
                <input type="text" name="food_name" value="<?php echo $row['name']; ?>" required>
                <input type="number" name="food_price" value="<?php echo $row['price']; ?>" required>
                <input type="file" name="food_image" accept="image/*">
                <button type="submit" name="update_food">Update</button>
                <a href="manage item.php?delete=<?php echo $row['id']; ?>">Delete</a>
            </form>
            
            <!-- Delete Food -->
            <a href="manage item.php?delete=<?php echo $row['id']; ?>">Delete</a>
           
        </td>
    </tr>
    <?php } ?>
</table>

</body>
</html>
