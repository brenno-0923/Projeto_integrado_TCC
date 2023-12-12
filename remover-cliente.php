<?php

if(!empty($_GET['id_cliente']))
{
    include_once('config.php');

    $id_cliente = $_GET['id_cliente'];

    $sqlSelect = "SELECT *  FROM cliente WHERE id_cliente=$id_cliente";

    $result = $conexao->query($sqlSelect);

    if($result->num_rows > 0)
    {
        $sqlDelete = "DELETE FROM cliente WHERE id_cliente=$id_cliente";
        $resultDelete = $conexao->query($sqlDelete);
    }
}
header('Location: dados-funcionario.php');

?>