<html>

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="favicon.ico" rel="icon" type="image/x-icon" />
    <img id="logo" src="logo.png" style>
    <title>Adote animais</title>
    <style>
        .lista {
            border: 1px;
            height: 30vh;
            width: 60vw;
            padding: 50px;
            display: flex;
            justify-content: space-evenly;
            margin: auto;
            flex-wrap: wrap;
            row-gap: 10px;
        }

        .lista img {
            height: 100%;
            float: none;
            margin-top: 0px;
            cursor: pointer;
            border-radius: 10px;
        }

        .item {
            border: 1px solid #FF5C05;
            width: 68vw;
            min-height: 80vh;
            padding: 40px;
            background-color: #F8F2F2;
            padding-left: 50px;
            border-radius: 10px;
            justify-content: space-evenly;
        }

        .item img {
            height: 25vh;
            float: right;
            margin-top: 20px;
            border-radius: 10px;
        }

        .titulo {
            font-size: 2.0rem;
            font-weight: bold;
            color: #FF5C05;
            padding: 20px;
        }

        .localizacao {
            font-size: medium;
            color: #FF5C05;
            padding: 20px;
        }

        .idade {
            font-size: medium;
            color: #FF5C05;
            padding: 20px;
        }

        .icon {
            width: 16px;
            height: 16px !important;
            margin-top: -10px !important;
            float: left !important;
            margin-right: 5px;
            cursor: pointer;
            padding: 20px;
        }

        h1 {
            font-size: 2.5rem;
            font-weight: bold;
            color: #FF5C05;
        }

        body {
            background-color: #FFFAFA;
            color: #62442F;
            margin: 50x 100px 50px 100px;
            font-family: 'Montserrat', sans-serif;
            padding-left: 20px;


        }

        #logo {
            width: 230px;
            position: absolute;
            left: 50px;
            margin-top: 20px;
        }


        nav {
            display: flex;
            justify-content: space-evenly;
            align-items: center;
            /* border:1px solid blue; */
            width: 25vw;
            margin-left: 15vw;
            margin-top: -20px;
            height: 30%;
            /* se necessario min height */
        }

        footer {
            height: 10vh;
            background-color: #FF5C05;
            clear: both;
            padding: 20px;

        }

        header {
            height: 25vh;
            background-color: #F8F2F2;
            margin: 0;
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

        #div5 {
            width: 80vw;
            margin: auto;
            display: flex;
            flex-wrap: wrap;
            row-gap: 10px;
        
        }

        .status {
        font-size: 1.2rem;
        color: #FF5C05;
        padding: 20px;
        }

    </style>

    <br>
    <br>
    <br>

<body>

    <header>


    </header>
    <br>
    <h1>Veja mais detalhes e adote!</h1>

    <?php
    include("config.php");
    $result = $conn->query("select * from animal where idAnimal = " . $_GET["id"]);

    while ($registro = $result->fetch_assoc()) {
        echo "<div class='item'>";
        $id = $registro["idAnimal"];
        $nome = $registro["nome"];
        echo "<a href='animal.php?id=$id'>";
        echo "<img id='principal' src='{$registro["imagem_url"]}'>";
        echo "</a>";
        echo "<p class= 'titulo'>" . $registro["nome"] . "</p>";
        echo "<p class= 'idade'>" . $registro["idade"] . "</p>";
        echo "<p class= 'localizacao'>" . "<b>Localização: </b>" . $registro["concelho"] . "</p>";
        $status = $registro["status"];
        if ($status == 0) {
            echo "<p class= 'status'>Para adoção</p>";
        } else if ($status == 1) {
            echo "<p class= 'status'>Adotado</p>";
        }
        if (!empty($_SESSION["userid"]) && $_SESSION["admin"] == 1) {
            echo "<a href='javascript:confirmar($id)'>";
            echo "<img src= 'delete.png' class ='icon'>";
            echo "</a>";

            echo "<a href='alterar_animal.php?id=$id'>";
            echo "<img src= 'edit.png' class ='icon'>";
            echo "</a>";
        }

        //obter imagens deste produto
        echo "<div class='lista'>";
        $imagens = $conn->query("select * from imagem where idAnimalFK='$id'");
        while ($imagem = $imagens->fetch_assoc()) {
            echo "<img src='{$imagem["imagem_url"]}'
        onclick='muda(this.src)'
        >";
        }
        echo "</div>";
        echo "</div>";
    }
    $conn->close();

    ?>

    <script>
        function muda(url) {
            document.getElementById('principal').src = url;
        }
    </script>
    <script>
        function confirmar(id) {
            if (confirm("tem certeza que deseja apagar?"))
                location.href = 'eliminar_animal.php?id=' + id;
        }
    </script>
<br>
    <br>
    <br>
    <div id="div5">
        <form method="post">

            <h1> Quer adotar <?php echo $nome ?>?</h1>
            <p> Preencha o formulário abaixo </p>

            <p>Nome: <input type="text" id="nome" placeholder="Digite seu nome completo" required>
                <span>* campos de preenchimento obrigatório</span>
            </p>
            <p>E-mail: <input type="email" name="email" placeholder="Digite seu email" required>
                <span>* campos de preenchimento obrigatório</span>
            </p>

            <p><input type="submit" value="Enviar"></p>
            <script>
                document.getElementsByTagName("span")[0].className = 'erro';
                document.getElementsByTagName("span")[1].className = 'erro';


                var spans = document.getElementsByTagName("span");

                for (var i = 0; i < spans.length; i++) {
                    spans[i].className = "erro";
                    spans[i].setAttribute("hidden", "true");
                }
            </script>

        </form>
    </div>


    <a href="index.php?opcao=animais">Voltar</a>


    <br>
    <br>
    <br>

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
        </div>

    </footer>



</html>