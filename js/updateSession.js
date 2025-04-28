function updateSession() {
    fetch('update_session.php', {
        method: 'POST',
        headers: {
            'Content-Type': 'application/x-www-form-urlencoded',
        },
        body: `balance=${playerBalance}&lastWin=${lastWin}&totalBet=${totalBet}`
    }).catch(error => console.error('Error updating session:', error));
}