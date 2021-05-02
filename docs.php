<?php
require("load_func.php");

// get info about all included projects
// based on load func

load_func(['https://php.defjson.com/def_json.php'], function () {

    def_json('docs.json', [
        "included" => [
            "git" => [""],
            "lib" => [""],
            "load_func" => [""],
        ],
        "project" => [
            "description" => "get DNS info about domain list from in->file and save to out->file",
            "include" => []
        ],
    ]);
});
