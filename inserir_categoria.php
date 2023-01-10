<form method="post">
    <p>Categoria: <input type="text" name="categoria" required></p>
    <p><button>Adicionar</button></p>

</form>

<?php

if (!empty($_POST["categoria"]))
{
    $categoria = $_POST["categoria"];
    include("config.php");
    $conn->query("insert into categoria(categoria) values('$categoria')");
    $conn->close();
    

    echo "<p>categoria <b>$categoria</b> inserida com sucesso!</p>";
}

?>
