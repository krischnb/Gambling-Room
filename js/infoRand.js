function getRandomDucat(random) {
    if (random >= 1 && random <= 12) {
        return 'ducat1';
    } else if (random >= 13 && random <= 24) {
        return 'ducat2';
    } else if (random >= 25 && random <= 36) {
        return 'ducat3';
    }
    return '';
}

function getRandomRow(random) {
    const row1 = [3, 6, 9, 12, 15, 18, 21, 24, 27, 30, 33, 36];
    const row2 = [2, 5, 8, 11, 14, 17, 20, 23, 26, 29, 32, 35];
    const row3 = [1, 4, 7, 10, 13, 16, 19, 22, 25, 28, 31, 34];

    if (row1.includes(random)) {
        return 'row1';
    } else if (row2.includes(random)) {
        return 'row2';
    } else if (row3.includes(random)) {
        return 'row3';
    }
    return '';
}

function getRandomColor(random) {
    const redNumbers = [1, 3, 5, 7, 9, 12, 14, 16, 18, 19, 21, 23, 25, 27, 30, 32, 34, 36];
    const blackNumbers = [2, 4, 6, 8, 10, 11, 13, 15, 17, 20, 22, 24, 26, 28, 29, 31, 33, 35];

    if (redNumbers.includes(random)) {
        return 'red';
    } else if (blackNumbers.includes(random)) {
        return 'black';
    }
    return 'green';
}

function getRandomParity(random) {
    if (random % 2 === 0 && random !== 0) {
        return 'even';
    }
    return 'odd';
}

function getRandomHalf(random) {
    if (random >= 1 && random <= 18) {
        return '1to18';
    } else if (random >= 19 && random <= 36) {
        return '19to36';
    }
    return '';
}
