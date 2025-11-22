<?php
session_start();

function init_game() {
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
}
?>