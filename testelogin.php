<?php
session_start();

if (isset($_POST['submit']) && !empty($_POST['email']) && !empty($_POST['placa'])) {
    // Acessa
    include_once('config.php');
    $email = $_POST['email'];
    $placa = $_POST['placa'];

    $sql = "SELECT * FROM cliente WHERE email = '$email'";
    $result = $conexao->query($sql);

    if (!$result) {
        die('Erro na consulta SQL: ' . mysqli_error($conexao));
    }

    if (mysqli_num_rows($result) < 1) {
        unset($_SESSION['email']);
        unset($_SESSION['placa']);
        echo '<script>
            alert("Conta de usuário não identificada, realize o cadastro 🚨 ");
            window.location.href = "login.html";
        </script>';
    } else {
        $user_data = mysqli_fetch_assoc($result);
        $_SESSION['email'] = $email;
        $_SESSION['placa'] = $placa;

        // Redireciona para a página "dados-cliente.php" com o valor de id_cliente na URL
        header("Location: dados-cliente.php?id_cliente=" . $user_data['id_cliente']);
    }
} else {
    // Não acessa
    header('Location: home.html');
}

?> mas ele esta liberando, esse e meus dadso-cliente <?php
session_start();
include_once('config.php');

$logado = $_SESSION['email'];

$sql = "SELECT * FROM cliente WHERE email = '$logado'";
$result = $conexao->query($sql);

if (!$result) {
    die('Erro na consulta: ' . mysqli_error($conexao));
}

$user_data = mysqli_fetch_assoc($result);

$result = $conexao->query($sql);

?>