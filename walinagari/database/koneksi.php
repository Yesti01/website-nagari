<?php
$db = new mysqli("localhost", "root", "", "walinagari");
if ($db->connect_error) {
    die("db gagal: " . $db->connect_error);
}
?>