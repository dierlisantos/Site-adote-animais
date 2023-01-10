<style>
   h1 {
      font-size: 2.0rem;
      font-weight: bold;
      color: #FF5C05;
      text-align: center;
   }

   p {
      width: 70vw;
      margin: 50px auto;
      line-height: 1.2em;
      text-align: center;
   }



</style>

<html>
<h1>Registre-se</h1>
<p>Crie a sua conta para acessar</p>

</html>

<body>
   
</body>

<form method="post">
   <p>Username: <input type="text" name="username" required></p>
   <p>Password: <input type="password" name="password" required minlength="3"></p>
   <p>Confirmar password: <input type="password" name="cpassword" required></p>
   <p><button>Criar conta</button>
</form>
<?php
if (!empty($_POST["username"])) {
   require("config.php");
   $username = $_POST["username"];
   $password = $_POST["password"];
   $cpassword = $_POST["cpassword"];

   if ($password != $cpassword) {
      echo "<p>password e confirmar password são diferentes!</p>";
      exit;
   }

   $result = $conn->query("select * from utilizador where username='$username'");

   if ($result->num_rows > 0) {
      echo "<p>username já existente! tente outro!</p>";
      exit;
   }

   $sql = "insert into utilizador(username,password) values('$username','$password')";
   //echo $sql;
   $conn->query($sql);
   if ($conn->affected_rows == 1) {
      echo "<p>utilizador registado com sucesso!</p>";
      echo "<p>efetue o login <a href='index.php?opcao=login'>aqui</a></p>";
      echo "<script>document.forms[0].style.display='none';</script>";
   }
}

?>