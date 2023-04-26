<?php

$filename = "messages.txt";

// Read messages from file
if (file_exists($filename)) {
	$messages = json_decode(file_get_contents($filename), true);
} else {
	$messages = [];
}

// Display messages as table
echo "<table>";
foreach ($messages as $message) {
	echo "<tr><td>" . htmlspecialchars($message["time"]) . "</td><td>" . htmlspecialchars($message["name"]) . "</td><td>" . htmlspecialchars($message["message"]) . "</td></tr>";
}
echo "</table>";

?>
