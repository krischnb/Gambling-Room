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

            <div class="infoCont">
                <div class="cont">
                    <label for="player">Name:</label>
                    <input class="nameInput" type="text" name="player" placeholder="Enter your name" maxlength="10" required>
                </div>

                <div class="cont">
                    <label for="balance">Balance:</label>
                    <input class="balanceInput" type="text" name="balance" placeholder="Enter your starting balance" maxlength="10" required>
                </div>
            </div>

            <input class="startBtn" type="submit" name="igraj" value="Start"></input>
        </form>
    </div>

</body>
</html>