<?php
session_start();

if (isset($_POST["cashout"])) {
    $_SESSION["playerName"] = $_POST["player"];
    $_SESSION["balance"] = $_POST["balance"];
    $_SESSION["startBalance"] = $_POST["startBalance"]; 
    header("Location: end.php");
    exit();
}

$player = $_SESSION["playerName"] ?? 'Unknown';
$balance = $_SESSION["balance"] ?? 0;
$startBalance = $_SESSION["startBalance"] ?? 0;
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="styles/end.css">
    <link rel="stylesheet" href="styles/osnova.css">
    <link rel="icon" type="image/x-icon" href="assets//favIcon.png">
    <title>Roulette</title>
</head>
<body>
    <div class="glavni">
        <span class="glavniNaslov">Roulette Simulator</span>

        <div class="loginForm">
            <h1>Summary</h1>

            <div class="summaryBox" id="summary"></div>

            <form action="index.php" method="post">
                <input class="endBtn" type="submit" name="end" value="Leave now">
            </form>
        </div>
        <div id="countdownTimer" class="countdown">Redirecting in <span id="timer">10</span>...</div>
    </div>
    <script>
    let timeLeft = 10;
    const timerElement = document.getElementById("timer");

    const countdownInterval = setInterval(() => {
        timeLeft--;
        timerElement.textContent = timeLeft;

        if (timeLeft <= 0) {
            clearInterval(countdownInterval);
            window.location.href = "index.php";
        }
    }, 1000);
</script>


    <script>
        const player = <?php echo json_encode($player); ?>;
        const balance = parseFloat(<?php echo json_encode($balance); ?>);
        const startBalance = parseFloat(<?php echo json_encode($startBalance); ?>);
        const profit = balance - startBalance;

        const summary = `
            <div><span class="label">Player:</span> ${player}</div>
            <div><span class="label">Start Balance:</span> $${startBalance.toFixed(2)}</div>
            <div><span class="label">End Balance:</span> $${balance.toFixed(2)}</div>
            <div><span class="label">Profit/Loss:</span> <span class="profit" style="color: ${profit >= 0 ? 'lime' : 'red'}">$${profit.toFixed(2)}</span></div>
        `;

        document.getElementById("summary").innerHTML = summary;
    </script>
</body>
</html>
