<?php
function remaining_values() {
    $remaining = [];
    
    if (!isset($_SESSION['cases']) || !is_array($_SESSION['cases'])) {
        return $remaining;
    }
    
    $opened = isset($_SESSION['opened_cases']) ? $_SESSION['opened_cases'] : [];
    $player = isset($_SESSION['player_case']) ? $_SESSION['player_case'] : null;

    foreach ($_SESSION['cases'] as $i => $val) {
        if (!in_array($i, $opened) && $i != $player) {
            $remaining[] = $val;
        }
    }        
    return $remaining;
}

function cases_per_round($round) {
    if (!is_numeric($round) || $round < 1) {
        return 1;
    }
    return max(1, 6 - ($round - 1));
}

function is_game_complete() {
    if (!isset($_SESSION['cases']) || !isset($_SESSION['opened_cases']) || !isset($_SESSION['player_case'])) {
        return false;
    }
    
    $total = count($_SESSION['cases']);
    $opened = count($_SESSION['opened_cases']);
    
    return ($opened >= ($total - 1));
}

function generate_csrf_token() {
    if (!isset($_SESSION['csrf_token'])) {
        $_SESSION['csrf_token'] = bin2hex(random_bytes(32));
    }
    return $_SESSION['csrf_token'];
}

function validate_csrf_token($token) {
    return isset($_SESSION['csrf_token']) && hash_equals($_SESSION['csrf_token'], $token);
}
?>