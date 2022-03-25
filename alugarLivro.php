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
    session_start();
    if(!isset($_SESSION['id']) || !isset($_SESSION['username'])) {
        header("refresh:0;url=index.php");
    } else {
        $id = $_SESSION['id'];
        if(isset($_GET['livro'])) {
            $livro = $_GET['livro'];
            $queryExemplares = mysqli_query($mysqli, "select * from livroexemplar where id not in (select livro from livrosusuario where alugado = true) and livro = $livro limit 1");
            $exemplar = $queryExemplares->fetch_array();
            $sql = "insert into livrosusuario (livro, usuario, alugado) values ($exemplar[0], $id, true)";
            $queryRes = mysqli_query($mysqli, $sql);
            if($queryRes) header("refresh:0;url=home.php");
        } else {
            header("refresh:0;url=home.php");
        }
    }
}

$mysqli->close();
?>
</body>
</html>