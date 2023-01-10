Selecione a categoria de animal para adoção:
<?php
include ("config.php");
$result=$conn->query("select* from categoria");
echo "<select name='idCategoria'>";
while  ( $registro = $result->fetch_assoc() )
{
    $idcategoria=$registro["idCategoria"];
    $categoria=$registro ["categoria"];
    echo "<option value= '$idcategoria'>$categoria</option>";

}

echo "</select>";
$conn->close();

?>