<?php

require("load_func.php");

try {

    load_func(['https://php.letjson.com/let_json.php', 'https://php.defjson.com/def_json.php', 'https://php.apisql.com/api_sql.php', 'Record.php'], function () {

        let_json('db.json', function ($config) {
            // load data from sqlite based on json configuration: config.json
            api_sql($config->db, $config->read, function ($fetch) {
                // encode data to json
                def_json('', $fetch, function ($json) {
                    // show header with json data
                    header('Content-Type: application/json');
                    echo $json;
                });
            });
        });
    });

} catch (Exception $e) {
    // Set HTTP response status code to: 500 - Internal Server Error
    http_response_code(500);
}