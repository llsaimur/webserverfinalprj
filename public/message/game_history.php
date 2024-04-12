<?php
session_start();

// Database connection parameters
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "kidsGames";

// Check if the user is logged in
if (!isset($_SESSION['username'])) {
    // Redirect the user to the login page if not logged in
    header("Location: ../form/login.php");
    exit;
}

// Fetch game history data from the database
try {
    $conn = new PDO("mysql:host=$servername;dbname=$dbname", $username, $password);
    // Set the PDO error mode to exception
    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    // Prepare the SQL statement to fetch game history
    $stmt = $conn->prepare("SELECT scoreTime, id, fName, lName, result, livesUsed FROM history");
    // Execute the statement
    $stmt->execute();
    // Fetch all rows as associative array
    $gameHistory = $stmt->fetchAll(PDO::FETCH_ASSOC);
} catch(PDOException $e) {
    // Handle database connection error
    echo "Error: " . $e->getMessage();
}

// Close the database connection
$conn = null;
?>

<!DOCTYPE html>
<html lang="en">
<head>
<link rel="stylesheet" href="https://unpkg.com/mvp.css"> 
<link rel="preconnect" href="https://fonts.googleapis.com">
<link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
<link href="https://fonts.googleapis.com/css2?family=Caveat+Brush&display=swap" rel="stylesheet"> 
<style>
          
        body {
        background-image: url('https://static.planetminecraft.com/files/image/minecraft/texture-pack/2022/449/16301222-pack-icon_l.jpg');
        background-repeat: repeat;
        background-attachment: fixed; 
        background-size: 30%;
        font-family: 'Caveat Brush',cursive;
        background-color: #644a34;
        }

        div {
        background-image : url('https://lh3.googleusercontent.com/Hfq6fNIx7sicG2jNinMyks4rriaX0sZXU4OiWZ1EwP-5p1wSNuFQAZp6ETI2uClq9KWyeFuN2koxm4vZcykNPA');
        background-repeat: repeat;
        background-attachment: fixed; 
        background-size: 10%;
        }

        .caveat-brush-regular {
        font-family: "Caveat Brush", cursive;
        font-weight: 400;
        font-style: normal;
        }

        .center {
        margin: auto;
        margin-top: 100px;
        width: 60%;
        border: 3px solid #644a34;
        padding: 10px;
        text-align: center;
        }

        .thead {
            background-color : #492320;
        }


    </style>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>Game History</title>
</head>
<body>
<div class="center">
<?php if(isset($gameHistory) && !empty($gameHistory)): ?>
    <!-- Display game history as HTML table -->

    <h2>Game History</h2>
    <table>
        <thead class="thead">
            <tr>
                <th>ID</th>
                <th>First Name</th>
                <th>Last Name</th>
                <th>Result</th>
                <th>Lives Used</th>
                <th>Date and Time</th>
            </tr>
        </thead>
        <tbody>
            <?php foreach($gameHistory as $game): ?>
            <tr>
                <td><?php echo $game['id']; ?></td>
                <td><?php echo $game['fName']; ?></td>
                <td><?php echo $game['lName']; ?></td>
                <td><?php echo ucfirst($game['result']); ?></td>
                <td><?php echo $game['livesUsed']; ?></td>
                <td><?php echo $game['scoreTime']; ?></td>
            </tr>
            <?php endforeach; ?>
        </tbody>
    </table>
<?php else: ?>
    <p>No game history available.</p>
<?php endif; ?>

<?php
// Check if the 'from' parameter is set in the URL
if (isset($_GET['from'])) {
    // Store the value of the 'from' parameter in a variable
    $fromPage = $_GET['from'];
} else {
    // Default value if 'from' parameter is not set
    $fromPage = 'unknown';
}
?>

<p><a href="<?php echo htmlspecialchars('../levels/' . $fromPage . '.php'); ?>">Go Back</a></p>


</div>
</body>
</html>
