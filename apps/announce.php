<?php
require_once 'setting.php';

$conn = new mysqli($host, $user, $pass, $data);

if ($conn->connect_error) die("Connaction failed: " . $conn->connect_error);

$querynews = 'SELECT * FROM news ORDER BY date DESC';
$result = $conn->query($querynews);

$title = "";
$announce = "";
$announceImage = "";
if ($result->num_rows > 0) {
    $row = $result->fetch_assoc();
    $title = $row['title'];
    $announce = $row['announce'];
    $announceImage = $row['image'];
} else {
    echo "No news found";
}

$announce = str_replace('<p>', '', $announce);
$announce = str_replace('</p>', '', $announce);
$conn->close();
?>