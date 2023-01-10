<style>
    h1 {
      font-size: 2.0rem;
      font-weight: bold;
      color: #FF5C05;
      text-align:center;
   }

   p {
      width: 70vw;
      margin: 50px auto;
      line-height: 1.2em;
      text-align:center;
   }
</style>

<form method="post">
    <h1>Faça o login</h1>
    <p>Username: <input type="text" name="username"></p>
    <p>Password: <input type="password" name="password"></p>
    <p><button>Entrar</button></p>

</form>


<?php
if (!empty($_POST["username"]) && !empty($_POST["password"]))
{
    require("config.php");
    $username = $_POST["username"];
    $password = $_POST["password"];
    $sql="select * from utilizador where username='$username' and password='$password'";
    echo $sql;
    $result=$conn->query($sql);
    if ($registro=$result->fetch_assoc())
    {
        $_SESSION["userid"]=$registro["idutilizador"];
        $_SESSION["username"]=$registro["username"];
        $_SESSION["admin"]=$registro["admin"];
        header("location: index.php");
    }
    else 
    {
        echo "<p>Username e/ou password estão incorretos. Tente novamente!</p>";
    }

}

?>