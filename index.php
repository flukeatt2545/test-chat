<!DOCTYPE html>
<html>
<head>
	<title>Real-time Chat</title>
    <link rel="stylesheet" href="ste.css">
	<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
</head>

<body>
	<h2>Real-time Chat</h2>
	<div>
		<label for="name">Name:</label>
		<input type="text" id="name" placeholder="Enter your name">
	</div>
	<div>
		<label for="message">Message:</label>
		<input type="text" id="message" placeholder="Type your message here">
		<button type="button" onclick="sendMessage()">Send</button>
	</div>
	<div id="chatbox"></div>

	<script>
		function getMessages() {
			$.get("messages.php", function(data) {
				$("#chatbox").html(data);
			});
		}

		function sendMessage() {
			var name = $("#name").val();
			var message = $("#message").val();
			if (name != "" && message != "") {
				$.post("send_message.php", {name: name, message: message}, function() {
					$("#name").val("");
					$("#message").val("");
					getMessages();
				});
			}
		}

		setInterval(function() {
			getMessages();
		}, 1000); // Refresh every 1 second
	</script>
</body>
</html>
