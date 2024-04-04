<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>PHP Game: Final Project</title>
    <style>
        body {
            display: flex;
            justify-content: center;
            align-items: center;
            min-height: 100vh;
            margin: 0;
            font-family: Arial, sans-serif;
        }

        .container {
            text-align: center;
            max-width: 600px;
            padding: 20px;
            border: 1px solid #ccc;
            border-radius: 5px;
            background-color: #f9f9f9;
        }

        .container p {
            margin-bottom: 10px;
        }

        .container form {
            margin-top: 20px;
        }

        .container input[type="text"],
        .container input[type="submit"],
        .container input[type="button"] {
            padding: 8px;
            margin-right: 10px;
        }
    </style>
</head>
<body>
    <div class="container">
        <h1>PHP Game: Final Project</h1>

        <?php
        function generateRandomNumbers($min, $max, $quantity) {
            $numbers = range($min, $max);
            shuffle($numbers);
            return array_slice($numbers, 0, $quantity);
        }

        function generateRandomLetters($quantity, $lowercase) {
            $letters = range('a', 'z');
            if (!$lowercase) {
                $letters = range('A', 'Z');
            }
            shuffle($letters);
            return array_slice($letters, 0, $quantity);
        }

        $level = isset($_POST['level']) ? $_POST['level'] : 1;
        $content = '';
        $gameStatus = '';
        $lives = isset($_POST['lives']) ? $_POST['lives'] : 6;

        if ($_SERVER["REQUEST_METHOD"] == "POST") {
            if (isset($_POST['input']) && isset($_POST['expected'])) {
                $input = $_POST['input'];
                $expected = $_POST['expected'];

                if ($input == $expected) {
                    $level++;

                    if ($level == 7) {
                        $gameStatus = 'You won!';
                    }
                } else {
                    if ($lives <= 0) {
                        $gameStatus = 'Game Over';
                    } else {
                        $lives--;
                    }
                }

                $inputArray = explode(',', $input);
                $expectedArray = explode(',', $expected);
                $result = '';

                if (count(array_intersect($inputArray, $expectedArray)) == 0) {
                    $result = 'Incorrect – All your numbers are different from ours.';
                } else {
                    $diff = array_diff($inputArray, $expectedArray);
                    if (!empty($diff)) {
                        $result = 'Incorrect – Some of your numbers are different from ours.';
                    } else {
                        if ($input != $expected) {
                            $result = 'Incorrect – Your numbers were not correctly arranged in ascending order.';
                        } else {
                            $result = 'Correct – Your numbers have been correctly ordered in ascending order.';
                        }
                    }
                }

                echo "<p>Result: $result</p>";
            } else if (isset($_POST['restart_game']) && $_POST['restart_game'] == 'true') {
                $level = 1;
                $lives = 6;
                $gameStatus = '';
                $input = '';
                $expected = '';
            }
        }

        if ($level <= 7) {
            switch ($level) {
                case 1:
                    $letters = generateRandomLetters(6, true);
                    $content = implode(', ', $letters);
                    sort($letters);
                    $expected = implode(', ', $letters);
                    break;
                case 2:
                    $letters = generateRandomLetters(6, true);
                    $content = implode(', ', $letters);
                    rsort($letters);
                    $expected = implode(', ', $letters);
                    break;
                case 3:
                    $numbers = generateRandomNumbers(0, 100, 6);
                    sort($numbers);
                    $content = implode(', ', $numbers);
                    $expected = implode(', ', $numbers);
                    break;
                case 4:
                    $numbers = generateRandomNumbers(0, 100, 6);
                    rsort($numbers);
                    $content = implode(', ', $numbers);
                    $expected = implode(', ', $numbers);
                    break;
                case 5:
                    $letters = generateRandomLetters(6, true);
                    $content = implode(', ', $letters);
                    sort($letters);
                    $expected = $letters[0] . ', ' . $letters[5];
                    break;
                case 6:
                    $numbers = generateRandomNumbers(0, 100, 6);
                    $content = implode(', ', $numbers);
                    sort($numbers);
                    $expected = $numbers[0] . ', ' . $numbers[5];
                    break;
                case 7:
                    // Level 7 content can be added here if needed
                    break;
                default:
                    $content = 'Invalid level.';
                    break;
            }

            if ($level < 7) {
                echo "<p>Content for Level $level:</p>";
            }

            echo "<p>$content</p>";
            echo "<p>Lives Remaining: $lives</p>";
            echo "<p>Answer: $expected</p>";

            if ($gameStatus != 'You won!' && $gameStatus != 'Game Over') { ?>
                <form method='post' action='<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>'>
                    <input type='hidden' name='expected' value='<?php echo $expected; ?>'>
                    <label for='input'>Enter the correct sequence:</label>
                    <input type='text' id='input' name='input' value=''>
                    <input type='hidden' name='level' value='<?php echo $level; ?>'>
                    <input type='hidden' name='lives' value='<?php echo $lives; ?>'>
                    <input type="submit" value="Submit">
                    <input type="button" value="Cancel" onclick="location.href='<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>';">
                </form>
            <?php } else {
                echo "<p>$gameStatus</p>";
                echo '<form method="post" action="' . htmlspecialchars($_SERVER["PHP_SELF"]) . '">';
                echo '<input type="hidden" name="restart_game" value="true">';
                echo '<input type="submit" value="Play Again">';
                echo '</form>';
            }
        } else {
            echo "<p>Invalid level.</p>";
        }
        ?>
    </div>
</body>
</html>
