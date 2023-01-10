<?php
//obter o parametro do url
if (empty($_GET["id"]))
    header("location: animais.php");

$id = $_GET["id"];
require("config.php");
$result=$conn->query("select * from animal where idAnimal='$id'");
if ( $registro = $result->fetch_assoc())
{
        $nome = $registro ["nome"];
        $idade = $registro ["idade"];
        $concelho = $registro ["concelho"];
        
}

?>

<form method="post">

<p>Nome: <input type="text" name="nome" value="<?php echo $nome; ?>"></p>
    <p>Filhote ou adulto: <input type="text" name="idade" value="<?php echo $idade; ?>"></p>
    <p>Localização: <input type="text" name="concelho" value="<?php echo $concelho; ?>"></p>
    <p><button>Alterar</button></p>

    </form>

    <?php
    if (!empty($_POST["nome"]))
    {
        $nome=$_POST["nome"];
        $idade=$_POST["idade"];
        $concelho=$_POST["concelho"];
        include("config.php");
        $sql="update animal set nome = '$nome', idade = '$idade', concelho = '$concelho' where idAnimal= $id";
        echo $sql;
        $conn->query($sql);
        $conn->close();

    }    
    
    ?>