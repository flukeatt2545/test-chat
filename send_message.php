<?php

$filename = "messages.txt";

// Read messages from file
if (file_exists($filename)) {
	$messages = json_decode(file_get_contents($filename), true);
} else {
	$messages = [];
}

// Add new message to array
$name = $_POST["name"];
$message = $_POST["message"];
$time = date("Y-m-d H:i:s");
$new_message = ["time" => $time, "name" => $name, "message" => $message];
array_push($messages, $new_message);

// Write messages to file
file_put_contents($filename, json_encode($messages));

// Redirect back to chat page
header("Location: chat.php");

?>
