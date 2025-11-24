<?php
$offer = 0.00;
if (isset($_SESSION['current_offer']) && $_SESSION['current_offer'] > 0) {
    $offer = $_SESSION['current_offer'];
} elseif (!empty($_SESSION['bank_offers'])) {
    $offer = end($_SESSION['bank_offers']);
}

$csrf_token = generate_csrf_token();
?>

<div class="bank-offer animation-popup">
    <h2>The Banker is offering:</h2>
    <h3>$<?php echo htmlspecialchars(number_format($offer, 2)); ?></h3>

    <form method="post">
        <input type="hidden" name="csrf_token" value="<?php echo htmlspecialchars($csrf_token); ?>">
        <button class="btn deal" name="deal" type="submit">Deal</button>
        <button class="btn nodeal" name="nodeal" type="submit">No Deal</button>
    </form>
</div>
