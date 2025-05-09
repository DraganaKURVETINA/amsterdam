<?php
// Konekcija sa bazom podataka
$host = 'localhost';
$user = 'root'; // Vaše korisničko ime za MySQL
$password = ''; // Vaša lozinka za MySQL
$dbname = 'amsterdam'; // Naziv baze podataka

// Kreiranje konekcije
$conn = new mysqli($host, $user, $password, $dbname);

// Provera da li je konekcija uspela
if ($conn->connect_error) {
    die("Konekcija nije uspela: " . $conn->connect_error);
}

// Provera da li su svi podaci poslati
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $ime = $conn->real_escape_string($_POST['ime']);
    $email = $conn->real_escape_string($_POST['email']);
    $poruka = $conn->real_escape_string($_POST['poruka']);

    // SQL upit za unos podataka u tabelu
    $sql = "INSERT INTO kontakti (ime, email, poruka) VALUES ('$ime', '$email', '$poruka')";

    if ($conn->query($sql) === TRUE) {
        echo "Vaša poruka je uspešno poslata!";
    } else {
        echo "Greška: " . $sql . "<br>" . $conn->error;
    }
}

// Zatvaranje konekcije
$conn->close();
?>