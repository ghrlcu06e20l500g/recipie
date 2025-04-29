<?php

$connection = new mysqli("localhost", 'recipie', '', 'my_recipie');
if(!$connection) die('Connessione fallita: '.($connection -> connect_error));
