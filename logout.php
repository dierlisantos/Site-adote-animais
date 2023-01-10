<?php

session_start(); //continuar sessao

session_destroy();

//redirecionar
header("location: index.php");


?>