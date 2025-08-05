<?php
$conn = new mysqli("localhost", "root", "", "name");

$result = $conn->query("SELECT * FROM run");
$row = $result->fetch_assoc();
if ($row != NULL) {
    $conn->query("UPDATE `run` SET status = 0 WHERE Status = 1");
    echo "Record updated successfully to 0";
}