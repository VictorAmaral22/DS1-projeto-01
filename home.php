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
session_start();

if ($mysqli -> connect_errno) {
    echo "Failed to connect to MySQL: " . $mysqli -> connect_error;
    exit();
} else {
    $where = '';
    if(isset($_GET['type']) && isset($_GET['pesquisa'])){
        $type = $_GET['type'];
        $pesquisa = $_GET['pesquisa'];
        $where = " where $type like '%$pesquisa%' ";
    }

    $sql = "select 
        livro.id,
        livro.titulo, 
        livro.descricao, 
        livro.autor, 
        livro.datalancamento, 
        tmp.qtd as qtdExemplares
    from livro 
        left join livroexemplar on livro.id = livroexemplar.livro 
        left join (select livro, count(*) as qtd from livroexemplar where id not in (select livro from livrosusuario where alugado = true) group by livro) as tmp on tmp.livro = livro.id
    $where
    group by livro.id     
    order by livro.datalancamento desc";
    $res = mysqli_query($mysqli, $sql);
    $livros = [];
    while($row = $res->fetch_array()){
        $livros[] = $row;
    }

    $sql2 = "select 
        livroexemplar.id,
        livro.titulo,
        livro.autor,
        livrosusuario.dataalugado
    from livrosusuario 
        join livroexemplar on livrosusuario.livro = livroexemplar.id
        join livro on livroexemplar.livro = livro.id
    where
        livrosusuario.usuario = $_SESSION[id]
    order by livrosusuario.dataalugado desc";
    $res2 = mysqli_query($mysqli, $sql2);
    $livrosAlugados = [];
    while($row2 = $res2->fetch_array()){
        $livrosAlugados[] = $row2;
    }
}

$mysqli->close();

if(!isset($_SESSION['id']) || !isset($_SESSION['username'])) {
    header("refresh:0;url=index.php");
}

echo "<div class='grid'>";

    echo "<header class='header'>
            <div class='user-info'>
                <p>@".$_SESSION['username']."</p>
                <a href='logout.php'>
                    <img src='assets/logout.png' />
                </a>
            </div>
        </header>";

    echo "<div class='content'>";

    echo "<h3>Livros Alugados</h3>";
    if(count($livrosAlugados) === 0) {
        echo "<p>Voc?? ainda n??o alugou nenhum livro...</p>";
        print_r($livrosAlugados);
    } else {
        echo "<table>
            <thead>
            <th>C??digo</th>
            <th>T??tulo</th>
            <th>Autores</th>
            <th>Data Aluguel</th>
            </thead>
            <tbody>";
            foreach($livrosAlugados as $livro){
                echo "<tr>";
                echo "<td>$livro[id]</td>";
                echo "<td>$livro[titulo]</td>";
                echo "<td>$livro[autor]</td>";
                echo "<td>$livro[dataalugado]</td>";
                echo "</tr>";
            }
            echo "</tbody>
        </table>";
    }
        
    echo "<h3>Livros Dispon??veis</h3>";
    echo "<form action='home.php' metho='get'>";
    echo "<select name='type'>
        <option value='livro.titulo'>T??tulo</option>
        <option value='livro.datalancamento'>Ano</option>
    </select>";
    echo "<input type='text' name='pesquisa'></input>";
    echo "<button>Pesquisar</button>";
    echo "</form>";

    if(count($livros) === 0) {
        echo "<p>N??o temos um livro que preenche esses requisitos...</p>";
    } else {
        echo "<table>
                <thead>
                    <th>T??tulo</th>
                    <th>Autores</th>
                    <th>Lan??amento</th>
                    <th>Descri????o</th>
                    <th>Exemplares dispon??veis</th>
                    <th></th>
                </thead>
                <tbody>";
                foreach($livros as $livro){
                    echo "<tr>";
                    echo "<td>$livro[titulo]</td>";
                    echo "<td>$livro[autor]</td>";
                    echo "<td>$livro[datalancamento]</td>";
                    echo "<td>$livro[descricao]</td>";
                    echo "<td>".($livro['qtdExemplares'] ? $livro['qtdExemplares'] : '0')."</td>";
                    echo "<td>";
                    echo $livro['qtdExemplares'] > 0 ? "<a href='alugarLivro.php?livro=$livro[id]'>Alugar</a>" : "<p>Sem exemplares</p>";
                    echo "</td>";
                    echo "</tr>";
                }
           echo "</tbody>
        </table>";
    }

    echo "</div>";

echo "</div>";

?>
</body>
</html>