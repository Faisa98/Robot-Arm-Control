<?php
$conn = new mysqli("localhost", "root", "", "name");



$result = $conn->query("SELECT * FROM run");
$row = $result->fetch_assoc();
if ($row != NULL) {
    echo "{$row['Status']},s1{$row['Motor 1']},s2{$row['Motor 2']},s3{$row['Motor 3']},s4{$row['Motor 4']},s5{$row['Motor 5']},s6{$row['Motor 6']}";
}
?>
