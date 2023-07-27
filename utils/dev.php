<?php

ini_set('display_errors', 1);
error_reporting(E_ALL);

function dd($data) {
    echo "<pre>";
        print_r($data);
    echo "</pre>";
    exit;
}
function ddt($data) {
    echo "<pre>";
        var_dump($data);
    echo "</pre>";
    exit;
}
function debug($data) {
    echo "<pre>";
        print_r($data);
    echo "</pre>";
}
function debug_t($data) {
    echo "<pre>";
        var_dump($data);
    echo "</pre>";
}