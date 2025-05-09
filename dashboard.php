<?php
// Povezivanje sa bazom podataka
$host = "localhost"; // Host baze podataka
$username = "root"; // Korisni?ko ime baze podataka
$password = ""; // Lozinka baze podataka
$database = "amsterdam"; // Naziv baze podataka

// Kreiranje konekcije
$conn = new mysqli($host, $username, $password, $database);

// Provera konekcije
if ($conn->connect_error) {
    die("Konekcija sa bazom nije uspela: " . $conn->connect_error);
}

// SQL upit za dobijanje podataka iz tabele 'kontakti'
$sql = "SELECT * FROM kontakti";
$result = $conn->query($sql);

// Provera da li tabela postoji
if (!$result) {
    die("Greška: " . $conn->error . ". Proverite da li tabela 'kontakti' postoji.");
}
?>
<!DOCTYPE html>
<html lang="sr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard</title>
    <link rel="stylesheet" href="../pages/style.css">
</head>
<body>
    <nav>
        <ul>
            <li><a href="../pages/index.html">Po?etna</a></li>
            <li><a href="../pages/znamenitosti.html">Znamenitosti</a></li>
            <li><a href="../pages/kontakt.html">Kontakt</a></li>
            <li><a href="../pages/opcije.html">Opcije</a></li>
            <li><a href="../pages/vise-opcija.html">Više Opcija</a></li>
            <li><a href="../pages/dodaj.html">Dodaj</a></li>
            <li><a href="../pages/admin.html">Admin</a></li>
            <li><a href="dashboard.php" class="active">Dashboard</a></li>
        </ul>
    </nav>
    <header>
        <h1>Podaci iz baze</h1>
    </header>
    <main>
        <table border="1" style="width: 100%; text-align: left;">
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Ime</th>
                    <th>Email</th>
                    <th>Poruka</th>
                </tr>
            </thead>
            <tbody>
                <?php
                if ($result->num_rows > 0) {
                    // Prikazivanje podataka iz tabele
                    while ($row = $result->fetch_assoc()) {
                        echo "<tr>";
                        echo "<td>" . $row['id'] . "</td>";
                        echo "<td>" . $row['ime'] . "</td>";
                        echo "<td>" . $row['email'] . "</td>";
                        echo "<td>" . $row['poruka'] . "</td>";
                        echo "</tr>";
                    }
                } else {
                    echo "<tr><td colspan='4'>Nema podataka u tabeli.</td></tr>";
                }
                ?>
            </tbody>
        </table>
    </main>
    <footer>
        <p>&copy; 2025 Amsterdam Sajt</p>
    </footer>
</body>
</html>
<?php
// Zatvaranje konekcije
$conn->close();
?>