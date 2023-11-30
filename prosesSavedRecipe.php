<?php

session_start();
include("config.php");

$selected_ID_Menu = $_SESSION["selected_id_menu"];
$user_now = $_SESSION["username_now"];

$result_saved = pg_query($db, "SELECT * FROM savedrecipe WHERE id = $selected_ID_Menu AND username = '$user_now'");
$row_count = pg_num_rows($result_saved);

if($row_count > 0) $result_saved_last = pg_query($db, "DELETE FROM savedrecipe WHERE id = $selected_ID_Menu AND username = '$user_now';");
else $result_saved_last = pg_query($db, "INSERT INTO savedrecipe (id, username) VALUES ($selected_ID_Menu, '$user_now');");
?>