<?php

function voegToeAanWinkelmand($domein, $prijs) {
    // Zorg dat de winkelmand bestaat
    if (!isset($_SESSION['winkelmand'])) {
        $_SESSION['winkelmand'] = [];
    }

    // Controleer of het domein al in de winkelmand zit
    foreach ($_SESSION['winkelmand'] as $item) {
        if ($item['domain'] === $domein) {
            return; // Voorkom dubbele invoer
        }
    }

    // Voeg het domein toe aan de winkelmand
    $_SESSION['winkelmand'][] = [
        'domain' => $domein,
        'price' => (float) $prijs
    ];
}

// Functie om de winkelmand te tonen
function toonWinkelmand() {
    if (!isset($_SESSION['winkelmand']) || empty($_SESSION['winkelmand'])) {
        echo "<p>Winkelmand is leeg.</p>";
        return;
    }

    echo "<h2>Winkelmand</h2><ul>";
    $totaal = 0;

    foreach ($_SESSION['winkelmand'] as $item) {
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

// Functie om een item uit de winkelmand te verwijderen
function verwijderUitWinkelmand($domein) {
    if (isset($_SESSION['winkelmand'])) {
        foreach ($_SESSION['winkelmand'] as $key => $item) {
            if ($item['domain'] === $domein) {
                unset($_SESSION['winkelmand'][$key]);
                $_SESSION['winkelmand'] = array_values($_SESSION['winkelmand']); // Indexen opnieuw ordenen
                break;
            }
        }
    }
}

// Functie om de winkelmand te legen
function leegWinkelmand() {
    unset($_SESSION['winkelmand']);
}
?>
