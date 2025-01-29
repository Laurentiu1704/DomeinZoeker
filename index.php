<?php
session_start();
require_once 'includes/api-functions.php';
require_once 'includes/cart-functions.php';
?>

<!DOCTYPE html>
<html lang="nl">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Domein Zoeker</title>
    <link rel="stylesheet" href="assets/style.css">
</head>
<body>

<header>
    <h1>Domein Zoeker</h1>
</header>

<!-- Zoekformulier -->
<form method="post">
    <label for="domein">Domeinnaam:</label>
    <input type="text" name="domein" id="domein" required>
    <button type="submit">Zoek</button>
</form>

<?php
// Zorg ervoor dat $domeinenData altijd een waarde krijgt
$domeinenData = [];

if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['domein'])) {
    $domein = $_POST['domein'];
    $extensies = ['com', 'nl', 'org', 'net', 'eu', 'info', 'co', 'io', 'us', 'be'];

    // Maak de domeinenData aan
    foreach ($extensies as $extensie) {
        $domeinenData[] = ['name' => $domein, 'extension' => $extensie];
    }

    // Zoek de domeinen
    $resultaten = zoekDomeinen($domeinenData);

    if (isset($resultaten['error'])) {
        echo "<p style='color: red;'>Fout bij ophalen van domeinen: " . htmlspecialchars($resultaten['error']) . "</p>";
    } else {
        echo "<h2>Zoekresultaten:</h2>";
        foreach ($resultaten as $domein) {
            $status = $domein['status'] == 'free' ? 'Beschikbaar' : 'Niet beschikbaar';
            $prijs = isset($domein['price']) && is_numeric($domein['price']) ? (float) $domein['price'] : 0.00;

            echo "<p>" . htmlspecialchars($domein['domain']) . " - " . $status . " (€" . number_format($prijs, 2) . ")</p>";

            // Alleen toevoegen aan winkelmand als het domein beschikbaar is
            if ($domein['status'] == 'free') {
                echo "
                <form method='post'>
                    <input type='hidden' name='domain' value='{$domein['domain']}'>
                    <input type='hidden' name='price' value='{$prijs}'>
                    <button type='submit' name='add_to_cart'>Voeg toe aan winkelmand</button>
                </form>";
            }
        }
    }
    echo "<pre>";
    print_r($resultaten);
    echo "</pre>";

}

?>


</body>
</html>
