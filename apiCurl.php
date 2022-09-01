<?php
$erroCep="";
$location = "";
$ibge = "";
$cep = "";
$logradouro = "";
$complemento = "";
$bairro = "";
$uf = "";
$gia = "";
$ddd = "";
$siafi = "";
	if(empty($_GET['cep'])){
		$erroCep = "Porfavor digite um cep";
	}else{
		if(strlen($_GET['cep']) > 8){
			$erroCep = "Numero de cep precisa ter no maximo 8 digitos";
		}elseif(strlen($_GET['cep']) < 8){
			$erroCep = "Numero precisa ter 8 digitos";
		}else{
			$cep = $_GET['cep'];
			$ch = curl_init();
			curl_setopt($ch, CURLOPT_URL, "https://viacep.com.br/ws/$cep/json/");
			curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
			$retorno = curl_exec($ch);

			curl_close($ch);
			
			

			$dados = json_decode($retorno,true);
			if(isset($dados['erro'])){
				$erroCep = "Porfavor fale um cep valido";
			}else{
				$location = $dados['localidade'];
				$ibge = $dados['ibge'];
				$cep = $dados['cep'];
				$logradouro = $dados['logradouro'];
				$complemento = $dados['complemento'];
				$bairro = $dados['bairro'];
				$uf = $dados['uf'];
				$gia = $dados['gia'];
				$ddd = $dados['ddd'];
				$siafi = $dados['siafi'];

			}
			
		}


	}


?>

<!DOCTYPE html>
<html>
<head>
	<title>curl</title>
	<style type="text/css">
		*{
			font-family: sans-serif;
			margin: 0;
			padding: 0;
			box-sizing: border-box;
		}
		body{
			background: rgb(230,163,231);
background: linear-gradient(90deg, rgba(230,163,231,1) 0%, rgba(241,177,241,1) 50%, rgba(193,249,239,1) 100%);

		}
		.header{
			background: rgb(230,163,231);
background: linear-gradient(90deg, rgba(230,163,231,1) 0%, rgba(241,177,241,1) 50%, rgba(193,249,239,1) 100%);

			display: flex;
			height: 400px;
			justify-content: center;
			align-items: center;
			background-color: black;
		}
		.inputs{
			box-shadow: 5px 20px 10px white;
			background-color: white;
			align-items: center;
			display: flex;
			justify-content: center;
			height: 300px;
			width: 400px;
			border-radius: 20px;border:1px solid black;
			filter: blur(20p);
		}
		.input{
			width: 200px;
			height: 30px;
			border-radius: 10px;
			padding: 10px;
		}
		.butao{
			height: 30px;

		}
		span{
			color: white;
		}
		h1{
			display: block;
		}
		.pai{
			height: 500px;
			display: flex;
			justify-content: center;
			align-items: center;
		}
		.opc{
			height: 400px;
			width: 600px;
			background: rgb(170,223,250);
background: radial-gradient(circle, rgba(170,223,250,1) 0%, rgba(245,162,255,1) 93%, rgba(246,202,245,1) 100%);
			border:1px solid white;
			border-radius: 20px;
			padding: 30px;
			box-shadow: 0 0 20px black;
			transition: all 0.3s ease;
			overflow: auto;
			
		}
		@media(max-width: 600px){
			.opc{
				width: 400px;
				height: 400px;
			}
		}
		@media(max-width: 400px){
			.opc{
				font-size: 12px;
				width: 300px;
				height: 400px;
			}
		}
	</style>
	<meta name="viewport" content="width=device-width, initial-scale=1">

</head>
<body>

	<header class="header">
		<div class="inputs">	
			<form method="get">
				<label>
					Cep
				</label>
				<input class="input" type="number" name="cep">

				<button class="butao">Enviar</button>
			</form>
		</div>
	</header>
	<div class="pai">
		<div class="opc">
			<h1>Informações</h1>
			<?php
			if(strlen($erroCep)>0){
				echo " Erro: $erroCep";
			}else{
				echo "<p>localidade: $location</p>";
				echo "<p>ibge: $ibge</p>";
				echo "<p>logradouro: $logradouro</p>";
				echo "<p>cep: $cep</p>";
				echo "<p>complemento: $complemento</p>";
				echo "<p>bairro: $bairro</p>";
				echo "<p>ddd: $ddd</p>";
				echo "<p>uf: $uf</p>";
				echo "<p>gia: $gia</p>";
				echo "<p>siafi: $siafi</p>";
			}
			?>
			
		</div>
	</div>
</body>
</html>