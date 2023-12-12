<?php
if (!empty($_GET['id_cliente'])) {
    include_once('config.php');

    $id_cliente = $_GET['id_cliente'];

    
    $sqlSelect = "SELECT * FROM cliente WHERE id_cliente = $id_cliente";
    $result = $conexao->query($sqlSelect);

    if ($result->num_rows > 0) {
        
        $frase = "Nossa equipe acaba de finalizar o serviço, pronto para retirada";
        $sqlUpdate = "UPDATE cliente SET concluir = '$frase' WHERE id_cliente = $id_cliente";

        if ($conexao->query($sqlUpdate) === TRUE) {
            echo "Mensagem atualizada com sucesso no banco de dados.";
        } else {
            echo "Erro ao atualizar mensagem: " . $conexao->error;
        }
    } else {
        echo "Cliente não encontrado.";
    }
}

// Redireciona para a página de dados do funcionário
header('Location: dados-funcionario.php?id_cliente=' . $id_cliente);
?>
