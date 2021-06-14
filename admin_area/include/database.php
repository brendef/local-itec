<?php

    // // Get Heroku ClearDB connection information
    // $cleardb_url = parse_url(getenv("CLEARDB_DATABASE_URL"));
    // $cleardb_server = $cleardb_url["heroku_170eef10b494f8d"];
    // $cleardb_username = $cleardb_url["bf8bbd806bdb73"];
    // $cleardb_password = $cleardb_url["bfb1ccb3"];
    // $cleardb_db = substr($cleardb_url["us-cdbr-east-04.cleardb.com"],1);
    // $active_group = 'default';
    // $query_builder = TRUE;
    // // Connect to DB
    // $con = mysqli_connect($cleardb_server, $cleardb_username, $cleardb_password, $cleardb_db);
    // $con = mysqli_connect("us-cdbr-east-04.cleardb.com", "bf8bbd806bdb73", "bfb1ccb3");
    // local host connect
    $con = mysqli_connect("localhost", "root", "", "online_store");

    // if (mysqli_connect_errno()) {
    //     echo "Failed to connect to database " . mysqli_connect_errno();
    // }
?>