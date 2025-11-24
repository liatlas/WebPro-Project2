# Deal or No Deal – Enhanced PHP Edition

A classic high-stakes game of chance and strategy, this web-based **Deal or No Deal** reimagines the TV experience with unpredictable market twists, algorithmic negotiations, and immersive briefcase interactions. Built in PHP, every game is a psychological and statistical battle: select your briefcase, negotiate with a virtual Banker, and navigate volatile market events that can shift your fortune in real time.

---

## Enhanced Overview

Players face a suspenseful experience, selecting one briefcase and eliminating others while being tempted by offers from a sophisticated algorithmic Banker. Every round is a test of strategy, intuition, and nerve as guaranteed cash offers are weighed against the possibility of winning the top prize. Behind the scenes, clever server-side logic ensures each session is unpredictable, dynamic, and engaging.

---

## Core Features

- **PHP Session-Based Briefcase Management**  
  - Securely tracks your briefcase choices, opened cases, offer history, and current round throughout your game session.

- **Algorithmic Banker Offers**  
  - The Banker generates multi-variable offers using PHP algorithms with volatility factors, simulating bluffs and psychological pressure.

- **Procedural Value Distribution**  
  - Briefcase values are assigned using hardcoded value sets validated server-side to prevent tampering or prediction.

- **Interactive CSS-Animated Briefcases**  
  - Opening, selecting, and revealing briefcases is visually simulated using CSS animations triggered by PHP page reloads.

---

## Additional Key Feature


- **Progressive Value Revelation**  
  - Case values and remaining sums are hidden and revealed gradually, with PHP controlling which values are displayed after each choice.


---

## Setup Instructions

1. **Prerequisites**
    - PHP (7.2+ recommended)
    - Any web server (Apache, Nginx, XAMPP, MAMP, etc.)

2. **Clone the Repository**
    ```sh
    git clone https://github.com/liatlas/WebPro-Project2.git
    cd WebPro-Project2
    ```

3. **Project Structure**
    - `index.php` – Main game interface
    - `logic/init.php` – Game/session initialization
    - `logic/banker_logic.php` – Banker offer and market event logic
    - Other logic files for additional advanced interactions

4. **Run Locally**
    - Place project in your web server’s document root (e.g., `htdocs`)
    - Open `http://localhost/WebPro-Project2/index.php` in your browser

---
