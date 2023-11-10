<!DOCTYPE html>
<html>
<head>
<style>
    /* Style the chat container */
    .chat-container {
        border: 1px solid #ccc;
        padding: 10px;
        width: 300px;
        margin: 0 auto;
    }
    
    /* Style the chat messages */
    .chat-message {
        margin: 10px 0;
    }
    
    /* Style the user input field */
    .user-input {
        width: 100%;
        padding: 10px;
        margin-top: 10px;
    }
</style>
</head>
<body>

<div class="chat-container" id="chat-container">
    <div class="chat-message" id="chat-message">
        <p>Welcome to the chat! Start by typing a message below:</p>
    </div>
    <input type="text" class="user-input" id="user-input" placeholder="Type your message here">
</div>

<script>
    // Function to send and receive messages
    function sendMessage() {
        var userInput = document.getElementById('user-input');
        var chatMessage = document.getElementById('chat-message');
        var message = userInput.value;

        if (message !== '') {
            var newMessage = document.createElement('p');
            newMessage.innerHTML = '<strong>You:</strong> ' + message;
            chatMessage.appendChild(newMessage);
            userInput.value = '';
        }
    }

    // Event listener for the Enter key
    document.getElementById('user-input').addEventListener('keypress', function (e) {
        if (e.key === 'Enter') {
            sendMessage();
        }
    });
</script>

</body>
</html>
