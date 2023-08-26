<?php

    include 'vendor/autoload.php';
    include 'db.php';
    include 'tables.php';

    function dd($var) {
        echo "<pre>";
        var_dump($var);
        echo "</pre>";
    }

    // $absl->update('users', ["name" => "tsst", "age" => 20], "id", 2);
    // echo "<br/>";
    // $absl->create('users', ["name" => "tesssst", "age" => 20]);
    // echo "<br/>";
    // $absl->delete('users', "id", 1);
    // echo "<br/>";
    // dd($absl->list('acc', []));
    // echo "<br/>";
    // dd($absl->listSingle('acc', ["username", "password"], "id", 2));

    // if(
    //     $absl->authenticate(["table" => "acc", "userColumn" => "username", "tokenColumn" => "password", "session" => ["username"]], "adminn", "admin")
    // ) {
    //     echo "Authenticated";
    // } else {
    //     echo "Not Authenticated";
    // }

    // if ($absl->checkRecord("users", "id", 111)) {
    //     echo "Record Exists";
    // } else {
    //     echo "Record Does Not Exist";
    // }

    // $arr = [
    //     "test1" => "<h1>Test1</h1>",
    //     "test2" => "<h1>Test2</h1>",
    // ];

    // $var = "<h1>Test</h1>";

    // echo $var;

    // $var = $absl->sanitizeVariable($var);

    // echo $var;

    // print_r($arr);

    // $arr = $absl->sanitizeArray($arr);

    // print_r($arr);




