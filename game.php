<?php
session_start();

if (isset($_POST["start"])) {
    $_SESSION["playerName"] = $_POST["player"];
    $_SESSION["balance"] = $_POST["balance"];
    $_SESSION["currentBet"] = 0;
    $_SESSION["lastResult"] = 0;
    header("Location: game.php");
    exit();
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
    <link rel="icon" type="image/x-icon" href="assets/favIcon.png">
</head>

<body>
    <div class="glavniGame">
        <div class="gameModal">
            <div class="menu">
                <button class="backBtn" onclick="location.replace('index.php')">
                    <img src="assets/backBtn.svg" alt="back">
                </button>

                <span class="infoLabel">Chip value 1:1</span>
                <div class="coinSelect">
                    <div id="chip1" class="chip"></div>
                    <div id="chip10" class="chip"></div>
                    <div id="chip25" class="chip"></div>
                    <div id="chip100" class="chip"></div>
                    <div id="chip1000" class="chip"></div>

                </div>
                <script>
                    function loadAndModifySVG(filePath, containerId, newText) {
                        fetch(filePath)
                            .then(response => response.text())
                            .then(svgText => {
                                const container = document.getElementById(containerId);
                                container.innerHTML = svgText;

                                const textElement = container.querySelector('text');
                                if (textElement) {
                                    textElement.textContent = newText;
                                    textElement.setAttribute('font-family', 'sans-serif');
                                }
                            })
                            .catch(error => console.error(`Error loading ${filePath}:`, error));
                    }

                    // Load and modify each chip
                    loadAndModifySVG('assets/chip1.svg', 'chip1', '1');
                    loadAndModifySVG('assets/chip10.svg', 'chip10', '10');
                    loadAndModifySVG('assets/chip25.svg', 'chip25', '25');
                    loadAndModifySVG('assets/chip100.svg', 'chip100', '100');
                    loadAndModifySVG('assets/chip1K.svg', 'chip1000', '1K');
                </script>

                <div class="info">
                    <span class="infoLabel">Name:</span>
                    <span><?php echo $_SESSION["playerName"] ?></span>
                </div>

                <div class="info">
                    <span class="infoLabel">Balance:</span>
                    <span id="balanceSpan"><?php echo $_SESSION["balance"] ?>$</span>
                </div>

                <div class="info">
                    <span class="infoLabel">Total bet:</span>
                    <span id="totalBetSpan"><?php echo $_SESSION["currentBet"] ?>$</span>
                </div>

                <div class="info">
                    <span class="infoLabel">Last win:</span>
                    <span id="lastWinSpan"><?php echo $_SESSION["lastResult"] ?>$</span>
                </div>


                <button class="spinBtn" onclick="spin()">Bet</button>
            </div>
            <div class="gamePanel">
                <div class="rouletteCont">
                    <canvas id="roulette" width="400" height="400"></canvas>
                </div>
                <div class="numbers">
                    <div class="gridSection">
                        <!-- Ničla - 3 vrstice visoka -->
                        <div class="grid-item zero" data-bet="0">0</div>

                        <div class="grid-item filler" data-bet="filler"></div> <!-- FILLER -->
                        <div class="grid-item filler" data-bet="filler"></div>

                        <!-- Column 1 -->
                        <div class="grid-item red" data-bet="3">3</div>
                        <div class="grid-item black" data-bet="2">2</div>
                        <div class="grid-item red" data-bet="1">1</div>

                        <div class="grid-item ducat" data-bet="ducat1">1 to 12</div>
                        <div class="grid-item halfChance" data-bet="1to18">1 to 18</div>

                        <!-- Column 2 -->
                        <div class="grid-item black" data-bet="6">6</div>
                        <div class="grid-item red" data-bet="5">5</div>
                        <div class="grid-item black" data-bet="4">4</div>

                        <!-- Column 3 -->
                        <div class="grid-item red" data-bet="9">9</div>
                        <div class="grid-item black" data-bet="8">8</div>
                        <div class="grid-item red" data-bet="7">7</div>

                        <div class="grid-item halfChance" data-bet="even">Even</div>

                        <!-- Column 4 -->
                        <div class="grid-item red" data-bet="12">12</div>
                        <div class="grid-item black" data-bet="11">11</div>
                        <div class="grid-item black" data-bet="10">10</div>

                        <!-- Column 5 -->
                        <div class="grid-item black" data-bet="15">15</div>
                        <div class="grid-item red" data-bet="14">14</div>
                        <div class="grid-item black" data-bet="13">13</div>

                        <div class="grid-item ducat" data-bet="ducat2">13 to 24</div>

                        <div class="grid-item halfChance redColor" data-bet="redColor"></div>

                        <!-- Column 6 -->
                        <div class="grid-item red" data-bet="18">18</div>
                        <div class="grid-item black" data-bet="17">17</div>
                        <div class="grid-item red" data-bet="16">16</div>

                        <!-- Column 7 -->
                        <div class="grid-item red" data-bet="21">21</div>
                        <div class="grid-item black" data-bet="20">20</div>
                        <div class="grid-item red" data-bet="19">19</div>
                        <div class="grid-item halfChance blackColor" data-bet="blackColor"></div>

                        <!-- Column 8 -->
                        <div class="grid-item black" data-bet="24">24</div>
                        <div class="grid-item red" data-bet="23">23</div>
                        <div class="grid-item black" data-bet="22">22</div>

                        <!-- Column 9 -->
                        <div class="grid-item red" data-bet="27">27</div>
                        <div class="grid-item black" data-bet="26">26</div>
                        <div class="grid-item red" data-bet="25">25</div>

                        <div class="grid-item ducat" data-bet="ducat3">25 to 36</div>
                        <div class="grid-item halfChance" data-bet="odd">Odd</div>

                        <!-- Column 10 -->
                        <div class="grid-item red" data-bet="30">30</div>
                        <div class="grid-item black" data-bet="29">29</div>
                        <div class="grid-item black" data-bet="29">28</div>

                        <!-- Column 11 -->
                        <div class="grid-item black" data-bet="33">33</div>
                        <div class="grid-item red" data-bet="32">32</div>
                        <div class="grid-item black" data-bet="31">31</div>
                        <div class="grid-item halfChance" data-bet="19to36">19 to 36</div>

                        <!-- Column 12 -->
                        <div class="grid-item red" data-bet="36">36</div>
                        <div class="grid-item black" data-bet="35">35</div>
                        <div class="grid-item red" data-bet="34">34</div>

                        <div class="grid-item row" data-bet="row1">2:1</div>
                        <div class="grid-item row" data-bet="row2">2:1</div>
                        <div class="grid-item row" data-bet="row3">2:1</div>

                        <div class="grid-item filler" data-bet="filler"></div>
                        <div class="grid-item filler" data-bet="filler"></div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <script>
        let playerBalance = <?php echo $_SESSION["balance"]; ?>;
        let totalBet = 0;
        let lastWin = 0;
        let selectedChip = null;

        let singleBet = 0;

        const lastWinSpan = document.getElementById("lastWinSpan");
        const balanceSpan = document.getElementById("balanceSpan");
        const totalBetSpan = document.getElementById("totalBetSpan");

        const chips = document.querySelectorAll('.chip');
        const gridItems = document.querySelectorAll('.grid-item');

        // Define chip values based on their IDs
        const chipValues = {
            chip1: 1,
            chip10: 10,
            chip25: 25,
            chip100: 100,
            chip1000: 1000
        };

        const chipImages = {
            chip1: 'assets/chip1.svg',
            chip10: 'assets/chip10.svg',
            chip25: 'assets/chip25.svg',
            chip100: 'assets/chip100.svg',
            chip1000: 'assets/chip1K.svg',
        };

        function updateChipAvailability() {
            chips.forEach(chip => {
                const chipId = chip.id;
                const chipValue = chipValues[chipId];

                // Disable chip if player balance is less than chip value
                if (playerBalance < chipValue) {
                    chip.classList.add('disabled');
                    chip.setAttribute('data-tooltip', 'Not enough balance');
                    chip.classList.remove('chipPicked');

                } else {
                    chip.classList.remove('disabled');
                    chip.removeAttribute('data-tooltip');
                }


                // Add event listener for chip selection
                chip.addEventListener('click', function () {
                    if (chip.classList.contains('disabled')) {
                        // If disabled, don't let them select it
                        return;
                    }
                    selectedChip = chip; // store the selected chip
                    chips.forEach(c => c.classList.remove('chipPicked'));
                    chip.classList.add('chipPicked');
                });
            });
        }

        // Initialize chip availability
        updateChipAvailability();



        function spin() {
            if (totalBet < 1) {
                Swal.fire({
                    title: 'Error!',
                    text: 'Place your bets first!',
                    icon: 'error',
                    confirmButtonText: 'Okay'
                });
                return;
            }

            let random = randomNumber();

            spinBall(random);
            calculateWin(random);
        }

        function endResult(random) {
                Swal.fire({
                    title: 'Roulette spin!',
                    html: `
                    <div style="text-align: center; font-family: sans-serif;">
                        The ball has landed on <strong>${random} ${getRandomColor(random)}</strong><br>
                        <span style="font-size: 18px; margin-top: 10px; font-family: sans-serif;">
                            Total bet: ${totalBet}$. You won ${lastWin > 0 ? '$' + lastWin : 'nothing'}!
                        </span>
                    </div>
                `,
                    icon: 'info',
                    confirmButtonText: 'Okay',
                    allowOutsideClick: true,
                    allowEscapeKey: true
                }).then(() => {
                    clearRound();
                    updateSession();
                });
            }

        function clearRound() {
            gridItems.forEach(gridItem => {
                const placedChips = gridItem.querySelectorAll('.placed-chip');
                placedChips.forEach(chip => chip.remove()); delete gridItem.dataset.value;  // Clear bet value
            });

            totalBet = 0;
            totalBetSpan.textContent = totalBet + "$";

            balanceSpan.textContent = playerBalance + "$";
            lastWinSpan.textContent = lastWin + "$";
            updateChipAvailability();
        }
    </script>
    <script src="js/infoRand.js"></script>
    <script src="js/payment.js"></script>
    <script src="js/updateSession.js"></script>
    <script src="js/chipPlace.js"></script>
    <script src="js/animation.js"></script>

</body>

</html>