gridItems.forEach(gridItem => {
    gridItem.addEventListener('click', function () {
        if(spinning) return;

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