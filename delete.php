<?php
require_once "conn.php";
$id = $_GET['id'] ?? '';
$sql = "DELETE FROM post_title WHERE id='$id'";
$result = mysqli_query($conn, $sql);
header('location:index.php');
