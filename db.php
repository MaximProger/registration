<?php

require "libs/rb.php";

R::setup( 'mysql:host=localhost;dbname=registration',
        'root' );

session_start();