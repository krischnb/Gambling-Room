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
    <link rel="stylesheet" href="style.css">
</head>
<body>
    <div class="glavni">
        <div class="gameModal">
            <div class="left">
                <button class="backBtn">
                    <img src="assets/backBtn.svg" alt="back img">
                </button>

                <span>Welcome: <?php echo $_SESSION["playerName"]?></span>
                <span>Balance: <?php echo $_SESSION["balance"]?>$</span>

                <button class="spinBtn">Spin</button>
            </div>
            <div class="gamePanel">
                <div class="roulette">
                    <img src="assets/ruleta.png" alt="roulette">
                </div>
                <div class="numbers">
                    <div class="gridSection">
                        <!-- Ducat 1 -->
                        <div class="ducat">
                            <div class="grid">
                                <div class="grid-item">1</div>
                                <div class="grid-item">2</div>
                                <div class="grid-item">3</div>
                                <div class="grid-item">4</div>
                                <div class="grid-item">5</div>
                                <div class="grid-item">6</div>
                                <div class="grid-item">7</div>
                                <div class="grid-item">8</div>
                                <div class="grid-item">9</div>
                                <div class="grid-item">10</div>
                                <div class="grid-item">11</div>
                                <div class="grid-item">12</div>
                            </div>
                        </div>

                        <!-- Ducat 2 -->
                        <div class="ducat">
                            <div class="grid">
                                <div class="grid-item">13</div>
                                <div class="grid-item">14</div>
                                <div class="grid-item">15</div>
                                <div class="grid-item">16</div>
                                <div class="grid-item">17</div>
                                <div class="grid-item">18</div>
                                <div class="grid-item">19</div>
                                <div class="grid-item">20</div>
                                <div class="grid-item">21</div>
                                <div class="grid-item">22</div>
                                <div class="grid-item">23</div>
                                <div class="grid-item">24</div>
                            </div>
                        </div>

                        <!-- Ducat 3 -->
                        <div class="ducat">
                            <div class="grid">
                                <div class="grid-item">25</div>
                                <div class="grid-item">26</div>
                                <div class="grid-item">27</div>
                                <div class="grid-item">28</div>
                                <div class="grid-item">29</div>
                                <div class="grid-item">30</div>
                                <div class="grid-item">31</div>
                                <div class="grid-item">32</div>
                                <div class="grid-item">33</div>
                                <div class="grid-item">34</div>
                                <div class="grid-item">35</div>
                                <div class="grid-item">36</div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</body>
</html>