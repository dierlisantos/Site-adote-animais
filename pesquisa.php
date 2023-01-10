<style>
    
    h2 {
        width: 70vw;
        margin: 50px auto;
        color: #FF5C05;
    }
    p {
            width: 70vw;
            margin: 50px auto;
            line-height: 1.5em;

        }
</style>


<p><h2> Pesquisa </h2></p> 
<p> Pesquise pelo nome, característica ou categoria do animal que você quer adotar e veja os disponíveis</p>
<form action="" method="post">
    
  <p>
    Procurar por: <input type="text" name="texto">
  </p>
  <p>Categoria: 
     <?php 
     include("config.php");
     $result=$conn->query("select * from categoria");
     echo "<select name='idcategoria'>";
     echo "<option value='0'></option>";
     while( $registo = $result->fetch_assoc() )
     {
      echo "<option value='{$registo["idcategoria"]}'>{$registo["categoria"]}</option>\n";
     }
     echo "</select>";
     ?>
   </p>
   <p><button>Pesquisar</button></p>
</form>


<?php
if (isset($_POST["texto"])) {

    require("config.php");

    $texto = $_POST["texto"];
    $sql = "select * from animal where nome like '%$texto%' or cor like '%$texto%' or concelho like '%$texto%' or idade like '%$texto%'";

    if ($_POST["idcategoria"] > 0)
        $sql .= " and idcategoriaFK=" . $_POST["idcategoria"];


    echo "<hr>$sql<hr>";
    $result = $conn->query($sql);



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
            echo "<p>Para doação</p>";
        } else if ($status == 1) {
            echo "<p>Doado</p>";
        }

        echo "<a href='javascript:confirmar($id)'>";
        echo "<img src= 'delete.png' class ='icon'>";
        echo "</a>";

        echo "<a href='alterar_animal.php?id=$id'>";
        echo "<img src= 'edit.png' class ='icon'>";
        echo "</a>";

        echo "</div>";
    }

    $conn->close();
}

?>