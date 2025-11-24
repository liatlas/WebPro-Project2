<?php
session_start();
require_once "logic/init.php";
init_game();
?>
<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <link rel="stylesheet" href="css/style.css">
        <link rel="stylesheet" href="css/animations.css">
        <title>Deal or No Deal</title>
    </head>
    <body class="fade-in">
        <div class="center-box">
            <div class="logo">💼</div>
            <h1>
                Deal OR NO DEAL
            </h1>
            <a class="btn" href="select_case.php">
                Start Game
            </a>
            <input type="checkbox" id="how-toggle" class="how-toggle-checkbox">
            <label for="how-toggle" class="btn">
                How to Play
            </label>
            <div class="info-box how-to-play">
                <h3>How to Play</h3>
                <ol style="text-align: left; max-width: 600px; margin: 15px auto; padding-left: 20px;">
                    <li><strong>Select Your Case:</strong> Choose one case from 26 cases to keep throughout the game.</li>
                    <li><strong>Open Cases:</strong> Open other cases to reveal their values. The number of cases you open decreases each round.</li>
                    <li><strong>Banker Offers:</strong> After opening cases each round, the banker will make you an offer based on the remaining values.</li>
                    <li><strong>Deal or No Deal:</strong> Accept the offer (Deal) to end the game, or reject it (No Deal) to continue playing.</li>
                    <li><strong>Win or Lose:</strong> If you take a deal, compare it to your case value. If you refuse all deals, you keep your case value!</li>
                </ol>
                <p style="margin-top: 15px; font-style: italic;">Good luck! The banker is always trying to trick you...</p>
            </div>
        </div>
    </body>    
</html>