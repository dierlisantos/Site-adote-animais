<?php ob_start(); ?>
<h1>Insira o animal para adoção aqui</h1>
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
<p>Imagens: <input type="file" name="imagens[]" multiple></p>
<p><button>Adicionar</button></p>
</form>

<?php
if (!empty($_POST["nome"]))
{
    $nome = $_POST["nome"];
    $cor = $_POST["cor"];
    $concelho= $_POST["concelho"];
    $status = $_POST["status"];
    $idCategoria = $_POST["idCategoria"];
    $idade = $_POST["idade"];
    $vacina = $_POST["vacina"];
    $imagem_url = "null";


   include("config.php");
   $sql="insert into animal (nome, idCategoriaFK, cor, idade, vacina, concelho, status, imagem_url) 
   values ('$nome', '$idCategoria', '$cor', '$idade', '$vacina', '$concelho', '$status', $imagem_url)";;

   echo $sql;
   $conn->query($sql);
   $idAnimal = $conn->insert_id;
   echo "<p>novo animal com id $idAnimal</p>";
   
   // upload das várias imagens
   $comando = "";
   foreach($_FILES["imagens"]["tmp_name"] as $key=>$value)
   {
    echo "$key  $value<br>"; // 0   C:\xampp\tmp\php92FE.tmp
    
    move_uploaded_file($value,"img/".$_FILES["imagens"]["name"][$key]);

    $imagem_url="img/".$_FILES["imagens"]["name"][$key];

    if ($key==0)

       $comando.="update animal set imagem_url='$imagem_url' where idAnimal=$idAnimal;";

    $comando.="insert into imagem(imagem_url,idAnimalFK)
    values('$imagem_url',$idAnimal);";
   }
   echo $comando;
   $conn->multi_query($comando);

   $conn->close();
   // redirecionar para a página pretendida!
   header("location: index.php?opcao=animais");
}
?>