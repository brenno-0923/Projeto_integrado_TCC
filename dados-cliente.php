<?php
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

<!DOCTYPE HTML>

	<head>
	<link rel="shortcut icon" href="imgs/icon-br.ico" type="image/x-icon">
		<title> BR SHOP </title>
		<meta charset="utf-8" />
		<meta name="viewport" content="width=device-width, initial-scale=1, user-scalable=no" />
		<link rel="stylesheet" href="assets/css/style02.css" />
	</head>
	<body class="homepage is-preload">
		<div id="page-wrapper">

<!-- Header -->
				<section id="header">

<!-- Logo -->
<img src="imgs/logo-curto.png" class="logo-principal">
					


					<!-- Nav -->
											<nav id="nav">
												<ul>
													<li class="current"><a href="home.html">Home</a></li>
													<li><a href="serviços.html">Serviçod</a></li>
													<li><a href="login.html">Login</a></li>
													<li><a href="registrar.php">Cadastro</a></li>
												</ul>
											</nav>
					<br>
					
					

<!-- Main -->
<section id="main">
					<div class="container">
						<div class="row">
						
					
<!-- Nossos serviços -->
<br>


<?php
echo "<div class='config-serv'>";

echo "<td>" . "Olá " . $user_data['nome'] . " escolha um de nossos serviços: </td>";

echo "<td>

   
    <a href='servicos1.php?id_cliente=".$user_data['id_cliente']."'>
        Serviço
    </a>
</td>";



	echo "</tr>";


echo"  </tbody> ";               
echo "</table> ";
echo "</div>";
?>



</div>
<br> <h4>Dados pessoais:</h4>	<br>
<div class="tabelas">

<table class="table">
<thead>
	<tr>
	  <th>#</th>
   	  <th>Nome</th> 
   	  <th>Data</th> 
   	  <th>Horário</th>
   	  <th>Serviços</th>
	  <th> Status do serviço</th>
	  <th>Ações</th>
	</tr>
</thead>
<tbody>     




<?php

	while($user_data = mysqli_fetch_assoc($result)) {
	echo "<tr>";
echo "<td>".$user_data['id_cliente']."</td>";											
echo "<td>".$user_data['nome']."</td>";
echo "<td>".$user_data['data_cadastro']."</td>";
echo "<td>".$user_data['horario']."</td>"; 
echo "<td>".$user_data['servico']."</td>"; 
if (is_null($user_data['concluir'])) {
	echo "<td>Aguardando conclusão do serviço</td>";
} else {
	echo "<td>" . $user_data['concluir'] . "</td>";
}
 
echo "<td>															

<a class='btn btn-sm btn-primary' href='adicionar.php?id_cliente=$user_data[id_cliente]' title='Editar'>
	<svg xmlns='http://www.w3.org/2000/svg' width='18' height='18' fill='currentColor' class='bi bi-clock-fill' viewBox='0 0 16 16'>
  		<path d='M16 8A8 8 0 1 1 0 8a8 8 0 0 1 16 0zM8 3.5a.5.5 0 0 0-1 0V9a.5.5 0 0 0 .252.434l3.5 2a.5.5 0 0 0 .496-.868L8 8.71V3.5z'/>
		</svg>
</a>

<a class='btn btn-sm btn-primary' href='servicos1.php?id_cliente=$user_data[id_cliente]' title='Editar'>
<svg xmlns='http://www.w3.org/2000/svg' width='18' height='18' fill='currentColor' class='bi bi-wrench' viewBox='0 0 16 16'>
 		<path d='M.102 2.223A3.004 3.004 0 0 0 3.78 5.897l6.341 6.252A3.003 3.003 0 0 0 13 16a3 3 0 1 0-.851-5.878L5.897 3.781A3.004 3.004 0 0 0 2.223.1l2.141 2.142L4 4l-1.757.364L.102 2.223zm13.37 9.019.528.026.287.445.445.287.026.529L15 13l-.242.471-.026.529-.445.287-.287.445-.529.026L13 15l-.471-.242-.529-.026-.287-.445-.445-.287-.026-.529L11 13l.242-.471.026-.529.445-.287.287-.445.529-.026L13 11l.471.242z'/>
	/svg> 
</a>


<a class='btn btn-sm btn-primary' href='remover.php?id_cliente=$user_data[id_cliente]' title='Remover'>
	<svg xmlns='http://www.w3.org/2000/svg' width='18' height='18' fill='currentColor' class='bi bi-x-circle-fill' viewBox='0 0 16 16'>
  		<path d='M16 8A8 8 0 1 1 0 8a8 8 0 0 1 16 0zM5.354 4.646a.5.5 0 1 0-.708.708L7.293 8l-2.647 2.646a.5.5 0 0 0 .708.708L8 8.707l2.646 2.647a.5.5 0 0 0 .708-.708L8.707 8l2.647-2.646a.5.5 0 0 0-.708-.708L8 7.293 5.354 4.646z'/>
	</svg>
</a>

</td>";
echo "</tr>";
}

