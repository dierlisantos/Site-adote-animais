<style>
.lista {
    font-size: large;
    color: #FF5C05;
    font-weight: bold;

}

body{
    font-family: sans-serif;
    background-image: url(fundo.png);
    background-attachment:initial;
    background-position: right;
    background-attachment: url;

}

footer {
            height: 10vh;
            background-color: #FF5C05;
}



</style>
<html>
<h1>Categorias de animais para adoção</h1>
<p> Aqui na Quatro Patas temos diversos tipos de animais para alegrar a sua vida. Confira abaixo as categorias de animais disponíveis hoje:</p>
<body>
    
</body>

<?php
include("config.php");
$result=$conn->query("select * from categoria");
echo "<ul class='lista'>";
while( $registro = $result->fetch_assoc())
{
    echo "<li>{$registro["categoria"]}</li>";
}
echo "</ul>";
$conn->close();

?>


<br>
<br>
<br>
</html>
