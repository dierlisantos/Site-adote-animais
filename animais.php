<h1>Animais para adoção</h1>
<style>
    .item {
        background-color: #F8F2F2;
        width: 30%;
        margin: 0 auto;
        min-height: 20vh;
        border: 1px;
        padding-left: 20px;
        border-radius: 10px;
    }



    .item img {
        width: 40%;
        float: left;
        margin-left: 7px;
        margin-right: 6px;
    }

    .titulo {
        font-size: 2.0rem;
        font-weight: bold;
        color: #FF5C05;
    }

    h2 {
        font-size: 2.0rem;
        font-weight: bold;
        color: #FF5C05;
        text-align: center;
    }

    h3 {
        font-size: 1.0rem;
        color: #62442F;
        text-align: left;

    }

    .localizacao {
        font-size: 1.0rem;
        color: #62442F;

    }

    .idade {
        font-size: medium;
        color: #62442F;
    }

    .status {
        font-size: 1.0rem;
        color: #FF5C05;
    }
    p {
        width: 70vw;
        margin: 30px auto;
        line-height: 1.2em;

    }


    .icon {
        width: 15px !important;
        height: 15px !important;
        margin-top: -10px !important;
        float: left !important;
        margin-right: 5px;
        cursor: pointer;
    }

    .invisivel {
        display: none
    }

    .erro {
        color: red
    }

    #div1 {
        width: 70vw;
        margin: 0 auto;
        background-color: #F8F2F2;
        padding: 30px 50px 50px 50px;
        border-radius: 10px;
        position: relative;
    }

    .div4 {
        width: 80vw;
        margin: auto;
        padding-left: 40px;
        align-items: left;
    }

    .container {
        width: 80vw;
        margin: auto;
        display: flex;
        flex-wrap: wrap;
        justify-content: space-evenly;
        align-items: center;
        align-content: space-around;
        row-gap: 10px;
        border: 1px;
    }

    .container img {
        width: 30%;
        height: 0%;
        object-fit: cover;
        border: 1px;
        padding: 10px;
        border-radius: 30px
    }
  

  
</style>


<p>Veja aqui todos os nossos animais disponíveis para adoção. Deixe-se apaixonar e preencha o formulário de proposta do animal que pretende adotar. Confira antes os requisitos necessários para adotar um animal amigo, para que este possa ter uma nova casa e ser feliz.</p>

<div class='div4'>
    Selecione a categoria
    <form method="post">
        <?php
        Categorias:
        include("config.php");
        $result = $conn->query("select* from categoria");
        echo "<select name='idcategoria'>";
        while ($registro = $result->fetch_assoc()) {
            $idcategoria = $registro["idCategoria"];
            $categoria = $registro["categoria"];
            if (isset($_POST["idcategoria"]) &&  $idcategoria == $_POST["idcategoria"])
                echo "<option value= '$idcategoria' selected>$categoria</option>";
            else
                echo "<option value= '$idcategoria'>$categoria</option>";
    
        }

        echo "</select>";
        $conn->close();

        ?>

        <button>Filtrar</button>
    </form>

    <br>
    <br>
    <br>


    <?php

    include("config.php");
    if (!empty($_POST["idcategoria"])) {

        $idcategoria = $_POST["idcategoria"];

        $result = $conn->query("select * from animal where idcategoriaFK='$idcategoria'");
        if ($result->num_rows == 0) echo "sem registos";
    } else

        $result = $conn->query("select * from animal limit 9");

    echo "</div>";
    echo "<div class='container'>";
    while ($registro = $result->fetch_assoc()) {
        echo "<div class='item'>";
        $id = $registro["idAnimal"];
        echo "<a href='animal.php?id=$id'>";
        echo "<img src='{$registro["imagem_url"]}'>";
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
        echo "</div>";
    }
    echo "</div>";
    $conn->close();

    ?>

    <script>
        function confirmar(id) {
            if (confirm("tem certeza que deseja apagar?"))
                location.href = 'eliminar_animal.php?id=' + id;
        }
    </script>
    <br>
    <br>
    <br>
    <div id="div1">
        <form method="post">

            <h2 id="comoadotar"> Como adotar?</h2>
            <p> A chegada de um novo animal de companhia à família é um momento emocionante, mas podem surgir algumas dúvidas!
                Vamos ajudar em todo o processo. Para dúvidas, preencha o formulário abaixo. </p>



            <p>Nome: <input type="text" id="nome" placeholder="Digite seu nome completo" required>
                <span>* campos de preenchimento obrigatório</span>
            </p>
            <p>E-mail: <input type="email" name="email" placeholder="Digite seu email" required>
                <span>* campos de preenchimento obrigatório</span>
            </p>

            <h3>Interesse em adoção de:</h3>
            <input type="checkbox" name="Gatos" checked> Gatos
            <input type="checkbox" name="Cães"> Cães
            <input type="checkbox" name="Outros"> Outros

            </p>
            <p>Nome do animal que deseja adotar <input type="text" id="nome">
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
    <br>
    <br>
    <br>
    <br>


    <h2 id="comoajudar"> Como ajudar?</h2><br>
    <p>Os animais precisam de ti!
        Você pode ajudar a ONG QUATRO PATAS de diferentes formas. Conheça:</p>

    <div class="container">
        <img src="1.png">
        <img src="2.png">
        <img src="3.png">
    </div>
    <br>
    <br>
    <br>
    <br>
    <br>