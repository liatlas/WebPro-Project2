<?php
session_start();
require_once "logic/init.php";
init_game();
?>
<!DOCTYPE html>
    <html>
        <head>
            <link rel="stylesheet" href="css/style.css">
            <title>Deal or no Deal</title>
        </head>
        <body class="fade-in">
            <div class="center-box">
                <h1>
                    Deal OR NO DEAL
                </h1>
                <a class="btn" href="select_case.php">
                    Start Game
                </a>
                <a class="btn" href="#how">
                    How to Play
                </a>
                <div id="how" class="info-box">
                    Open cases, recieve banker offers, decide: Deal or No Deal
            </div>
        </body>    
    </html>