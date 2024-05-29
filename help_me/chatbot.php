<?php
include 'db.php';

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $user_message = $_POST['message'];
    $bot_response = generateResponse($user_message);
    
    // Save the conversation in the database
    $stmt = $conn->prepare("INSERT INTO chat_logs (user_message, bot_response) VALUES (?, ?)");
    $stmt->bind_param("ss", $user_message, $bot_response);
    $stmt->execute();
    $stmt->close();

    echo json_encode(["response" => $bot_response]);
}

function generateResponse($message) {
    // Simple response logic
    $message = strtolower($message);
    $response = "Sorry, I don't understand.";

    if (strpos($message, 'hello') !== false) {
        $response = "Hello! How can I help you?";
    } elseif (strpos($message, 'how are you') !== false) {
        $response = "I'm just a bot, but I'm here to help you!";
    } elseif (strpos($message, 'bye') !== false) {
        $response = "Goodbye! Have a great day!";
    }

    return $response;
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Chatbot</title>
    <style>
        body { font-family: Arial, sans-serif; }
        #chatbox { width: 500px; height: 400px; border: 1px solid #ccc; overflow-y: scroll; padding: 10px; }
        #message { width: 400px; }
        #send { padding: 10px 20px; }
    </style>
</head>
<body>
    <div id="chatbox"></div>
    <input type="text" id="message" placeholder="Type a message...">
    <button id="send">Send</button>

    <script>
        document.getElementById('send').addEventListener('click', function() {
            var message = document.getElementById('message').value;
            var chatbox = document.getElementById('chatbox');

            var userMessage = document.createElement('div');
            userMessage.textContent = "You: " + message;
            chatbox.appendChild(userMessage);

            fetch('chatbot.php', {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/x-www-form-urlencoded'
                },
                body: 'message=' + encodeURIComponent(message)
            })
            .then(response => response.json())
            .then(data => {
                var botResponse = document.createElement('div');
                botResponse.textContent = "Bot: " + data.response;
                chatbox.appendChild(botResponse);
                chatbox.scrollTop = chatbox.scrollHeight;
            });

            document.getElementById('message').value = '';
        });
    </script>
</body>
</html>