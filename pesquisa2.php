Pesquisa avançada
<form method="post">
    <p>
        <input type="text" name="texto">
        <button>pesquisar</button>
    </p>
    <p>valor minimo: <input type="number" name="minimo">
</p>

<p><button>pesquisar</button></p>
</form>

<?php
if (isset($_POST["texto"])){
    
    require ("config.php");

    $texto=$_POST["texto"];
    $sql = "select * from animal where nome like '%$texto%' ";
    echo "<hr>$sql<hr>";
    $result=$conn->query($sql);

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