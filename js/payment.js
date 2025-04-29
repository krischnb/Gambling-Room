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