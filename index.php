<?php

require("load_func.php");

$record_list_filtered = [];

try {

    load_func([
        'https://php.letjson.com/let_json.php',
        'https://php.defjson.com/def_json.php',
        'https://php.apisql.com/api_sql.php',
        'https://php.each_func.com/each_func.php',
        'Record.php'
    ], function () {

        $nameserver_list = let_json("nameserver_list.json");
        $data_filtered = each_func((array)$nameserver_list->nameserver_list, function ($item) {


            $data_filtered2 = each_func($item, function ($record) {
//                var_dump($record);
                if (empty($record)) return null;

                if ($record->type !== 'NS') return null;


                return $record->target;
//                return [
//                    [$record->host => $record->target]
//                    'domain' => $record->host,
//                    'class' => $obj->class,
//                    'target' => $obj->target
//                    'nameserver' => $record->target
//                ];
            });
//            var_dump("data_filtered2",$data_filtered2);

            if (empty($data_filtered2)) return null;

            return $data_filtered2;

        });

//        var_dump($data_filtered);
//die;
        // encode data to json
        echo def_json('index.json', $data_filtered);

    });

} catch (Exception $e) {
    // Set HTTP response status code to: 500 - Internal Server Error
    http_response_code(500);
}