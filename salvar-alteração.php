<?php
include_once('config.php');

if(isset($_POST['update'])){
    $id_cliente = $_POST['id_cliente'];
    $data_cadastro = $_POST['data_cadastro'];
    $horario = $_POST['horario'];

    $sqlUpdate = "UPDATE cliente SET data_cadastro = '$data_cadastro', horario = '$horario' 
                  WHERE id_cliente = '$id_cliente'";
    $result = $conexao->query($sqlUpdate);

    if($result) {
        // Atualização bem-sucedida, redireciona para a página de sucesso
        header('location: dados-cliente.php');
    } else {
        // Falha na atualização, redireciona para a página de erro
        header('location: erro.php');
    }
 
    

}


?>
