<?php
// Konfiguracija baze podataka
$host = '127.0.0.1'; // Host baze podataka
$dbname = 'amsterdam'; // Naziv baze podataka
$username = 'root'; // Korisničko ime baze
$password = ''; // Lozinka baze

try {
    // Kreiranje PDO konekcije
    $pdo = new PDO("mysql:host=$host;dbname=$dbname;charset=utf8mb4", $username, $password);
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch (PDOException $e) {
    die("Konekcija sa bazom nije uspela: " . $e->getMessage());
}

// Provera da li je forma poslata
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $ime = $_POST['ime'] ?? '';
    $opis = $_POST['opis'] ?? '';
    $slika = $_FILES['slika'] ?? null;

    // Validacija unetih podataka
    if ($ime && $opis && $slika && $slika['error'] === UPLOAD_ERR_OK) {
        // Kreiramo folder za čuvanje slika ako ne postoji
        $uploadsDir = '../uploads/';
        if (!is_dir($uploadsDir)) {
            mkdir($uploadsDir, 0777, true);
        }

        // Generišemo jedinstveno ime za sliku
        $slikaIme = uniqid() . '-' . basename($slika['name']);
        $slikaPutanja = $uploadsDir . $slikaIme;

        // Proveravamo i pomeramo uploadovanu sliku u folder
        if (move_uploaded_file($slika['tmp_name'], $slikaPutanja)) {
            // Priprema SQL upita za unos u tabelu `slike`
            $sql = "INSERT INTO slike (ime, putanja, opis) VALUES (:ime, :putanja, :opis)";
            $stmt = $pdo->prepare($sql);

            // Izvršavanje SQL upita sa podacima
            try {
                $stmt->execute([
                    ':ime' => $ime,
                    ':putanja' => $slikaIme, // Čuvamo samo ime fajla, bez apsolutne putanje
                    ':opis' => $opis
                ]);

                // Poruka o uspehu
                echo "<p style='color: green; text-align: center;'>Sadržaj je uspešno dodat u bazu!</p>";
                echo "<a href='../pages/dodaj.html' style='text-decoration: none;'><button>Vrati se nazad</button></a>";
            } catch (PDOException $e) {
                echo "<p style='color: red; text-align: center;'>Greška pri unosu u bazu: " . $e->getMessage() . "</p>";
            }
        } else {
            echo "<p style='color: red; text-align: center;'>Došlo je do greške pri čuvanju slike.</p>";
        }
    } else {
        echo "<p style='color: red; text-align: center;'>Sva polja su obavezna!</p>";
    }
} else {
    // Ako je stranici pristupljeno bez POST metode
    header("Location: ../pages/dodaj.html");
    exit();
}
?>