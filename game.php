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
                    <span id="lastBetSpan"><?php echo $_SESSION["lastResult"] ?>none</span>
                </div>


                <button class="spinBtn" onclick="spin()">Bet</button>
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

                        <div class="grid-item filler"></div> <!-- FILLER -->
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
        let playerBalance = <?php echo $_SESSION["balance"]; ?>;
        let totalBet = 0;
        let lastWin = 0;
        let selectedChip = null;

        let singleBet = 0;

        const lastBetSpan = document.getElementById("lastBetSpan");
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

        gridItems.forEach(gridItem => {
            gridItem.addEventListener('click', function () {
                if (selectedChip === null) {
                    alert("Select a chip first.");
                    return;
                }
                if (selectedChip && playerBalance >= chipValues[selectedChip.id]) {

                    // graficni prikaz
                    const img = document.createElement('img');
                    img.classList.add('placed'); // Mark the chip as placed

                    // Set the source of the image using the chipImages object
                    const chipImagePath = chipImages[selectedChip.id];
                    if (chipImagePath) {
                        img.src = chipImagePath; // Set the image source from the object
                    }

                    // Append the image to the grid item
                    gridItem.appendChild(img);

                    // fizicno urejanje
                    singleBet = chipValues[selectedChip.id];
                    totalBet = totalBet + singleBet;
                    totalBetSpan.textContent = totalBet + "$";
                    playerBalance = playerBalance - singleBet;
                    balanceSpan.textContent = playerBalance + "$";

                    updateChipAvailability();
                }
            });
        });

        function spin() {
            let random = Math.floor(Math.random() * 37);

            Swal.fire({
                title: 'Roulette spin!',
                text: 'The ball has landed on ' + random,
                icon: 'info',
                confirmButtonText: 'Okay'
            });
        }

    </script>

</body>

</html>