?>

    		 </tbody>                
    	</table> 
	</div>


<br>
<p>


<!-- Confirmação -->

<?php
if ($_SERVER['REQUEST_METHOD'] === 'GET') {
    include_once('config.php');
 
	$confirmar = isset($_GET["confirmar"]) ? $_GET["confirmar"] : null;
	$id_cliente = isset($_GET["id_cliente"]) ? $_GET["id_cliente"] : null;
    

    // Atualizar o campo 'servico' no banco de dados
    $sql = "UPDATE cliente SET confirmar = ? WHERE id_cliente = ?";
    $stmt = $conexao->prepare($sql);
    $stmt->bind_param("si", $confirmar, $id_cliente);

	if ($stmt->execute()) {
        echo "";
    } else {
        echo "" . $stmt->error;
    }
    $conexao->close();
}

?>



<header class="major">
	<h2> 🚨Importante: Não esqueça de confirmar o serviço escolhido!</h2> <br>					
</header>

<div class="form-con">

  <form method="GET" action='dados-cliente.php'>
  <input type="hidden" name="id_cliente" value="<?php echo isset($_GET['id_cliente']) ? htmlspecialchars($_GET['id_cliente']) : ''; ?>">
 <input type="radio" id="sim" name="confirmar" value="sim"> 
  <label for="sim">Confirmar agora</label><br>

  <input type="radio" id="nao" name="confirmar" value="nao"> 
  <label for="nao">Não Confirmar agora</label><br>

<input type="submit" name="submit" id="submit" value="enviar"> <p>

</form>

</div>

<style>
.form-con {
	color: #1075a9;
}
input[type="radio"] {
  display: none; 
}

input[type="radio"]:checked + label::before {
  content: "✔"; 
}


input[type="radio"] + label::before {
  content: "◯"; 
  margin-right: 5px;
  font-size: 20px;
}


label {
  cursor: pointer;
}


input[type="radio"]:checked + label::before {
  color: green;
}


input[type="radio"] + label::before {
  color: red; 
}


label {
  color: #333;
  margin-left: 5px;
}

</style>

<script>
  document.getElementById("submit").addEventListener("click", function() {
    if (document.getElementById("sim").checked) {
      alert("Serviço confirmado com sucesso!");
    } else if (document.getElementById("nao").checked) {
      alert("Você não confirmou nenhum serviço.");
    } else {
      alert("Por favor, selecione o serviço antes de confirmar.");
    }
  });
</script>


<br>


<!-- Importancia -->
								
<header class="major">
	<h2>O que posso fazer enquanto espero?</h2>						
</header>
<div class="row">
<div class="col-4 col-6-medium col-12-small">									
	<a href="#" class="image featured"><img src="imgs/lanchonete.png" alt="" /></a>
<header>
	<h3>Lanchonete</h3>
</header>
</div>

<div class="col-4 col-6-medium col-12-small">									
	<a href="#" class="image featured"><img src="imgs/sinuca.png" alt="" /></a>
<header>
	<h3>Sinuca</h3>
</header>
</div>

<div class="col-4 col-6-medium col-12-small">									
	<a href="#" class="image featured"><img src="imgs/salinha.png" alt="" /></a>
<header>
	<h3>Sala de espera</h3>
</header>
</div>

<div class="col-4 col-6-medium col-12-small">									
	<a href="#" class="image featured"><img src="imgs/cafe.png" alt="" /></a>
<header>
	<h3>Café</h3>
</header>
</div>

<div class="col-4 col-6-medium col-12-small">									
	<a href="#" class="image featured"><img src="imgs/sala.png" alt="" /></a>
<header>
	<h3>Sala de estudos</h3>
</header>
</div>

