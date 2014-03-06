<?php

return array(
    'article_etat' => array(
        '1' => 'Brouillon',
        '20' => 'Publié',
        '29' => 'Spécial',
        '98' => 'Supprimé',
        '99' => 'Archive',
    ),
    'user_droits' => array(
        '0' => 'Visiteur',
        '1' => 'Membre',
        '10' => 'Editeur',
        '24' => 'Admin',
    ),
    'motif_contact' => array(
        '1' => 'Commande',
        '2' => 'Bug sur le site',
        '3' => 'Réclamation',
        '4' => 'Félicitations',
        '5' => 'Orthographe',
        '99' => 'Autre'
    ),
    'type_meta' => array(
        '1' => 'Tags',
        '2' => 'Catégories',
        '3' => array(// Liaison article(id1)-asset(id2)
            'db' => 'article_l_asset',
            'nom' => 'Image',
            'show' => false,
            ),
        '4' => array(// Application d'une police spéciale à un titre d'article
            'db' => 'article_titre_font',
            'nom' => 'Police',
        )
    ),
    'asset_etat' => array(
        '1' => 'Récemment downloadé',
        '2' => 'Redimensionné et miniature terminée',
    ),
    'extensions_autorisees' => array(
        '1' => 'jpg',
        '2' => 'jpeg',
        '3' => 'gif',
        '4' => 'png',
    ),
    'date' => array(
        '01'=> 'janvier',
        '02'=>'février',
        '03'=>'mars',
        '04'=>'avril',
        '05'=>'mai',
        '06'=>'juin',
        '07'=>'juillet',
        '08'=>'août',
        '09'=>'septembre',
        '10'=>'octobre',
        '11'=>'novembre',
        '12'=>'décembre',
    ),
);
