<?php

require("load_func.php");
header('Content-Type: application/json');


load_func([
    'Record.php',
    'https://php.letjson.com/let_json.php',
    'https://php.defjson.com/def_json.php',
    'https://php.apisql.com/api_sql.php',
    'https://php.eachfunc.com/each_func.php'
], function () {

    // load data from sqlite based on json configuration: db.json
    let_json('db.json', function ($config) {

        // fetch all adata
        $data = api_sql($config->db, $config->read);

        $data_filtered = each_func($data, function ($item) {
//            var_dump($item);
//            return [
//                $item['domain'],
//                $item['value']
//            ];
            return [
                'domain' => $item['domain'],
                'nameserver' => $item['value']
            ];
        });

        // encode data to json
        echo def_json('', $data_filtered);
    });
});
