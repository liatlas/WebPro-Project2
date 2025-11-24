<?php
function init_game() {
    if (isset($_SESSION['cases']) && is_array($_SESSION['cases']) && count($_SESSION['cases']) === 26) {
        return;
    }
    
    $values = [
        0.01, 1, 5, 10, 25, 50, 75, 100,
        200, 300, 400, 500, 750, 1000, 5000,
        10000, 25000, 50000, 75000, 100000,
        200000, 300000, 400000, 500000, 750000, 1000000
    ];

    shuffle($values);

    $_SESSION['cases'] = $values;
    $_SESSION['opened_cases'] = [];
    $_SESSION['player_case'] = null;
    $_SESSION['round'] = 1;
    $_SESSION['bank_offers'] = [];
    $_SESSION['final_offer'] = null;
    $_SESSION['current_offer'] = null;
}
?>