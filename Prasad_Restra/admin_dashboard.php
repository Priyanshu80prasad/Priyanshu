<?php
session_start();
require 'includes/dbh.inc.php'; // Database connection

if (!isset($_SESSION['adminId'])) {
    header("Location: admin_login.php");
    exit();
}

// Query to get reservation information
$sql = "SELECT * FROM reservation";
$result = mysqli_query($conn, $sql);

if (!$result) {
    die("Query Failed: " . mysqli_error($conn));
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Dashboard</title>
    <style>
        /* Basic Reset */
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
            font-family: Arial, sans-serif;
        }

        body {
            padding: 20px;
            background-color: gray;
            color: black;
        }

        /* Header Styling */
        h2 {
            margin-bottom: 20px;
            color: red;
            text-align: center;
            background-color: black;
            font-size: 2rem;
            margin-bottom: 30px;
            text-shadow: 2px 1px rgb(235, 203, 20);
        }

        nav {
            margin-bottom: 20px;
        }

        nav ul {
            list-style-type: none;
            padding: 0;
        }

        nav ul li {
            display: inline;
            margin-right: 15px;
        }

        nav ul li a {
            text-decoration: none;
            color: white;
            background-color: blue;
            padding: 5px 10px;
            border-radius: 5px;
        }

        nav ul li a:hover {
            background-color: darkblue;
        }

        /* Table Styling */
        table {
            width: 100%;
            border-collapse: collapse;
            margin-bottom: 20px;
        }

        th, td {
            padding: 10px;
            text-align: left;
            border: 1px solid black;
        }

        th {
            background-color: blue;
            color: white;
        }

        tr:nth-child(even) {
            background-color: yellow;
        }

        tr:hover {
            background-color: pink;
        }

        button {
            padding: 5px 10px;
            background-color: #3498db;
            color: white;
            border: none;
            cursor: pointer;
        }

        button:hover {
            background-color: blue;
        }

    </style>
</head>
<body>
    <h2> <marquee> Admin Dashboard</marquee> </h2>

    <nav>
        <ul>
            <!-- <li><a href="index.php">Home</a></li> -->
            <li><a href="manage item.php">Manage Items</a></li> <!-- Fixed the link -->
        </ul>
    </nav>

    <table>
        <tr>
            <th>ID</th>
            <th>First Name</th>
            <th>Last Name</th>
            <th>Number of Guests</th>
            <th>Date</th>
            <th>Reservation Time</th>
            <th>Mobile No</th>
            <th>Requirement</th>
            <th>Delete Data</th>
        </tr>

        <?php while ($row = mysqli_fetch_assoc($result)) { ?>
            <tr>
                <td><?php echo $row['reserv_id']; ?></td>
                <td><?php echo $row['f_name']; ?></td>
                <td><?php echo $row['l_name']; ?></td>
                <td><?php echo $row['num_guests']; ?></td>
                <td><?php echo $row['rdate']; ?></td>
                <td><?php echo $row['time_zone']; ?></td>
                <td><?php echo $row['telephone']; ?></td>
                <td><?php echo $row['comment']; ?></td>
                <td>
                    <a href="admindelete.php?id=<?php echo $row['reserv_id']; ?>" class="delete-btn">Delete</a>
                </td>
            </tr>
        <?php } ?>
    </table>
</body>
</html>
