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
                    <div class="roulette">
                        <div class="wheel"></div>
                        <div class="ballCont"></div>
                    </div>
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

        gridItems.forEach(gridItem => {
            gridItem.addEventListener('click', function () {
                if (selectedChip === null) {
                    Swal.fire({
                        title: 'Error!',
                        text: 'Select a chip first',
                        icon: 'error',
                        confirmButtonText: 'Okay'
                    });
                    return;
                }
                if (selectedChip && playerBalance >= chipValues[selectedChip.id]) {

                    // ---- graficni prikaz ----
                    const img = document.createElement('img');
                    img.classList.add('placed'); // Mark the chip as placed

                    // Set the source of the image using the chipImages object
                    const chipImagePath = chipImages[selectedChip.id];
                    if (chipImagePath) {
                        img.src = chipImagePath; // Set the image source from the object
                    }

                    // Append the image to the grid item
                    gridItem.appendChild(img);

                    // ---- fizicno urejanje ----

                    const currentBet = parseInt(gridItem.dataset.value || 0);
                    gridItem.dataset.value = currentBet + chipValues[selectedChip.id];
                    // v grid item se shrani kolicina stave, bolj specificno v data-value

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
            if (totalBet < 1) {
                Swal.fire({
                    title: 'Error!',
                    text: 'Place your bets first!',
                    icon: 'error',
                    confirmButtonText: 'Okay'
                });
                return;
            }

            let random = Math.floor(Math.random() * 37);

            calculateWin(random);

            updateSession();
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

        function calculateWin(random) {
            lastWin = 0;

            const randomDucat = getRandomDucat(random);
            const randomRow = getRandomRow(random);
            const randomColor = getRandomColor(random);
            const randomParity = getRandomParity(random);
            const randomHalf = getRandomHalf(random);
            // preveri kam si stavil, in koliko
            gridItems.forEach(gridItem => {
                const betValue = parseInt(gridItem.dataset.value || 0);  // Get the bet total for this cell
                const betName = gridItem.dataset.bet;  // This holds the name of the cell (e.g., "ducat1", "6", etc.)

                if (betValue > 0) { // bo slo gledat za celice, samo ce je gori stava
                    // bo slo specificno gledat kam je bil postavljen in ce si zmagal bo izplacalo bo kolikor je vrednost celice

                    // Check for ducat bet (1-12, 13-24, 25-36)
                    if (betName === 'ducat1' && randomDucat === 'ducat1') {
                        playerBalance += betValue * 3;  // Pays 3x for 1-12
                        lastWin += betValue * 3;
                    } else if (betName === 'ducat2' && randomDucat === 'ducat2') {
                        playerBalance += betValue * 3;  // Pays 3x for 13-24
                        lastWin += betValue * 3;
                    } else if (betName === 'ducat3' && randomDucat === 'ducat3') {
                        playerBalance += betValue * 3;  // Pays 3x for 25-36
                        lastWin += betValue * 3;
                    }

                    // Check for row bets (row1, row2, row3)
                    if (betName === 'row1' && randomRow === 'row1') {
                        playerBalance += betValue * 3;  // Pays 3x for row1
                        lastWin += betValue * 3;
                    } else if (betName === 'row2' && randomRow === 'row2') {
                        playerBalance += betValue * 3;  // Pays 3x for row2
                        lastWin += betValue * 3;
                    } else if (betName === 'row3' && randomRow === 'row3') {
                        playerBalance += betValue * 3;  // Pays 3x for row3
                        lastWin += betValue * 3;
                    }

                    // Check for color bets (Red, Black)
                    if (betName === 'redColor' && randomColor === 'red') {
                        playerBalance += betValue * 2;  // Pays 2x for Red
                        lastWin += betValue * 2;
                    } else if (betName === 'blackColor' && randomColor === 'black') {
                        playerBalance += betValue * 2;  // Pays 2x for Black
                        lastWin += betValue * 2;
                    }

                    // Check for parity bets (Even, Odd)
                    if (betName === 'even' && randomParity === 'even') {
                        playerBalance += betValue * 2;  // Pays 2x for Even
                        lastWin += betValue * 2;
                    } else if (betName === 'odd' && randomParity === 'odd') {
                        playerBalance += betValue * 2;  // Pays 2x for Odd
                        lastWin += betValue * 2;
                    }

                    // Check for half bets (1 to 18, 19 to 36)
                    if (betName === '1to18' && randomHalf === '1to18') {
                        playerBalance += betValue * 2;  // Pays 2x for 1-18
                        lastWin += betValue * 2;
                    } else if (betName === '19to36' && randomHalf === '19to36') {
                        playerBalance += betValue * 2;  // Pays 2x for 19-36
                        lastWin += betValue * 2;
                    }

                    // Ce si stavu na stevilko, in je bila taprava
                    if (betName === random.toString()) {
                        playerBalance += betValue * 36;
                        lastWin += betValue * 36;
                    }
                }
            });

            gridItems.forEach(gridItem => { // zbrise vsem cellam podatke o stavi
                delete gridItem.dataset.value;
            });
        }

        function clearRound() {
            gridItems.forEach(gridItem => {
                const placedChips = gridItem.querySelectorAll('.placed');
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
    <script src="js/updateSession.js"></script>

</body>

</html>