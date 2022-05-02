<?php

// Emplacement du fichier
$file = 'rues_clermont.json';

// Lecture entière du fichier avec la fonction file_get_contents
$content = file_get_contents($file);

// Ouverture du fichier avec fopen
$fd = fopen('rues_clermont.csv', 'w');

// Décodage de la chaîne JSON avec json_decode
$datasets = json_decode($content, true);

// Formatage de plusieurs ligne en CSV et écriture dans le fichier avec fputcsv
fputcsv($fd, [
    'Insee',
    'Code postal',
    'Commune',
    'Nombre habitants',
    'Rue',
    'Ordures',
    'Horaires ordures',
    'Recurrence',
    'Tri',
    'Horaires tri',
    'Recurrence',
]);

// Boucle foreach
foreach ($datasets as $dataset) {

    // Utilisation de la fonction explode permet de scinder une chaîne de caractères en segments
    [$day, $hour] = explode(' : ', $dataset['dechets_recyclables_jours']);

    // Utilisation de la fonction preg_match_all (expression rationnelle globale) 
    // et des expressions régulières (chaînes de caractères, qui décrivent, selon une syntaxe précise, 
    // un ensemble de chaînes de caractères possibles)
    preg_match_all('#(\w+) : (\w+ / \w+)#', $dataset['ordures_menagers_jours'], $matches);
    
    // var_dump($matches)

    fputcsv($fd, [
        // Retourne un segment de chaînes avec substr
        substr(' 63113 ', 1),
        substr(' 63110 ', 1),
        $dataset['nom'],
        substr(' 145041 ', 1),
        $dataset['voie'],
        // Concaténation des éléments d'un tableau dans une chaîne avec implode
        implode(' - ', $matches[1] ?? []),
        implode(' - ', $matches[2] ?? []),
        substr(' Semaine ', 1),
        $day,
        $hour,
        substr(' Semaine ', 1),
    ]);
}