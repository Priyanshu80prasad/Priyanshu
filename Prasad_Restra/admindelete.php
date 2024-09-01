<?php
$id=$_GET['id'];

require 'includes/dbh.inc.php';

$q="delete from reservation where reserv_id={$id}";

mysqli_query($conn,$q);
header("location:admin_dashboard.php");
?>