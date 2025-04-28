<?php
session_start();

if ($_SERVER["REQUEST_METHOD"] === "POST") {
    if (isset($_POST['balance']) && is_numeric($_POST['balance'])) {
        $_SESSION['balance'] = intval($_POST['balance']);
    }
    if (isset($_POST['lastWin']) && is_numeric($_POST['lastWin'])) {
        $_SESSION['lastResult'] = intval($_POST['lastWin']);
    }
    if (isset($_POST['totalBet']) && is_numeric($_POST['totalBet'])) {
        $_SESSION['currentBet'] = intval($_POST['totalBet']);
    }
    
    echo json_encode(['status' => 'success']);
    exit();
}

echo json_encode(['status' => 'error', 'message' => 'Invalid request']);
?>