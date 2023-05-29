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
    $id = $_POST['registro'];

    $sql = "DELETE FROM clientes WHERE id = :id";
    $stmt = $PDO->prepare($sql);
    $stmt->bindValue(':id', $id);

    if ($stmt->execute()) {
        echo 'Registro excluído com sucesso!';
        header('Location: consulta.php');
    } else {
        echo 'Erro ao excluir o registro.';
    }
}
?>