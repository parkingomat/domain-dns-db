<?php

require("load_func.php");

$record_list_filtered = [];
header('Content-Type: application/json');

try {

    load_func([
        'https://php.letjson.com/let_json.php',
        'https://php.defjson.com/def_json.php',
        'https://php.apisql.com/api_sql.php',
        'https://php.each_func.com/each_func.php',
        'Record.php'
    ], function () {

        $meta = let_json("meta.json");


        $nameserver_list = let_json($meta->in->file);
        $data_filtered = each_func((array)$nameserver_list->nameserver_list, function ($item) {

            $records_filtered = each_func($item, function ($record) {
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
//            var_dump("records_filtered",$records_filtered);

            if (empty($records_filtered)) return null;

            return $records_filtered;

        });

//        var_dump($data_filtered);
//die;
        // encode data to json
        echo def_json($meta->out->file, $data_filtered);

    });

} catch (Exception $e) {
    // Set HTTP response status code to: 500 - Internal Server Error
    http_response_code(500);
}