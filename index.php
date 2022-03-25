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
    $errorMsg = false;
    if(isset($_POST['email']) && isset($_POST['senha'])) {
        $email = $_POST['email'];
        $senha = $_POST['senha'];

        $custo = '08';
        $salt = 'dpanlhwASDqcuaLHBLJBHKLJnLKBAF';
        $hash = crypt($senha, '$2a$' . $custo . '$' . $salt . '$');

        $queryRes = mysqli_query($mysqli, "select senha from usuario where email = '$email'");
        $fetch = $queryRes->fetch_array()[0];
        if($fetch == $hash){
            
            $cache_expire = session_cache_expire(5);
            session_start();

            $userQuery = $mysqli->query("select id, username from usuario where email = '$email'");
            $userData = $userQuery->fetch_array();

            $_SESSION["id"] = $userData['id'];
            $_SESSION["username"] = $userData['username'];
            $errorMsg = false;
            header("refresh:0;url=home.php");
        } else {
            $errorMsg = 'Email ou senha inválidos';
        }
    }
}
$mysqli->close();

echo "<div class='card card-login'>";
    echo "<form action='/' method='post'>";
        echo "<h1 class='card-title'>Login</h1>";
        echo "<div class='flex-column'>";
            echo "<input type='text' placeholder='Digite o seu email' name='email' class='input-login' />";
            echo "<input type='password' placeholder='Digite sua senha' name='senha' class='input-login' />";
            echo "<button type='submit' class='button'>Entrar</button>";
            echo $errorMsg ? "<p class='error-txt'>Email ou senha inválidos</p>": "";
            echo "<a href='cadastro.php' class='link'>Não tem uma conta? <span>Cadastre-se aqui</span></a>";
        echo "</div>";
    echo "</form>";
echo "</div>";

?>
</body>
</html>