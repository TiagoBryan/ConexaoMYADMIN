<?php
define('MYSQL_HOST', 'localhost:3306');
define('MYSQL_USER', 'root');
define('MYSQL_PASSWORD', '');
define('MYSQL_DB_NAME', 'bd_sistemas');

try {
    $PDO = new PDO('mysql:host=' . MYSQL_HOST . ';dbname=' . MYSQL_DB_NAME, MYSQL_USER, MYSQL_PASSWORD);
} catch (PDOException $e) {
    echo 'Erro ao conectar com o MySQL ' . $e->getMessage();
}

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $id = isset($_GET['registro']) ? filter_var($_GET['registro'], FILTER_SANITIZE_NUMBER_INT) : null;
    $nome = $_POST['nome'];
    $endereco = $_POST['endereco'];
    $bairro = $_POST['bairro'];
    $cep = $_POST['cep'];
    $cidade = $_POST['cidade'];
    $estado = $_POST['estado'];

    $sql = "UPDATE clientes SET nome=:nome, endereco=:endereco, bairro=:bairro, cep=:cep, cidade=:cidade, estado=:estado WHERE id=:id";
    $stmt = $PDO->prepare($sql);
    $stmt->bindParam(':nome', $nome);
    $stmt->bindParam(':endereco', $endereco);
    $stmt->bindParam(':bairro', $bairro);
    $stmt->bindParam(':cep', $cep);
    $stmt->bindParam(':cidade', $cidade);
    $stmt->bindParam(':estado', $estado);
    $stmt->bindParam(':id', $id);

    if ($stmt->execute()) {
       header("Location: consulta.php");
    } else {
        echo 'Erro ao atualizar o registro.';
    }
}

$id = isset($_GET['registro']) ? filter_var($_GET['registro'], FILTER_SANITIZE_NUMBER_INT) : null;

$sql = "SELECT * FROM clientes WHERE id = :id";
$stmt = $PDO->prepare($sql);
$stmt->bindValue(':id', $id);
$stmt->execute();

if ($stmt->rowCount() > 0) {
    $row = $stmt->fetch(PDO::FETCH_ASSOC);

    $nome = $row['nome'];
    $endereco = $row['endereco'];
    $bairro = $row['bairro'];
    $cep = $row['cep'];
    $cidade = $row['cidade'];
    $estado = $row['estado'];
} else {
    echo 'Registro não encontrado.';
}
?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edição de Dados</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-KK94CHFLLe+nY2dmCWGMq91rCGa5gtU4mk92HdvYe+M/SXH301p5ILy+dN9+nJOZ" crossorigin="anonymous">
   <link rel="stylesheet" href="style.css">
</head>
<body>
    <div class="container">
        <div class="row">
            <div class="col centralizar">
            <div id="tela_dados2" class="card">
            <div class="logo_consultar"> <img class="img-fluid" src="consultar.png" alt=""> </div>
            <div class="text-center">
            <h3>Edição de Dados</h3>
            <hr style="width: 50%; margin: auto;">
            </div>
            <form action="" method="POST">
                <div class="campo">
                    <input name="nome" type="text" value="<?php echo $nome; ?>" required="">
                    <label>Nome:</label>
                </div>
                <div class="campo">
                    <input name="endereco" type="text" value="<?php echo $endereco; ?>" required="">
                    <label>Endereço:</label>
                </div>
                <div class="campo">
                    <input name="bairro" type="text" value="<?php echo $bairro; ?>" required="">
                    <label>Bairro:</label>
                </div>
                <div class="campo">
                    <input name="cep" type="text" value="<?php echo $cep; ?>" required="">
                    <label>Cep:</label>
                </div>
                <div class="campo">
                    <input name="cidade" type="text" value="<?php echo $cidade; ?>" required="">
                    <label>Cidade:</label>
                </div>
                <div class="campo">
                    <input name="estado" type="text" value="<?php echo $estado; ?>" required="">
                    <label>Estado:</label>
                </div>
                <button type="submit" class="botao">Gravar Alteração</button>
            </form>
                
            </div>
        </div>
    </div>
</body>
</html>