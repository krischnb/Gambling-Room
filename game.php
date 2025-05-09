<?php
session_start();

if (isset($_POST["start"])) {
    $_SESSION["playerName"] = $_POST["player"];
    $_SESSION["balance"] = $_POST["balance"];
    $_SESSION["startBalance"] = $_POST["balance"];
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
    <link rel="stylesheet" href="styles/osnova.css">
    <link rel="icon" type="image/x-icon" href="assets/favIcon.png">
</head>

<body>
    <div class="glavni">
        <div class="gameModal">
            <div class="menu">
                <div class="exitCont">
                    <button class="exitBtn" onclick="location.replace('index.php')" title="Logout">
                        <img src="assets/backBtn.svg" alt="back">
                    </button>
                    <form id="cashoutForm" action="end.php" method="post" autocomplete="off">
                        <input type="hidden" name="player" id="playerInput">
                        <input type="hidden" name="balance" id="balanceInput">
                        <input type="hidden" name="startBalance" id="startBalanceInput">

                        <button name="cashout" type="submit" class="exitBtn" title="Cashout">
                            <img src="assets/withdraw.svg" alt="withdraw">
                        </button>
                    </form>

                    <script>
                        const cashoutForm = document.getElementById("cashoutForm");

                        cashoutForm.addEventListener("submit", function (e) {
                            document.getElementById("playerInput").value = "<?php echo $_SESSION['playerName']; ?>";
                            document.getElementById("balanceInput").value = playerBalance; // from your JS balance variable
                            document.getElementById("startBalanceInput").value = "<?php echo $_SESSION['startBalance']; ?>";
                        });
                    </script>
                    
                    <button class="exitBtn credits" onclick="credits()">
                        <img src="assets/infoImg.svg" alt="info">
                    </button>
                </div>

                <span class="infoLabel">Select a chip</span>
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
                    <span id="balanceSpan">$<?php echo $_SESSION["balance"] ?></span>
                </div>

                <div class="info">
                    <span class="infoLabel">Total bet:</span>
                    <span id="totalBetSpan">$<?php echo $_SESSION["currentBet"] ?></span>
                </div>

                <div class="info">
                    <span class="infoLabel">Last win:</span>
                    <span id="lastWinSpan">$<?php echo $_SESSION["lastResult"] ?></span>
                </div>


                <div class="btnCont">
                    <button id="undoBtn">
                        <svg viewBox="0 0 24 24">
                            <path
                                d="M12.207 2.293a1 1 0 0 1 0 1.414L10.914 5H12.5c4.652 0 8.5 3.848 8.5 8.5S17.152 22 12.5 22 4 18.152 4 13.5a1 1 0 1 1 2 0c0 3.548 2.952 6.5 6.5 6.5s6.5-2.952 6.5-6.5S16.048 7 12.5 7h-1.586l1.293 1.293a1 1 0 0 1-1.414 1.414l-3-3a1 1 0 0 1 0-1.414l3-3a1 1 0 0 1 1.414 0z">
                            </path>
                        </svg>
                        <span>Undo</span>
                    </button>

                    <button id="repeatBtn">
                        <svg viewBox="0 0 24 24">
                            <path
                                d="M12.207 2.293a1 1 0 0 1 0 1.414L10.914 5H12.5c4.652 0 8.5 3.848 8.5 8.5S17.152 22 12.5 22 4 18.152 4 13.5a1 1 0 1 1 2 0c0 3.548 2.952 6.5 6.5 6.5s6.5-2.952 6.5-6.5S16.048 7 12.5 7h-1.586l1.293 1.293a1 1 0 0 1-1.414 1.414l-3-3a1 1 0 0 1 0-1.414l3-3a1 1 0 0 1 1.414 0z">
                            </path>
                        </svg>
                        <span>Repeat</span>
                    </button>
                    <button id="clearBtn">
                        <svg viewBox="0 0 1024 1024">
                            <path
                                d="M899.1 869.6l-53-305.6H864c14.4 0 26-11.6 26-26V346c0-14.4-11.6-26-26-26H618V138c0-14.4-11.6-26-26-26H432c-14.4 0-26 11.6-26 26v182H160c-14.4 0-26 11.6-26 26v192c0 14.4 11.6 26 26 26h17.9l-53 305.6c-0.3 1.5-0.4 3-0.4 4.4 0 14.4 11.6 26 26 26h723c1.5 0 3-0.1 4.4-0.4 14.2-2.4 23.7-15.9 21.2-30zM204 390h272V182h72v208h272v104H204V390z m468 440V674c0-4.4-3.6-8-8-8h-48c-4.4 0-8 3.6-8 8v156H416V674c0-4.4-3.6-8-8-8h-48c-4.4 0-8 3.6-8 8v156H202.8l45.1-260H776l45.1 260H672z"
                                p-id="9724"></path>
                        </svg>
                        <span>Clear</span>
                    </button>
                </div>


                <button class="spinBtn" onclick="spin()">
                    <svg viewBox="0 0 1000 1000">
                        <path
                            d="M493.556 -.063c-265.602 0 -482.306 209.741 -493.5 472.594 -.765 18.027 13 19.031 13 19.031l83.813 0c16.291 0 19.146 -9.297 19.531 -17.625 9.228 -199.317 175.315 -357.688 377.156 -357.688 107.739 0 204.915 45.163 273.719 117.563l-58.813 56.875c-10.23 12.319 -10.043 27.275 5.063 31.5l247.125 49.75c21.15 5.281 46.288 -10.747 37.656 -43.656l-58.375 -227.563c-1.482 -8.615 -15.924 -22.024 -29.406 -12.406l-64.094 60.031c-89.659 -91.567 -214.627 -148.406 -352.875 -148.406zm409.625 508.5c-16.291 0 -19.146 9.297 -19.531 17.625 -9.228 199.317 -175.315 357.688 -377.156 357.688 -107.739 0 -204.915 -45.132 -273.719 -117.531l58.813 -56.906c10.229 -12.319 10.043 -27.275 -5.063 -31.5l-247.125 -49.75c-21.15 -5.281 -46.288 10.747 -37.656 43.656l58.375 227.563c1.482 8.615 15.924 22.024 29.406 12.406l64.094 -60.031c89.659 91.567 214.627 148.406 352.875 148.406 265.602 0 482.306 -209.741 493.5 -472.594 .765 -18.027 -13 -19.031 -13 -19.031l-83.813 0z">
                        </path>
                    </svg>
                    <span>Spin</span>
                </button>
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
                    chip.setAttribute('title', 'Not enough balance');
                    chip.classList.remove('chipPicked');
                } else {
                    chip.classList.remove('disabled');
                    chip.setAttribute('title', `Chip value $${chipValue}`);
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
                    showCloseButton: true,
                    confirmButtonText: 'Okay'
                });
                return;
            }

            let random = randomNumber();

            spinBall(random);
        }

        function endResult(random) {
            const color = getRandomColor(random);
            let colorDiv = '';

            if (color === 'red') {
                colorDiv = `<div class="redSwal colorSwal">${random}</div>`;
            } else if (color === 'black') {
                colorDiv = `<div class="blackSwal colorSwal">${random}</div>`;
            } else {
                colorDiv = `<div class="greenSwal colorSwal">${random}</div>`;
            }
            if (lastWin > 0) {
                Swal.fire({
                    html: `
                        <div class="resultSwal">
                            <h1 class="titleSwal">You Won!</h1>
                            <div class="winSwal">$${lastWin}</div>
                            <div class="landedSwal">${colorDiv} ${getRandomColor(random)}</div>
                        </div>
                    `,
                    showCloseButton: true,
                    showConfirmButton: false,
                    allowOutsideClick: true,
                    allowEscapeKey: true
                }).then(() => {
                    clearRound();
                    updateSession();
                });

            }
            else {
                Swal.fire({
                    html: `
                        <div class="resultSwal">
                            <h1 class="titleSwal">You Lost!</h1>
                            <div class="lostSwal">- $${totalBet}</div>
                            <div class="landedSwal">${colorDiv} ${getRandomColor(random)}</div>
                        </div>
                    `,
                    showCloseButton: true,
                    showConfirmButton: false,
                    allowOutsideClick: true,
                    allowEscapeKey: true
                }).then(() => {
                    clearRound();
                    updateSession();
                });
            }
        }

        function clearRound() {
            gridItems.forEach(gridItem => {
                const placedChips = gridItem.querySelectorAll('.placed-chip');
                placedChips.forEach(chip => chip.remove());
                delete gridItem.dataset.value;  // Clear bet value
            });

            totalBet = 0;
            totalBetSpan.textContent = "$" + totalBet;

            balanceSpan.textContent = "$" + playerBalance;
            lastWinSpan.textContent = "$" + lastWin;
            chipHistory.length = 0; // resetira zgodovino cipov
            updateChipAvailability();
        }

        function credits() {
            Swal.fire({
                title: 'Credits',
                html: `
                    <ul class="credit-list">
                    <li>Made by: Kristijan Boben, 4. Ra</li>
                    <li>Professor: Boštjan Vouk</li>
                    <li>Visit my <a href="https://github.com/krischnb" target="_blank">github</a></li> 
                    </ul>   
                    `,
                icon: 'info',
                showCloseButton: true,
                confirmButtonText: 'Cool!',
            });
        }
    </script>
    <script src="js/infoRand.js"></script>
    <script src="js/payment.js"></script>
    <script src="js/updateSession.js"></script>
    <script src="js/chipPlace.js"></script>
    <script src="js/animation.js"></script>
    <script src="js/tooltip.js"></script>

</body>

</html>