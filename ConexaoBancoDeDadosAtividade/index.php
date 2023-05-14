<?php 
    define('MYSQL_HOST', 'localhost:3306');
    define('MYSQL_USER', 'root');
    define('MYSQL_PASSWORD', '');
    define('MYSQL_DB_NAME', 'bd_sistemas');

    try{
        $PDO = new PDO('mysql:host=' . MYSQL_HOST . ';dbname=' . MYSQL_DB_NAME, MYSQL_USER, MYSQL_PASSWORD);

    }catch(PDOException $e){
        echo 'Erro ao conectar com o MySQL ' . $e->getMessage();
    }

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Conexão com Banco de dados</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-KK94CHFLLe+nY2dmCWGMq91rCGa5gtU4mk92HdvYe+M/SXH301p5ILy+dN9+nJOZ" crossorigin="anonymous">
    <style>
        body{
            background-image: linear-gradient(to right, #020024, #0f0f75, #00d4ff);

        }
        .centralizar{
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
        }
        .logo_consultar{
            background-color: #440f75;
            width: 80px;
            border-radius: 1000px;
            padding: 5px;
        
           margin: auto;
           margin-top: -35px;
           margin-bottom: 20px;
      
            
        }
        h3{
            color: black;
            font-weight: bold;
            
        }
        #tela_dados{
            background-color: rgba(255, 255, 255, 0.4);
                width: 700px;
                height: 300px;
                padding: 0px 20px;
                border-radius: 10px
                
            }
        
    </style>
</head>
<body>
    <div  class="container ">
        <div  class="row">
            <div  class="col centralizar">
            <div id="tela_dados" class="card">
            <div class="logo_consultar"> <img class="img-fluid" src="consultar.png" alt=""> </div>
            <div class="text-center">
            <h3>Consulta de Dados</h3>
            <hr style="width: 50%; margin: auto;">
            </div>
            <br>
            <div class="table-responsive">
            <table class="table table-dark table-striped-columns">
            <thead>
                    <tr>
                    <th scope="col">id</th>
                    <th scope="col">Nome</th>
                    <th scope="col">Endereço</th>
                    <th scope="col">Bairro</th>
                    <th scope="col">Cep</th>
                    <th scope="col">Cidade</th>
                    <th scope="col">Estado</th>
                    </tr>
                </thead>
                <tbody>
                <?php 
    
                    $sql = "SELECT * FROM clientes";
                    $result = $PDO->query($sql);
                    $rows = $result->fetchALL();
                    ?> 

                    <tr>
                    <th scope="row"><?php echo $rows[0]['id']; ?></th>
                    <td><?php echo $rows[0]['nome']; ?></td>
                    <td> <?php echo $rows[0]['endereco']; ?></td>
                    <td><?php echo $rows[0]['bairro']; ?></td>
                    <td><?php echo $rows[0]['cep']; ?></td>
                    <td><?php echo $rows[0]['cidade']; ?></td>
                    <td> <?php echo $rows[0]['estado']; ?></td>
                    </tr>
                    
                </tbody>
            </table>
            </div>
            
    

        </div>
            </div>
        </div>
    </div>
   
       

    
</body>
</html>
