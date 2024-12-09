<?php
// CHANGEME the db name to the actual name of the db (ctf.db is a placeholder)
$db = new SQLite3('ctf.db');

// form submission stuff
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $username = $_POST['username'] ?? '';
    $password = $_POST['password'] ?? ''; 

    // deliberatley vulnerable query
    $query = "SELECT * FROM Users WHERE username = '$username'";

    $result = $db->query($query);

    if ($result && $row = $result->fetchArray(SQLITE3_ASSOC)) {
        echo "<table>";
        echo "<thead><tr><th>Username</th><th>Age</th><th>Criminal History</th></tr></thead>";
        echo "<tbody>";
        do {
            echo "<tr>";
            echo "<td>" . htmlspecialchars($row['username']) . "</td>";
            echo "<td>" . $row['age'] . "</td>";
            echo "<td>" . htmlspecialchars($row['criminal_history']) . "</td>";
            echo "</tr>";
        } while ($row = $result->fetchArray(SQLITE3_ASSOC));
        echo "</tbody>";
        echo "</table>";
    } else {
        echo "<p class='error'>Invalid login.</p>";
    }
}
?>

