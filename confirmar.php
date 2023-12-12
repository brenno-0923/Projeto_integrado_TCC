<?php
if ($_SERVER['REQUEST_METHOD'] === 'GET') {
    include_once('config.php');
    
    $confirmar = $_GET['confirmar'];
    $id_cliente = $_GET['id_cliente'];


    // Atualizar o campo 'servico' no banco de dados
    $sql = "UPDATE cliente SET confirmar = ? WHERE id_cliente = ?";
    $stmt = $conexao->prepare($sql);
    $stmt->bind_param("si", $confirmar, $id_cliente);

    if ($stmt->execute()) {
        echo "Serviço atualizado com sucesso!";
    } else {
        echo "Erro ao atualizar o serviço: " . $stmt->error;
    }

    
    $conexao->close();
}

?>

<div class="formulario">

<form  method="GET" action="confirmar.php">
    <input type="hidden" name="id_cliente" value="<?php echo $user_data['id_cliente']; ?>">
    <input type="radio" id="sim" name="confirmar" value="sim">
    <label for="sim">Sim</label>
    <input type="radio" id="nao" name="confirmar" value="nao">
    <label for="nao">Não</label>
    <input type="submit" value="Enviar" > <br>
</form>
