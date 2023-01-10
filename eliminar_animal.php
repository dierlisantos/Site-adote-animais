<?php
//eliminar_animal.php?id=1

if (!empty($_GET["id"]))
{
// 1. ligar ao servidor mysql
include ("config.php");
// 2. executar o comando sql/query
$id=$_GET["id"];
$conn->query("delete from animal where idAnimal='$id'");
// 3. fechar a ligaçao
$conn-> close();

header("location: index.php?opcao=animais");

}

?>

