<?php
include 'includes/dbh.inc.php';
$id=$_GET["id"];
echo $id;
$food_items = mysqli_query($conn, "SELECT * FROM food");
?>
<form method="POST" enctype="multipart/form-data">
    <input type="text" name="food_name" placeholder="Food Name" required>
    <input type="number" name="food_price" placeholder="Food Price" required>
    <input type="file" name="food_image" accept="image/*" required>
    <button type="submit" name="add_food">Add Food</button>
</form>