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

foreach ($layoutFiles as $layout) {
    include $layout;
}
