<?php

    include 'vendor/autoload.php';
    include 'db.php';
    include 'tables.php';

    $absl->update('users', ["name" => "tsst", "age" => 20], "id", 2);
    // echo "<br/>";
    // $absl->create('users', ["name" => "tesssst", "age" => 20]);
    // echo "<br/>";
    // $absl->delete('users', "id", 1);
    // echo "<br/>";
    // $absl->list('users', ["age"]);
    // echo "<br/>";
    // $absl->listSingle('users', ["id", "name", "age"], "id", 1);

    // if(
    //     $absl->authenticate(["table" => "acc", "userColumn" => "username", "tokenColumn" => "password", "session" => ["username"]], "adminn", "admin")
    // ) {
    //     echo "Authenticated";
    // } else {
    //     echo "Not Authenticated";
    // }