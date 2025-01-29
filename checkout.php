<?php
session_start();

// Voeg domein toe aan winkelmand
function voegToeAanWinkelmand($domein, $prijs) {
    // Als de winkelmand nog niet bestaat, maak deze dan aan
    if (!isset($_SESSION['cart'])) {
        $_SESSION['cart'] = [];
    }

    // Controleer of het domein al in de winkelmand zit
    foreach ($_SESSION['cart'] as $item) {
        if ($item['domain'] === $domein) {
            return; // Voorkom dubbele invoer
        }
    }

    // Voeg het domein en de prijs toe aan de winkelmand
    $_SESSION['cart'][] = [
        'domain' => $domein,
        'price' => (float) $prijs
    ];
}

// Functie om de winkelmand te tonen (je kan deze gebruiken om de winkelmand te bekijken)
function toonWinkelmand() {
    if (!isset($_SESSION['cart']) || empty($_SESSION['cart'])) {
        echo "<p>Winkelmand is leeg.</p>";
        return;
    }

    echo "<h2>Winkelmand</h2><ul>";
    $totaal = 0;

    foreach ($_SESSION['cart'] as $item) {
        echo "<li>{$item['domain']} - €" . number_format($item['price'], 2) . "</li>";
        $totaal += $item['price'];
    }

    $btw = $totaal * 0.21; // 21% BTW
    $totaalInclBtw = $totaal + $btw;

    echo "</ul>";
    echo "<p>Subtotaal: €" . number_format($totaal, 2) . "</p>";
    echo "<p>BTW (21%): €" . number_format($btw, 2) . "</p>";
    echo "<p><strong>Totaal: €" . number_format($totaalInclBtw, 2) . "</strong></p>";
}
?>
