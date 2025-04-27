<?php
session_start();

if (isset($_POST["start"])) {
    $_SESSION["playerName"] = $_POST["player"];
    $_SESSION["balance"] = $_POST["balance"];
    $_SESSION["currentBet"] = 0;
    $_SESSION["lastResult"] = null;
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Roulette</title>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <link rel="stylesheet" href="styles/game.css">
    <link rel="icon" type="image/x-icon" href="assets/ruletFavicon.png">
</head>

<body>
    <div class="glavniGame">
        <div class="gameModal">
            <div class="left">
                <button class="backBtn" onclick="location.replace('index.php')">
                    <img src="assets/backBtn.svg" alt="back">
                </button>

                <span>Welcome: <?php echo $_SESSION["playerName"] ?></span>
                <span>Balance: <?php echo $_SESSION["balance"] ?>$</span>

                <button class="spinBtn">Spin</button>
            </div>
            <div class="gamePanel">
                <div class="rouletteCont">
                    <div class="roulette">
                        <div class="wheel"></div>
                        <div class="ballCont"></div>
                    </div>
                </div>
                <div class="numbers">
                    <div class="gridSection">

                        <!-- Ničla - 3 vrstice visoka -->
                        <div class="grid-item zero">0</div>

                        <div class="grid-item filler"></div>  <!-- FILLER -->
                        <div class="grid-item filler"></div>

                        <!-- Column 1 -->
                        <div class="grid-item red">3</div>
                        <div class="grid-item black">2</div>
                        <div class="grid-item red">1</div>

                        <div class="grid-item ducat">1 to 12</div>
                        <div class="grid-item halfChance">1 to 18</div>

                        <!-- Column 2 -->
                        <div class="grid-item black">6</div>
                        <div class="grid-item red">5</div>
                        <div class="grid-item black">4</div>

                        <!-- Column 3 -->
                        <div class="grid-item red">9</div>
                        <div class="grid-item black">8</div>
                        <div class="grid-item red">7</div>

                        <div class="grid-item halfChance">Even</div>
                        
                        <!-- Column 4 -->
                        <div class="grid-item red">12</div>
                        <div class="grid-item black">11</div>
                        <div class="grid-item black">10</div>

                        <!-- Column 5 -->
                        <div class="grid-item black">15</div>
                        <div class="grid-item red">14</div>
                        <div class="grid-item black">13</div>

                        <div class="grid-item ducat">13 to 24</div>

                        <div class="grid-item halfChance redColor"></div>

                        <!-- Column 6 -->
                        <div class="grid-item red">18</div>
                        <div class="grid-item black">17</div>
                        <div class="grid-item red">16</div>
                        

                        <!-- Column 7 -->
                        <div class="grid-item red">21</div>
                        <div class="grid-item black">20</div>
                        <div class="grid-item red">19</div>
                        <div class="grid-item halfChance blackColor"></div>

                        <!-- Column 8 -->
                        <div class="grid-item black">24</div>
                        <div class="grid-item red">23</div>
                        <div class="grid-item black">22</div>

                        <!-- Column 9 -->
                        <div class="grid-item red">27</div>
                        <div class="grid-item black">26</div>
                        <div class="grid-item red">25</div>
                        
                        <div class="grid-item ducat">25 to 36</div>
                        <div class="grid-item halfChance">Odd</div>

                        <!-- Column 10 -->
                        <div class="grid-item red">30</div>
                        <div class="grid-item black">29</div>
                        <div class="grid-item black">28</div>

                        <!-- Column 11 -->
                        <div class="grid-item black">33</div>
                        <div class="grid-item red">32</div>
                        <div class="grid-item black">31</div>
                        <div class="grid-item halfChance">19 to 36</div>

                        <!-- Column 12 -->
                        <div class="grid-item red">36</div>
                        <div class="grid-item black">35</div>
                        <div class="grid-item red">34</div>


                        <div class="grid-item row">2:1</div>
                        <div class="grid-item row">2:1</div>
                        <div class="grid-item row">2:1</div>
                        
                        <div class="grid-item filler"></div>
                        <div class="grid-item filler"></div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <script>
        document.querySelector('.spinBtn').addEventListener('click', function () {
            const result = Math.floor(Math.random() * 37); // Random number from 0 to 36

            Swal.fire({
                title: 'Roulette Spin!',
                text: 'The ball landed on: ' + result,
                icon: 'info',
                confirmButtonText: 'OK'
            });
        });
    </script>
</body>

</html>