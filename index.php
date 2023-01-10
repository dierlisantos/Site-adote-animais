<?php

session_start(); // start ou resume session --- começar ou continuar a sessão!

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="favicon.ico" rel="icon" type="image/x-icon" />
    <img id="logo" src="logo.png" style>
    <title>Adote animais</title>

    <style>
        body {
            background-color: #FFFAFA;
            color: #62442F;
            margin: 50x 100px 50px 100px;
            font-family: 'Montserrat', sans-serif;

        }

        header {
            height: 25vh;
            background-color: #F8F2F2;
            margin: 0;

        }

        #logo {
            width: 230px;
            position: absolute;
            left: 50px;
            margin-top: -20px;
        }


        p {
            width: 70vw;
            margin: 50px auto;
            line-height: 1.2em;

        }

        h1 {
            text-align: center;
            color: #FF5C05;
        }

        nav {
            display: flex;
            justify-content: space-evenly;
            align-items: center;
            /* border:1px solid blue; */
            width: 55vw;
            margin-left: 25vw;
            height: 100%;
            /* se necessario min height */

        }

        footer {
            height: 10vh;
            background-color: #FF5C05;
            clear: both;
            padding: 20px;

        }

        footer a,
        footer a:visited,
        footer a:active {
            color: white;
            text-decoration: none;
        }

        footer a:hover {
            color: #ff3d00;
        }

        footer .inner footer .inner {
            display: flex;
            justify-content: space-around;
            margin: 0 25px;
        }


        footer .left {
            width: 80%;
            color: white;
            font-size: small;
            margin-bottom: auto;

        }


        footer .social-links a {

            margin-top: 0;
            margin-right: 15px;
            margin-left: 0;
            position: relative;
            display: inline-block;
            vertical-align: top;
            font-size: 22px;
            color: white;
            font-weight: 700;
            text-decoration: none;
            transition: all 500ms;

        }


        footer .social-links a:hover {
            color: #ff3d00;
            transition: all 500ms;
        }

        a {
            color: #FF5C05;
            font-size: larger;
            text-decoration: none;
        }

        nav a:hover {
            text-decoration: underline;
        }
    </style>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css" />

</head>



<body>

    <header>
        <nav>


            <?php if (!empty($_SESSION["userid"]) && $_SESSION["admin"] == 1) { //login efetuado!
            ?>
                <a href="index.php?opcao=animais">Animais</a>
                <!--<a href="index.php?opcao=inserir_animal">Inserir animal</a>-->
                <a href="index.php?opcao=inserir_animal2">Inserir animal</a>
                <a href="index.php?opcao=inserir_categoria">Inserir categoria</a>
                <a href="index.php?opcao=eliminar_categoria">Eliminar categoria</a>
                <a href="index.php?opcao=logout">Logout</a>

            <?php
            } else { //sm login
            ?>
                <a href="index.php?opcao=animais">Animais</a>
                <a href="index.php?opcao=pesquisa">Pesquisa</a>
                <!--<a href="index.php?opcao=categorias">Categorias</a> -->
                <a href="index.php?opcao=animais#comoadotar">Como adotar</a>
                <a href="index.php?opcao=animais#comoajudar">Como ajudar</a>
                <a href="index.php?opcao=registo">Registo</a>
                <a href="index.php?opcao=login">Login</a>
            <?php
            }

            ?>

        </nav>

    </header>
    <hr>
    <?php
    if (!empty($_SESSION["username"]))
        echo "<h3> Bem vindo (a) {$_SESSION["username"]}</h3>";

    ?>
    <main>



        <?php

        if (!empty($_GET["opcao"]) && strtolower($_GET["opcao"]) != "index")
            include($_GET["opcao"] . ".php");
        else
            include("animais.php");
        ?>
    </main>



    <footer class="clearfix">
        <div class="inner">
            <div class="left">
    
                © 2022
                Dierli Santos - Projeto para o curso de Desenvolvimento Web
                <br><br><br>


                <div class="social-links">

                    <a target="_blank" rel="nofollow" href="#">
                           <i aria-hidden="true" class="fab fa-linkedin"></i>
                    </a>
                    <a target="_blank" rel="nofollow" href="#">
                        <i aria-hidden="true" class="fab fa-github"></i>
                </div>

            </div>

    </footer>



</html>