<form method="post" enctype="multipart/form-data">

   <p> Ficheiro: <input type="file" name="ficheiro"></p>
   <p><button>Enviar </button></p>
</form>


<?php
if ($_FILES)
{
    echo "nome oficinal do ficheiro: ".$_FILES["ficheiro"]["name"]."<br>";
    echo "tamanho em bytes: ".$_FILES["ficheiro"]["size"]."<br>";
    echo "tipo de ficheiro (código mime): ".$_FILES["ficheiro"]["type"]."<br>";
    echo "codigo de erro (sendo que 0 é tudo ok!: ".$_FILES["ficheiro"]["error"]."<br>";
    echo "ficheiro temporario: ".$_FILES["ficheiro"]["tmp_name"]."<br>";

   if (move_uploaded_file($_FILES["ficheiro"]["tmp_name"], "img/".$_FILES["ficheiro"]["name"]))
        echo "<h2>Ficheiro enviado com sucesso</h2>";
    

}

?>