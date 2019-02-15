<?php include_once("conexao.php");


//Verifica se está sendo passado na URL a página atual, senao é atribuido a pagina 
$pagina = (isset($_GET['pagina']))? $_GET['pagina'] : 1;

//seleciona os arquivos tabela
$result_nome = "SELECT * FROM paginacao";
$resultado_nome = mysqli_query($conn, $result_nome);

//Conta o total de reg
$total_nome = mysqli_num_rows($resultado_nome);

//Seta a quantidade de registros
$quantidade_pg = 6;

//calcular o número de pagina necessárias para apresentar os cursos
$num_pagina = ceil($total_nome/$quantidade_pg);

//Calcula o inicio da visualizacao
$incio = ($quantidade_pg*$pagina)-$quantidade_pg;

//Selecionar os registros a serem apresentado na página
$result_nome = "SELECT * FROM paginacao limit $incio, $quantidade_pg";
$resultado_nome = mysqli_query($conn, $result_nome);
$total_nome  = mysqli_num_rows($resultado_nome);
?>

<!DOCTYPE html>
<html lang="pt-br">
	<head>
		<meta charset="utf-8">
		<meta http-equiv="X-UA-Compatible" content="IE=edge">
		<meta name="viewport" content="width=device-width, initial-scale=1">
		<title>Criar pagina com abas</title>
		<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css" integrity="sha384-BVYiiSIFeK1dGmJRAkycuHAHRg32OmUcww7on3RYdg4Va+PmSTsz/K68vbdEjh4u" crossorigin="anonymous">

	</head>
	<body>
		<div class="container theme-showcase" role="main">
			<div class="page-header">
				<h1>Nomes</h1>
			</div>
			
				<?php while($rows_nome = mysqli_fetch_assoc($resultado_nome)){ 
					
						 echo $rows_nome['id']."<br>"; 
                       echo $rows_nome['nome']."<br><hr>"; 
							
							
                 } 
                 
				//Verificar a pagina anterior e posterior
				$pagina_anterior = $pagina - 1;
                $pagina_posterior = $pagina + 1;
                
            ?>
            <nav class="text-center">
				<ul class="pagination">
					<li>
						<?php
						if($pagina_anterior != 0){ ?>
							<a href="index.php?pagina=<?php echo $pagina_anterior; ?>" aria-label="Previous">
								<span aria-hidden="true">&laquo;</span>
							</a>
						<?php }else{ ?>
							<span aria-hidden="true">&laquo;</span>
					<?php }  ?>
					</li>
					<?php 
					//Apresentar a paginacao
					for($i = 1; $i < $num_pagina + 1; $i++){ ?>
						<li><a href="index.php?pagina=<?php echo $i; ?>"><?php echo $i; ?></a></li>
					<?php } ?>
					<li>
						<?php
						if($pagina_posterior <= $num_pagina){ ?>
							<a href="index.php?pagina=<?php echo $pagina_posterior; ?>" aria-label="Previous">
								<span aria-hidden="true">&raquo;</span>
							</a>
						<?php }else{ ?>
							<span aria-hidden="true">&raquo;</span>
					<?php }  ?>
					</li>
				</ul>
			</nav>
		</div>
		
		
		<!-- jQuery (necessary for Bootstrap's JavaScript plugins) -->
		<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.3/jquery.min.js"></script>
		<!-- Include all compiled plugins (below), or include individual files as needed -->
		