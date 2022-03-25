<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Livraria Top</title>
    <link rel="stylesheet" href="styles.css">
</head>
<body>
    
<?php
$mysqli = new mysqli("localhost","root","","livraria");

if ($mysqli -> connect_errno) {
    echo "Failed to connect to MySQL: " . $mysqli -> connect_error;
    exit();
} else {
    // var_dump($_POST);
    $errorMsg = false;
    if(isset($_POST['nome']) && isset($_POST['email']) && isset($_POST['senha'])) {
        $nome = $_POST['nome'];
        $email = $_POST['email'];
        $senha = $_POST['senha'];
        $username = explode("@", $email)[0];

        $custo = '08';
        $salt = 'dpanlhwASDqcuaLHBLJBHKLJnLKBAF';
        $hash = crypt($senha, '$2a$' . $custo . '$' . $salt . '$');

        $sql = "insert into usuario (nome, email, username, senha) values ('$nome', '$email', '$username', '$hash')";
        $queryRes = mysqli_query($mysqli, $sql);

        if ($queryRes) {
            $cache_expire = session_cache_expire(5);
            session_start();
            
            $query = $mysqli->query("select id from usuario where email = '$email'");
            $result = [];
            while($row = $query->fetch_array()){
                $result = $row[0];
            }
            $_SESSION["id"] = $result;
            $_SESSION["username"] = $username;
            $errorMsg = false;
            header("refresh:0;url=home.php");
        } else {
            $errorMsg = true;
        }
    }
}

$mysqli->close();

echo "<div class='card card-cadastro'>";
    echo "<form action='cadastro.php' method='post'>";
        echo "<h1 class='card-title'>Cadastro</h1>";
        echo "<div class='flex-column'>";
            echo "<input type='text' placeholder='Digite o seu nome' name='nome' class='input-login' />";
            echo "<input type='text' placeholder='Digite o seu email' name='email' class='input-login' />";
            echo "<input type='password' placeholder='Digite sua senha' name='senha' class='input-login' />";
            echo "<button type='submit' class='button'>Criar conta</button>";
            echo "<a href='/' class='link'>Já tem uma conta? <span>Entre aqui</span></a>";
        echo "</div>";
    echo "</form>";
echo "</div>";

?>
</body>
</html>