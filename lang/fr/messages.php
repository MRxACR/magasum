<?php


return [
    "sortie" => [
        "creation" => [
            "bs" => "un nouveau bon de sortie a été ajouté.",
            "pc" => "une nouvelle prise en charge a été ajouté.",
            "rf" => "une nouvelle fiche de réforme a été ajouté.",
        ],
        "mise" => [
            "bs" => "le bon de sortie a été mis à jour.",
            "pc" => "la prise en charge a été mis à jour.",
            "rf" => "la fiche de réforme a été mis à jour.",
        ],
        "supprimer" => [
            "bs" => "le bon de sortie a été supprimé.",
            "pc" => "la prise en charge a été supprimé.",
            "rf" => "la fiche de réforme a été supprimé.",
            "global" => "fiche supprimé avec succès.",
        ],
    ],

    "reception" => [
        "creation" => "une nouvelle réception à été ajouté.",
        "mise" => "La fiche de réception à été mis à jour.",
        "supprimer" => "La fiche de réception à été supprimer.",
        "erreur" => "La fiche de réception ne peux pas étre supprimer ou modifié, car elle est utilisé dans une ou plusieurs sorties.",
    ],

    "fournisseur" => [
        "creation" => "un nouveau fournisseur à été ajouté.",
        "mise" => "les informations du fournisseur ont été mis à jour.",
        "supprimer" => [
            "erreur" => "Le fournisseur ne peut pas étre supprimer car il est utilisé dans un bon de commande.",
            "reussi" => "Le fournisseur a été supprimer.",
        ],
    ],

    "commande" => [
        "creation" => "une nouvelle commande à été ajouté.",
        "mise" => "La commande à été mis à jour.",
        "supprimer" => "La commande à été supprimer.",
        "erreur" => "La commande ne peux pas étre supprimer ou modifié, car elle est utilisé dans une réception",
    ],

    "signale" => [
        "envoie" => "le message a été enregistré dans la base de données. ",
    ],

    "inventaire" => [
        "creation" => "Une nouvelle fiche d'inventaire à été ajouté.",
        "supprimer" => "Une nouvelle fiche d'inventaire à été supprimer.",
    ],

    "profile" => [
        "mise" => "Le profile est à jour.",
    ] 

];