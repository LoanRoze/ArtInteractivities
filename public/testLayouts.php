<?php
$layoutFiles = [
    'layouts/Header.html',
    'layouts/DetailsOeuvre.html',
    'layouts/DetailsArtiste.html',
    'layouts/ListeOeuvres.html',
    'layouts/Informations.html',
    'layouts/AvisClients.html',
    'layouts/Faq.html',
    'layouts/Contact.html',
    'layouts/Footer.html',
];
?>
<!DOCTYPE html>
<html lang="fr">

<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Les Interaktivities - Oeuvre</title>
    <link rel="stylesheet" href="assets/css/style.css" />
</head>

<body>
    <?php
    foreach ($layoutFiles as $layout) {
        include $layout;
    }
    ?>
</body>

</html>