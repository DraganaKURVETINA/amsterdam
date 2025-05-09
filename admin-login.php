<?php
// Definišemo lozinku za pristup admin panelu
$adminPassword = "tajna123";

// Proveravamo da li je forma poslata
if ($_SERVER["REQUEST_METHOD"] === "POST") {
    $password = $_POST["password"] ?? ''; // Proveravamo da li je lozinka poslata

    if ($password === $adminPassword) {
        // Ako je lozinka ta?na, preusmeravamo korisnika na dashboard.php
        header("Location: dashboard.php");
        exit();
    } else {
        // Ako je lozinka pogrešna, preusmeravamo korisnika na error.html
        header("Location: ../pages/error.html");
        exit();
    }
} else {
    // Ako je stranica pristupljena bez POST zahteva, vra?amo korisnika na admin.html
    header("Location: ../pages/admin.html");
    exit();
}
?>