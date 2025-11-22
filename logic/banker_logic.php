<?php
function banker_offer($values, $round) {
    if (empty($values) || !is_array($values)) {
        return 0.00;
    }
    
    $count = count($values);
    if ($count === 0) {
        return 0.00;
    }
    
    $avg = array_sum($values) / $count;
    $max = max($values);
    $min = min($values);
    
    if ($max == 0) {
        return 0.00;
    }
    
    $volatility = ($max - $min) / $max;
    $factor = 0.35 + ($round * 0.08);
    
    if ($factor > 1.0) {
        $factor = 1.0;
    }

    $offer = $avg * (1 - $volatility) * $factor;
    
    $min_offer = $avg * 0.01;
    if ($offer < $min_offer) {
        $offer = $min_offer;
    }
    
    return round($offer, 2);
}
?>