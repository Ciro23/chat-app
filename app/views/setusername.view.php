<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Set username - Chat App</title>

    <link rel="stylesheet" href="/assets/styles/css/set-username.style.css">
</head>
<body>
    <div class="mega-box">
        <h2>Start chatting right now</h2>
        <form action="/set-username/action" method="POST">
            <input type="text" placeholder="Your name" name="username" maxlength="20">
            <input type="submit" value="Chat">
        </form>
    </div>
</body>
</html>