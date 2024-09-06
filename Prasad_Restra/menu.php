<?php 
include "header.php";
?>



<?php
include 'includes/dbh.inc.php';
$food_items = mysqli_query($conn, "SELECT * FROM food");

?>
<style>
    /* Table Styling */
    
table {
    width: 80%;
    margin: 20px auto;
    border-collapse: collapse;
    box-shadow: 0 2px 10px rgba(0, 0, 0, 0.1);
}

th, td {
    border: 2px solid black;
    padding: 2px;
    text-align: center;
}

th {
    background-color: black;
    color: yellow;
    font-weight: bold;
}

td img {
    border-radius: 5px;
    border: 1px solid #ddd;
  border-radius: 14px;
  /* padding: 5px; */
  width: 100px;
}

tr:nth-child(even) {
    background-color: white;
}

tr:hover {
    background-color: yellow;
}
h3
{margin:50px;
    padding:10px;
    font-size:30px;
color:red;
    text-align:center;}

</style>
 <table>
    <head>
        
 <h3>Current Menu</h3>
</head>
    <tr>
        <th>Food Name</th>
        <th>Price</th>
        <th>Image</th>
      
    </tr>
    <?php while ($row = mysqli_fetch_assoc($food_items)) { ?>
    <tr>
        <td><?php echo $row['name']; ?></td>
        <td><?php echo $row['price']; ?></td>
        <td><img src="img/<?php echo $row['image']; ?>" width="50"></td>
      
    </tr>
    <?php } ?>
</table> 
