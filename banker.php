<?php
// banker.php - displays the banker offer popup
if (session_status() === PHP_SESSION_NONE) session_start();
require_once "logic/helpers.php";
require_once "logic/banker_logic.php";

$remaining = remaining_values();
$round = $_SESSION['round'];
$offer = banker_offer($remaining, $round);

// Store offer in session history
$_SESSION['bank_offers'][] = $offer;
?>

<div class="bank-offer animation-popup">
    <h2>The Banker is offering:</h2>
    <h3>$<?php echo number_format($offer, 2); ?></h3>

    <form method="post">
        <button class="btn deal" name="deal" type="submit">Deal</button>
        <button class="btn nodeal" name="nodeal" type="submit">No Deal</button>
    </form>
</div>
