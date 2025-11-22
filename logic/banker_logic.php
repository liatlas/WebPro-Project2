<?php
function banker_offer($remaining_values, $round) {
    // output is calculated by taking the average
    // reducing it according to the volatility(spread)
    // increasing it by the round
    $avg = array_sum($remaining_values) / count($remaining_values);

    $max = max($remaining_values);
    $min = min($remaining_values);
    $volatilty = ($max - $min) / $max;

    $round_factor = 0.35 + (round * 0.08);

    $offer = $avg * (1 - $volatilty) * round_factor;
    return round($offer, 2);
}
?>