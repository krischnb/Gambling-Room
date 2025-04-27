<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="styles/style.css">
    <link rel="icon" type="image/x-icon" href="assets//ruletFavicon.png">
    <title>Roulette</title>
</head>
<body>
    <div class="glavni">
        
        <form class="loginForm" action="game.php" autocomplete="off" name="form" method="post">
            <h1>Roulette</h1>

            <div class="cont">
                <label for="player">Your name:</label>
                <input class="nameInput" type="text" name="player" maxlength="20" placeholder="What's your name?" required>
            </div>

            <div class="cont">
                <label for="balance">Starting balance:</label>
                <input class="balanceInput" type="number" value="100" min="10" step="10" max="10000" name="balance"required>
                <span id="balanceError" style="display: none">The balance cannot exceed 10,000.</span>
            </div>

            <input class="startBtn" type="submit" name="start" value="Start"></input>
        </form>
    </div>
    
        <script> 
            const input = document.querySelector(".balanceInput");
            const errorMessage = document.getElementById("balanceError");

            input.addEventListener("input", function () {
                const max = 10000;

                // pogleda ce je value nad 10K, ce je se zamenja z max vrednostjo
                if (parseInt(input.value) > max) {
                    input.value = max;
                    errorMessage.classList.add("activeError");
                }
                else{
                    errorMessage.classList.remove("activeError");
                }

                // limit max 5 znaku, ne sme bit vec kot 10K
                const maxLength = 5;
                if (input.value.length > maxLength) {
                input.value = input.value.slice(0, maxLength);
                }
            });

            input.addEventListener("keydown", function (e) { // prepoved pisanja tipke e, in ostalih (po defaultu) dovoljenih znakov
                if (['e', 'E', '+', '-'].includes(e.key)) {
                e.preventDefault();
                }
            });
    </script>
</body>
</html>