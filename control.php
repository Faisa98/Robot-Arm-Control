<?php
// Connect to MySQL
$conn = new mysqli("localhost", "root", "", "name");

session_start();

// save new pose
if (isset($_POST['SavePose'])) {
    
    $motorValues = [];
    for ($i = 1; $i <= 6; $i++) {
        $motorValues[$i] = intval($_POST["motor$i"]);
    }
    $conn->query("INSERT INTO pose (`Motor 1`, `Motor 2`, `Motor 3`, `Motor 4`, `Motor 5`, `Motor 6`) VALUES ({$motorValues[1]}, {$motorValues[2]}, {$motorValues[3]}, {$motorValues[4]}, {$motorValues[5]}, {$motorValues[6]})");

    header("Location: control.php");
    exit;
}

// Run pose
if (isset($_POST['Run'])) {

    $conn->query("DELETE FROM `run`");

    $motorValues = [];
    for ($i = 1; $i <= 6; $i++) {
        $motorValues[$i] = intval($_POST["motor$i"]);
    }
    $conn->query("INSERT INTO `run` (`Motor 1`, `Motor 2`, `Motor 3`, `Motor 4`, `Motor 5`, `Motor 6`) VALUES ({$motorValues[1]}, {$motorValues[2]}, {$motorValues[3]}, {$motorValues[4]}, {$motorValues[5]}, {$motorValues[6]})");

}

// Load pose
if (isset($_POST['Load'])) {
    $id = intval($_POST['Load']);
    $res = $conn->query("SELECT * FROM pose WHERE ID = $id");
    $row = $res->fetch_assoc();

    // Store loaded values in session to use in HTML
    
    $_SESSION['loaded_pose'] = [];
    for ($i = 1; $i <= 6; $i++) {
        $_SESSION['loaded_pose'][$i] = $row['Motor ' . $i];
    }
    header("Location: control.php");
    exit;
}

// Remove pose
if (isset($_POST['Remove'])) {
    $id = intval($_POST['Remove']);
    $conn->query("DELETE FROM pose WHERE ID = $id");
    header("Location: control.php");
    exit;
}

// Fetch rows
$result = $conn->query("SELECT * FROM pose");
?>

<!DOCTYPE html>
<html>
<head>
    <title>motor control</title>
    <?php
    // Add this right after session values are set
    if (isset($_SESSION['loaded_pose'])): ?>
    <script>
        window.onload = function() {
            <?php foreach($_SESSION['loaded_pose'] as $motor => $value): ?>
            document.getElementById('motor<?= $motor ?>').value = <?= $value ?>;
            document.getElementById('motor<?= $motor ?>Out').value = <?= $value ?>;
            <?php endforeach; ?>
            <?php unset($_SESSION['loaded_pose']); // Clear the session after use ?>
        }
    </script>
    <?php endif; ?>
</head>
<body>
    <h2>Robot Arm Control Panel</h2>
    <div class="slidecontainer">
        <form method="POST" style="display:inline;" >
            <label for="motor1">motor 1:</label>
            <input type="range" id="motor1" name="motor1" min="0" max="180" value="90" oninput= "motor1Out.value = motor1.value" >
            <output id="motor1Out">90</output>
            <label for="motor2"><br>motor 2:</label>
            <input type="range" id="motor2" name="motor2" min="0" max="180" value="90" oninput= "motor2Out.value = motor2.value" >
            <output id="motor2Out">90</output>
            <label for="motor3"><br>motor 3:</label>
            <input type="range" id="motor3" name="motor3" min="0" max="180" value="90" oninput= "motor3Out.value = motor3.value" >
            <output id="motor3Out">90</output>
            <label for="motor4"><br>motor 4:</label>
            <input type="range" id="motor4" name="motor4" min="0" max="180" value="90" oninput= "motor4Out.value = motor4.value" >
            <output id="motor4Out">90</output>
            <label for="motor5"><br>motor 5:</label>
            <input type="range" id="motor5" name="motor5" min="0" max="180" value="90" oninput= "motor5Out.value = motor5.value" >
            <output id="motor5Out">90</output>
            <label for="motor6"><br>motor 6:</label>
            <input type="range" id="motor6" name="motor6" min="0" max="180" value="90" oninput= "motor6Out.value = motor6.value" >
            <output id="motor6Out">90</output>
        
            <br>
            <button type="button" name="Reset" onclick="resetSliders()">Reset</button>   
            <button name="SavePose">Save pose</button>
            <button name="Run">Run</button>
        </form>
    </div>
    <table border="1" cellpadding="8">
        <tr>
            <th>ID</th><th>motor 1</th><th>motor 2</th><th>motor 3</th><th>motor 4</th><th>motor 5</th><th>motor 6</th><th>Action</th>
        </tr>
        <?php while($row = $result->fetch_assoc()): ?>
        <tr>
            <td><?= $row['ID'] ?></td>
            <td><?= $row['Motor 1'] ?></td>
            <td><?= $row['Motor 2'] ?></td>
            <td><?= $row['Motor 3'] ?></td>
            <td><?= $row['Motor 4'] ?></td>
            <td><?= $row['Motor 5'] ?></td>
            <td><?= $row['Motor 6'] ?></td>
            <td>
                <form method="POST" style="display:inline;">
                    <button name="Load" value="<?= $row['ID'] ?>">Load</button>
                </form>
                <form method="POST" style="display:inline;">
                    <button name="Remove" value="<?= $row['ID'] ?>">Remove</button>
                </form>
            </td>
        </tr>
        
        <?php endwhile; ?>
    </table>
    <script>
        function resetSliders() {
            for (let i = 1; i <= 6; i++) {
                document.getElementById(`motor${i}`).value = 90;
                document.getElementById(`motor${i}Out`).value = 90;
            }
        }
    </script>
</body>
</html>
