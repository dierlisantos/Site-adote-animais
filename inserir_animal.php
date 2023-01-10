<form method="post" enctype="multipart/form-data">

    <p>Nome: <input type="text" name="nome" required></p>
    <p>Cor: <input type="text" name="cor"></p>
    <p>Filhote ou adulto: <input type="text" name="idade"></p>
    <p><?php include ("categorias_select.php") ?></p>
    <p>Localização: <input type="text" name="concelho"></p>
    <p>Vacinas: <select name="vacina"> <option value="0">Com as vacinas em dia</option>
                <option value="1">Precisa de vacinas</option></select></p> 
    <p>Status: <select name="status"> <option value="0">Para adoção</option>
                <option value="1">Adotado</option></select></p>  
    <p>Imagem: <input type="file" name="imagem"></p>
    <p><button>Adicionar</button></p>
</form>

<?php
if (!empty($_POST["nome"])) 
{
//1. upload da imagem
    $imagem_url="NULL";
    if (move_uploaded_file($_FILES["imagem"]["tmp_name"], "img/".$_FILES["imagem"]["name"]))
    {
        $imagem_url="'img/".$_FILES["imagem"]["name"]."'";
        
    }

    $nome = $_POST["nome"];
    $cor = $_POST["cor"];
    $concelho= $_POST["concelho"];
    $status = $_POST["status"];
    $idCategoria = $_POST["idCategoria"];
    $idade = $_POST["idade"];
    $vacina = $_POST["vacina"];

// ligar ao servidor mysql
    include("config.php");
    $sql = "insert into animal (nome, idCategoriaFK, cor, idade, vacina, concelho, status, imagem_url) 
                    values ('$nome', '$idCategoria', '$cor', '$idade', '$vacina', '$concelho', '$status', $imagem_url)";

    echo $sql;
    $conn->query($sql);
    $conn->close();

    // redirecionar para a página pretendida!

    header("location: index.php?opcao=animais");
}

?>