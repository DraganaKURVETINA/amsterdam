<!DOCTYPE html>
<html lang="sr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Galerija</title>
    <link rel="stylesheet" href="style.css">
    <style>
        /* Stil za galeriju */
        .gallery {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(250px, 1fr));
            gap: 20px;
            margin-top: 20px;
        }
        .gallery img {
            width: 100%;
            height: auto;
            border-radius: 10px;
            box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
        }
        .gallery-item {
            text-align: center;
        }
        .gallery-item figcaption {
            font-style: italic;
            margin-top: 5px;
            color: #555;
        }
    </style>
</head>
<body>
    <nav>
        <ul>
            <li><a href="index.html" class="<?= basename($_SERVER['PHP_SELF']) == 'index.html' ? 'active' : '' ?>">Po?etna</a></li>
            <li><a href="znamenitosti.html" class="<?= basename($_SERVER['PHP_SELF']) == 'znamenitosti.html' ? 'active' : '' ?>">Znamenitosti</a></li>
            <li><a href="kontakt.html" class="<?= basename($_SERVER['PHP_SELF']) == 'kontakt.html' ? 'active' : '' ?>">Kontakt</a></li>
            <li><a href="opcije.html" class="<?= basename($_SERVER['PHP_SELF']) == 'opcije.html' ? 'active' : '' ?>">Opcije</a></li>
            <li><a href="galerija.php" class="<?= basename($_SERVER['PHP_SELF']) == 'galerija.php' ? 'active' : '' ?>">Galerija</a></li>
            <li><a href="dodaj.html" class="<?= basename($_SERVER['PHP_SELF']) == 'dodaj.html' ? 'active' : '' ?>">Dodaj</a></li>
        </ul>
    </nav>
    <header>
        <h1>Galerija</h1>
    </header>
    <main>
        <section>
            <div class="gallery">
                <?php
                // Povezivanje sa bazom podataka
                $conn = new mysqli("localhost", "root", "", "amsterdam");

                // Proveri konekciju
                if ($conn->connect_error) {
                    die("Konekcija nije uspela: " . $conn->connect_error);
                }

                // Dohvatanje podataka iz tabele
                $sql = "SELECT ime, putanja, opis FROM slike";
                $result = $conn->query($sql);

                if ($result->num_rows > 0) {
                    // Prikazivanje slika
                    while ($row = $result->fetch_assoc()) {
                        $ime = htmlspecialchars($row['ime']);
                        $putanja = htmlspecialchars($row['putanja']); // Uzimamo ime fajla iz kolone "putanja"
                        $opis = htmlspecialchars($row['opis']);
                        $punaPutanja = "uploads/" . $putanja; // Generišemo punu putanju do slike

                        echo "
                        <figure class='gallery-item'>
                            <img src='$punaPutanja' alt='$opis'>
                            <figcaption><strong>$ime</strong>: $opis</figcaption>
                        </figure>
                        ";
                    }
                } else {
                    echo "<p>Nema slika u galeriji.</p>";
                }

                // Zatvaranje konekcije
                $conn->close();
                ?>
            </div>
        </section>
    </main>
    <footer>
        <p>&copy; 2025 Amsterdam Sajt</p>
    </footer>
</body>
</html>