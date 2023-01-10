
<?php
if (!empty ($_POST["idCategoria"]))

{
    include("config.php");
    $idCategoria = $_POST["idCategoria"];
    echo "<hr> delete from categoria where idCategoria='$idCategoria'<hr>";
    $conn->query("delete from categoria where idCategoria='$idCategoria'");
    $conn->close();


}


?>
<br>
<form method="post">
<?php include ("categorias_select.php"); ?> <br>
<button>Eliminar</button>

</form>

<br>
<br>
<br>
<br>
