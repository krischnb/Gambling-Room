<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="style.css">
    <title>Roulette</title>
</head>
<body>
    <div class="glavni">
        
        <form action="game.php" autocomplete="off" name="form" method="post">
            <h1>Roulette</h1>

            <div class="cont">
                <label for="player">Your name:</label>
                <input class="nameInput" type="text" name="player" maxlength="20" placeholder="What's your name?" required>
            </div>

            <div class="cont">
                <label for="balance">Starting balance:</label>
                <input class="balanceInput" type="number" value="100" min="10" name="balance" maxlength="16" required>
            </div>

            <input class="startBtn" type="submit" name="start" value="Start"></input>
        </form>
    </div>

</body>
</html>