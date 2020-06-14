<?php
    $servername = 'localhost';
    $username = 'fromiti';
    $password = 'admin';
    $database = 'course_project_one';
    $conn = new mysqli($servername, $username, $password, $database);
    // Check connection
    if ($conn->connect_error) {
      die("Connection failed: " . $conn->connect_error);
    }else{
        session_start();
    }

