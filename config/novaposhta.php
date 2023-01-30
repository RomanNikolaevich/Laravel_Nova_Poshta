<?php

return [
    'url' => "https://api.novaposhta.ua/v2.0/json/",

    /**
     * Settings for connecting to the API of Nova Poshta 2.0 (city)
     */
    'data_city' => [
        "apiKey"       => "",
        "modelName"    => "Address",
        "calledMethod" => "getCities",
    ],

    /**
     * Settings for connecting to the API of Nova Poshta 2.0 (warehouses)
     */
    'data_warehouse' => [
        "apiKey"       => "",
        "modelName"    => "Address",
        "calledMethod" => "getWarehouses",
    ],

    /**
     * Localities that should not be included in the database
     */
    'excluded_cities' => [
        "Абрикосовка",
        "Агайманы",
        "Агрономичное",
        "Адамполь",
    ],

    /**
     * Maximum number of cities/villages added to the database
     */
    'number_of_cities' => 20,
];

