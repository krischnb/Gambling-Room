const chipHistory = [];
let lastRoundBets = [];
gridItems.forEach(gridItem => {
    gridItem.addEventListener('click', function () {
        if (spinning) return;

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

            // ---- grafični prikaz ----
            // Calculate new value to show
            const currentBet = parseInt(gridItem.dataset.value || 0);
            const newBet = currentBet + chipValues[selectedChip.id];

            // Get the appropriate chip image based on the value
            const chipImagePath = getChipImage(newBet);

            // Create a new chip element (replace the old chip)
            const placedChip = document.createElement('div');
            placedChip.classList.add('placed-chip');
            placedChip.style.backgroundImage = `url(${chipImagePath})`;

            // Create text element for the new bet value
            const chipText = document.createElement('div');
            chipText.classList.add('chip-text');
            chipText.textContent = newBet;  // Display the updated value

            placedChip.appendChild(chipText);

            // ---- fizično urejanje ----
            gridItem.dataset.value = newBet;

            // Remove the old chip if it exists, and add the new chip
            const oldChip = gridItem.querySelector('.placed-chip');
            if (oldChip) {
                oldChip.remove();  // Remove the old chip
            }

            // Add the new chip to the grid item
            gridItem.appendChild(placedChip);

            // Update balance and total bet (no formatting applied here)
            singleBet = chipValues[selectedChip.id];
            totalBet = totalBet + singleBet;
            totalBetSpan.textContent = totalBet + "$";  // Display total bet (no format)
            playerBalance = playerBalance - singleBet;
            balanceSpan.textContent = playerBalance + "$";  // Display balance (no format)
            updateChipAvailability();

            chipHistory.push({ // se hrani zgodovina postavljenih čipov, za jih lahko potem odstranjuješ
                gridItem: gridItem,
                value: chipValues[selectedChip.id]
            });
        }
    });
});

// Function to get the chip image based on the value
function getChipImage(value) {
    if (value < 10) {
        return chipImages['chip1'];  // Chip for value 1
    } else if (value >= 10 && value < 25) {
        return chipImages['chip10']; // Chip for value 10
    } else if (value >= 25 && value < 100) {
        return chipImages['chip25']; // Chip for value 25
    } else if (value >= 100 && value < 1000) {
        return chipImages['chip100']; // Chip for value 100
    } else if (value >= 1000) {
        return chipImages['chip1000']; // Chip for value 1000
    }
    return ''; // Return an empty string if no chip should be displayed
}

document.getElementById('undoBtn').addEventListener('click', function () {
    if(spinning) return; // med igro, (ko se ruleta vrti) nemores refundad
    
    if (chipHistory.length === 0) {
        Swal.fire({
            title: 'No actions to undo',
            icon: 'info',
            confirmButtonText: 'OK'
        });
        return;
    }


    const lastChip = chipHistory.pop();
    const gridItem = lastChip.gridItem;
    const valueToUndo = lastChip.value;

    // Update dataset value
    const currentBet = parseInt(gridItem.dataset.value || 0);
    const newBet = currentBet - valueToUndo;

    if (newBet > 0) {
        gridItem.dataset.value = newBet;
        const chipImagePath = getChipImage(newBet);
        const placedChip = document.createElement('div');
        placedChip.classList.add('placed-chip');
        placedChip.style.backgroundImage = `url(${chipImagePath})`;

        const chipText = document.createElement('div');
        chipText.classList.add('chip-text');
        chipText.textContent = newBet;
        placedChip.appendChild(chipText);

        const oldChip = gridItem.querySelector('.placed-chip');
        if (oldChip) oldChip.remove();
        gridItem.appendChild(placedChip);
    } else {
        // If bet becomes 0, remove chip completely
        delete gridItem.dataset.value;
        const oldChip = gridItem.querySelector('.placed-chip');
        if (oldChip) oldChip.remove();
    }

    playerBalance += valueToUndo;
    balanceSpan.textContent = playerBalance + "$";

    totalBet -= valueToUndo;
    totalBetSpan.textContent = totalBet + "$";

    updateSession() // spremembe se shranijo v PHP session

    updateChipAvailability();
});

document.getElementById('repeatBtn').addEventListener('click', function () {
    if (spinning) return;

    if (lastRoundBets.length === 0) {
        Swal.fire({
            title: 'No previous bets to repeat',
            icon: 'info',
            confirmButtonText: 'OK'
        });
        return;
    }

    // Calculate total value needed
    const totalRepeatCost = lastRoundBets.reduce((sum, bet) => sum + bet.value, 0);

    if (playerBalance < totalRepeatCost) {
        Swal.fire({
            title: 'Insufficient Balance',
            text: 'You do not have enough balance to repeat the last bet.',
            icon: 'error',
            confirmButtonText: 'Okay'
        });
        return;
    }

    // Apply the same bets again
    lastRoundBets.forEach(bet => {
        const gridItem = bet.gridItem;
        const chipValue = bet.value;

        const currentBet = parseInt(gridItem.dataset.value || 0);
        const newBet = currentBet + chipValue;

        // Update dataset
        gridItem.dataset.value = newBet;

        // Replace visual chip
        const chipImagePath = getChipImage(newBet);
        const placedChip = document.createElement('div');
        placedChip.classList.add('placed-chip');
        placedChip.style.backgroundImage = `url(${chipImagePath})`;

        const chipText = document.createElement('div');
        chipText.classList.add('chip-text');
        chipText.textContent = newBet;
        placedChip.appendChild(chipText);

        const oldChip = gridItem.querySelector('.placed-chip');
        if (oldChip) oldChip.remove();
        gridItem.appendChild(placedChip);

        // Update totals
        totalBet += chipValue;
        playerBalance -= chipValue;

        // Push to chipHistory for possible undo
        chipHistory.push({ gridItem, value: chipValue });
    });

    balanceSpan.textContent = playerBalance + "$";
    totalBetSpan.textContent = totalBet + "$";

    updateSession();
    updateChipAvailability();
});

document.getElementById('clearBtn').addEventListener('click', function () {
    if(spinning) return;

    if (chipHistory.length === 0) {
        Swal.fire({
            title: 'No chips to clear',
            icon: 'info',
            confirmButtonText: 'OK'
        });
        return;
    }
    let refundAmount = 0
    chipHistory.forEach(entry => {
        refundAmount += entry.value;
    });
    playerBalance += refundAmount;
    balanceSpan.textContent = playerBalance + "$";
    clearRound();
});