<div class="col-4 col-6-medium col-12-small">									
	<a href="#" class="image featured"><img src="imgs/ping.png" alt="" /></a>
<header>
	<h3>Ping-Pong</h3>
</header></div>

	<div class="col-12">
<br>

</section>                              

<!-- rodapé -->

  <style>
	.roda-pe{
		color: white;
		display: inline-block;
		width: 20%;
		vertical-align: top;
		list-style: none;

	}
	.titulo{
		color: #5d5d5d;
	}
	
	
	</style>
	
		<footer>
			<div class="roda-pe">
			
				<h2 class="titulo">Endereço
				<svg xmlns="http://www.w3.org/2000/svg" width="18" height="18" fill="currentColor" class="bi bi-geo-alt-fill" viewBox="0 0 16 16">
					<path d="M8 16s6-5.686 6-10A6 6 0 0 0 2 6c0 4.314 6 10 6 10zm0-7a3 3 0 1 1 0-6 3 3 0 0 1 0 6z"/>
				  </svg> </h2>
					<li> Avenida Alameda das Travessas </li>
					<li>  Bairro dos Barris</li>
					<li> CEP: 40000-000</li>
					<li> Brasília</li>
				</ul>
			</div>
	
			<div class="roda-pe">
				<h2 class="titulo">Serviços
				<svg xmlns="http://www.w3.org/2000/svg" width="18" height="18" fill="currentColor" class="bi bi-tools" viewBox="0 0 16 16">
					<path d="M1 0 0 1l2.2 3.081a1 1 0 0 0 .815.419h.07a1 1 0 0 1 .708.293l2.675 2.675-2.617 2.654A3.003 3.003 0 0 0 0 13a3 3 0 1 0 5.878-.851l2.654-2.617.968.968-.305.914a1 1 0 0 0 .242 1.023l3.27 3.27a.997.997 0 0 0 1.414 0l1.586-1.586a.997.997 0 0 0 0-1.414l-3.27-3.27a1 1 0 0 0-1.023-.242L10.5 9.5l-.96-.96 2.68-2.643A3.005 3.005 0 0 0 16 3c0-.269-.035-.53-.102-.777l-2.14 2.141L12 4l-.364-1.757L13.777.102a3 3 0 0 0-3.675 3.68L7.462 6.46 4.793 3.793a1 1 0 0 1-.293-.707v-.071a1 1 0 0 0-.419-.814L1 0Zm9.646 10.646a.5.5 0 0 1 .708 0l2.914 2.915a.5.5 0 0 1-.707.707l-2.915-2.914a.5.5 0 0 1 0-.708ZM3 11l.471.242.529.026.287.445.445.287.026.529L5 13l-.242.471-.026.529-.445.287-.287.445-.529.026L3 15l-.471-.242L2 14.732l-.287-.445L1.268 14l-.026-.529L1 13l.242-.471.026-.529.445-.287.287-.445.529-.026L3 11Z"/>
				  </svg></h2>
					<li> Lavagem</li>
					<li> Pintura</li>
					<li> Manutenção</li>
				</ul>
			</div>
			
			<div class="roda-pe">
				<h2 class="titulo">Contatos
				<svg xmlns="http://www.w3.org/2000/svg" width="18" height="18" fill="currentColor" class="bi bi-person-circle" viewBox="0 0 16 16">
					<path d="M11 6a3 3 0 1 1-6 0 3 3 0 0 1 6 0z"/>
					<path fill-rule="evenodd" d="M0 8a8 8 0 1 1 16 0A8 8 0 0 1 0 8zm8-7a7 7 0 0 0-5.468 11.37C3.242 11.226 4.805 10 8 10s4.757 1.225 5.468 2.37A7 7 0 0 0 8 1z"/>
				  </svg></h2>
	
				<a href="https://www.youtube.com/" target="_blank">
				<svg xmlns="http://www.w3.org/2000/svg" width="18" height="18" fill="currentColor" class="bi bi-youtube" viewBox="0 0 16 16">
					<path d="M8.051 1.999h.089c.822.003 4.987.033 6.11.335a2.01 2.01 0 0 1 1.415 1.42c.101.38.172.883.22 1.402l.01.104.022.26.008.104c.065.914.073 1.77.074 1.957v.075c-.001.194-.01 1.108-.082 2.06l-.008.105-.009.104c-.05.572-.124 1.14-.235 1.558a2.007 2.007 0 0 1-1.415 1.42c-1.16.312-5.569.334-6.18.335h-.142c-.309 0-1.587-.006-2.927-.052l-.17-.006-.087-.004-.171-.007-.171-.007c-1.11-.049-2.167-.128-2.654-.26a2.007 2.007 0 0 1-1.415-1.419c-.111-.417-.185-.986-.235-1.558L.09 9.82l-.008-.104A31.4 31.4 0 0 1 0 7.68v-.123c.002-.215.01-.958.064-1.778l.007-.103.003-.052.008-.104.022-.26.01-.104c.048-.519.119-1.023.22-1.402a2.007 2.007 0 0 1 1.415-1.42c.487-.13 1.544-.21 2.654-.26l.17-.007.172-.006.086-.003.171-.007A99.788 99.788 0 0 1 7.858 2h.193zM6.4 5.209v4.818l4.157-2.408L6.4 5.209z"/>
				  </svg> </a>Youtube <br>
	
				  <a href="https://www.instagram.com/" target="_blank">
				  <svg xmlns="http://www.w3.org/2000/svg" width="18" height="18" fill="currentColor" class="bi bi-instagram" viewBox="0 0 16 16">
					<path d="M8 0C5.829 0 5.556.01 4.703.048 3.85.088 3.269.222 2.76.42a3.917 3.917 0 0 0-1.417.923A3.927 3.927 0 0 0 .42 2.76C.222 3.268.087 3.85.048 4.7.01 5.555 0 5.827 0 8.001c0 2.172.01 2.444.048 3.297.04.852.174 1.433.372 1.942.205.526.478.972.923 1.417.444.445.89.719 1.416.923.51.198 1.09.333 1.942.372C5.555 15.99 5.827 16 8 16s2.444-.01 3.298-.048c.851-.04 1.434-.174 1.943-.372a3.916 3.916 0 0 0 1.416-.923c.445-.445.718-.891.923-1.417.197-.509.332-1.09.372-1.942C15.99 10.445 16 10.173 16 8s-.01-2.445-.048-3.299c-.04-.851-.175-1.433-.372-1.941a3.926 3.926 0 0 0-.923-1.417A3.911 3.911 0 0 0 13.24.42c-.51-.198-1.092-.333-1.943-.372C10.443.01 10.172 0 7.998 0h.003zm-.717 1.442h.718c2.136 0 2.389.007 3.232.046.78.035 1.204.166 1.486.275.373.145.64.319.92.599.28.28.453.546.598.92.11.281.24.705.275 1.485.039.843.047 1.096.047 3.231s-.008 2.389-.047 3.232c-.035.78-.166 1.203-.275 1.485a2.47 2.47 0 0 1-.599.919c-.28.28-.546.453-.92.598-.28.11-.704.24-1.485.276-.843.038-1.096.047-3.232.047s-2.39-.009-3.233-.047c-.78-.036-1.203-.166-1.485-.276a2.478 2.478 0 0 1-.92-.598 2.48 2.48 0 0 1-.6-.92c-.109-.281-.24-.705-.275-1.485-.038-.843-.046-1.096-.046-3.233 0-2.136.008-2.388.046-3.231.036-.78.166-1.204.276-1.486.145-.373.319-.64.599-.92.28-.28.546-.453.92-.598.282-.11.705-.24 1.485-.276.738-.034 1.024-.044 2.515-.045v.002zm4.988 1.328a.96.96 0 1 0 0 1.92.96.96 0 0 0 0-1.92zm-4.27 1.122a4.109 4.109 0 1 0 0 8.217 4.109 4.109 0 0 0 0-8.217zm0 1.441a2.667 2.667 0 1 1 0 5.334 2.667 2.667 0 0 1 0-5.334z"/>
				  </svg> </a> Instagram <br>
	
				  <a href="https://pt-br.facebook.com/" target="_blank">
					<svg xmlns="http://www.w3.org/2000/svg" width="18" height="18" fill="currentColor" class="bi bi-facebook" viewBox="0 0 16 16">
						<path d="M16 8.049c0-4.446-3.582-8.05-8-8.05C3.58 0-.002 3.603-.002 8.05c0 4.017 2.926 7.347 6.75 7.951v-5.625h-2.03V8.05H6.75V6.275c0-2.017 1.195-3.131 3.022-3.131.876 0 1.791.157 1.791.157v1.98h-1.009c-.993 0-1.303.621-1.303 1.258v1.51h2.218l-.354 2.326H9.25V16c3.824-.604 6.75-3.934 6.75-7.951z"/>
					  </svg> </a> Facebook <br>
	
				<a href="https://www.whatsapp.com/?lang=pt_br" target="_blank">
					<svg xmlns="http://www.w3.org/2000/svg" width="18" height="18" fill="currentColor" class="bi bi-whatsapp" viewBox="0 0 16 16">
						<path d="M13.601 2.326A7.854 7.854 0 0 0 7.994 0C3.627 0 .068 3.558.064 7.926c0 1.399.366 2.76 1.057 3.965L0 16l4.204-1.102a7.933 7.933 0 0 0 3.79.965h.004c4.368 0 7.926-3.558 7.93-7.93A7.898 7.898 0 0 0 13.6 2.326zM7.994 14.521a6.573 6.573 0 0 1-3.356-.92l-.24-.144-2.494.654.666-2.433-.156-.251a6.56 6.56 0 0 1-1.007-3.505c0-3.626 2.957-6.584 6.591-6.584a6.56 6.56 0 0 1 4.66 1.931 6.557 6.557 0 0 1 1.928 4.66c-.004 3.639-2.961 6.592-6.592 6.592zm3.615-4.934c-.197-.099-1.17-.578-1.353-.646-.182-.065-.315-.099-.445.099-.133.197-.513.646-.627.775-.114.133-.232.148-.43.05-.197-.1-.836-.308-1.592-.985-.59-.525-.985-1.175-1.103-1.372-.114-.198-.011-.304.088-.403.087-.088.197-.232.296-.346.1-.114.133-.198.198-.33.065-.134.034-.248-.015-.347-.05-.099-.445-1.076-.612-1.47-.16-.389-.323-.335-.445-.34-.114-.007-.247-.007-.38-.007a.729.729 0 0 0-.529.247c-.182.198-.691.677-.691 1.654 0 .977.71 1.916.81 2.049.098.133 1.394 2.132 3.383 2.992.47.205.84.326 1.129.418.475.152.904.129 1.246.08.38-.058 1.171-.48 1.338-.943.164-.464.164-.86.114-.943-.049-.084-.182-.133-.38-.232z"/>
					  </svg> </a> Whatsapp<br>
		
			</div>
			
			
			<div class="roda-pe">
				<h2 class="titulo">Sobre
				<svg xmlns="http://www.w3.org/2000/svg" width="18" height="18" fill="currentColor" class="bi bi-journal-bookmark-fill" viewBox="0 0 16 16">
					<path fill-rule="evenodd" d="M6 1h6v7a.5.5 0 0 1-.757.429L9 7.083 6.757 8.43A.5.5 0 0 1 6 8V1z"/>
					<path d="M3 0h10a2 2 0 0 1 2 2v12a2 2 0 0 1-2 2H3a2 2 0 0 1-2-2v-1h1v1a1 1 0 0 0 1 1h10a1 1 0 0 0 1-1V2a1 1 0 0 0-1-1H3a1 1 0 0 0-1 1v1H1V2a2 2 0 0 1 2-2z"/>
					<path d="M1 5v-.5a.5.5 0 0 1 1 0V5h.5a.5.5 0 0 1 0 1h-2a.5.5 0 0 1 0-1H1zm0 3v-.5a.5.5 0 0 1 1 0V8h.5a.5.5 0 0 1 0 1h-2a.5.5 0 0 1 0-1H1zm0 3v-.5a.5.5 0 0 1 1 0v.5h.5a.5.5 0 0 1 0 1h-2a.5.5 0 0 1 0-1H1z"/>
				  </svg></h2>
					<li>Somos uma empresa que busca o melhor para o seu veículo, contando com os melhores funcionários e equipamentos disponíveis no mercado. Nosso objetivo é proporcionar qualidade e eficiência em nossos serviços.</li>
				
			</ul>
		</footer>	
</div>

 
<!-- Scripts -->
	<script src="assets/js/jquery.min.js"></script>
	<script src="assets/js/jquery.dropotron.min.js"></script>
	<script src="assets/js/browser.min.js"></script>
	<script src="assets/js/breakpoints.min.js"></script>
	<script src="assets/js/util.js"></script>
	<script src="assets/js/main.js"></script>

	</body>
</html>