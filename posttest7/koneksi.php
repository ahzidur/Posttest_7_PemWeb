<?php

    $conn = mysqli_connect('localhost', 'root', '', 'zidan_db');

    if(!$conn){
        die("Koneksi Gagal: ".mysqli_connect_error());
    }