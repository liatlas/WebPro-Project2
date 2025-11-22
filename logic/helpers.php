<?php
function remaining_values() {
    // Determines what cases are left
    $remaining = [];

    foreach ($_SESSION['cases'] as $i => $val) {
            // Cases that have been opened and the player's selected case are excluded
            if (!in_array($i, $_SESSION['opened_cases']) &&
            $i != $_SESSION['player_case']) {
                $remaining[] = $val;
            }
            return $remaining;
    }        
}
?>