<?php

require("load_func.php");

$record_list_filtered = [];

try {

    load_func(['https://php.letjson.com/let_json.php', 'https://php.defjson.com/def_json.php', 'https://php.apisql.com/api_sql.php', 'Record.php'], function () {


        $records = new Record([]);

//        $record_name = '';
        $record_name = 'IN';


        $nameserver_list = let_json("nameserver_list.json");
//        $dns_list = $nameserver_list->nameserver_list;

        foreach ($nameserver_list->nameserver_list as $record_list) {
//            var_dump($record_list);

            if (!empty($record_list)) {
                foreach ($record_list as $record) {
                    if (!empty($record_name) && is_object($record)) {
                        if ($record_name === $record->class) {
//                        var_dump($record);
                            $records->add($record);
                        }
                    } else {
//                    var_dump($records);
                        $records->add($record);
                    }
                }
            }
        }
//        require("read.php");
//
        header('Content-Type: application/json');
        def_json('', $records->getList(), function ($data) {
            echo $data;
//            exit();
        });

    });

} catch (Exception $e) {
    // Set HTTP response status code to: 500 - Internal Server Error
    http_response_code(500);
}