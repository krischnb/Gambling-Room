<?php
session_start();

if (isset($_POST["start"])) {
    $_SESSION["playerName"] = $_POST["player"];
    $_SESSION["balance"] = $_POST["balance"];
    $_SESSION["currentBet"] = 0;
    $_SESSION["lastResult"] = 0;
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="styles/style.css">
    <link rel="icon" type="image/x-icon" href="assets//favIcon.png">
    <title>Roulette</title>
</head>
<body>
    <div class="glavni3">
        <div class="endForm">

        </div>
    </div>
</body>
</html>