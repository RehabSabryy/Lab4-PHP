<?php

    // open connection
    $dbhost='localhost';
    $dbuser='root';
    $dbpass ='';
    $dbname='phplab';
    $link=mysqli_connect($dbhost , $dbuser , $dbpass , $dbname);

    // Check connection
if (!$link) {
    die("Connection failed: " . mysqli_connect_error());
  }
  echo "Connected successfully";

  mysqli_select_db( $link,$dbname );

  // check if table exists
  $result = mysqli_query($link, 'SHOW TABLES LIKE "form"');
      // if table does not exist
  if (mysqli_num_rows($result) == 0) {
    $mysql= 'CREATE TABLE form (
      id INT  NOT NULL AUTO_INCREMENT ,
      username varchar(15) not null ,
      email varchar(20) not null ,
      group_no INT not null ,
      class_details varchar(255) not null ,
      gender varchar(10) NOT NULL,
      course varchar(20) not null,
      PRIMARY KEY (id))';

    $tableConn = mysqli_query($link , $mysql);

    if(! $tableConn ) {
        die('Could not create table: ' . mysqli_error($link));
     }

     echo "<br>Database Table  created successfully\n";
  }


?>