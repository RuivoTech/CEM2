<!--
Author: Colorlib
Author URL: https://colorlib.com
License: Creative Commons Attribution 3.0 Unported
License URL: http://creativecommons.org/licenses/by/3.0/
-->
<!DOCTYPE html>
<html>
<head>
<meta charset="UTF-8">
<title>Inscri&ccedil;&otilde;es para eventos do CEM</title>
<meta name="viewport" content="width=device-width, initial-scale=1">
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<script type="application/x-javascript"> addEventListener("load", function() { setTimeout(hideURLbar, 0); }, false); function hideURLbar(){ window.scrollTo(0,1); } </script>
<!-- Custom Theme files -->
<link href="../css/inscricoes.css" rel="stylesheet" type="text/css" media="all" />
<!-- //Custom Theme files -->
<!-- web font -->
<link href="//fonts.googleapis.com/css?family=Roboto:300,300i,400,400i,700,700i" rel="stylesheet">
<!-- //web font -->
</head>
<body>
	<!-- main -->
	<div class="main-w3layouts wrapper">
		<h1>Inscrições para eventos do CEM</h1>
		<div class="main-agileinfo">
			<div class="agileits-top">
				<form action="http://<?php echo $_SERVER["HTTP_HOST"]; ?>/inscricoes/inscricao.php" method="post">
					<input class="text" type="text" name="nome" placeholder="Nome completo" required="">
					<select name="evento" required="">
						<option value="">Escolha um evento</option>
						<?php 
						require_once '../init.php';
						
						$sql = "SELECT * FROM eventos WHERE ativo = true";
						
						$PDO = db_connect();
                        $query = $PDO->prepare($sql);
                        if($query->execute()){
                            $dados = $query->fetchAll(PDO::FETCH_ASSOC);
                        }
                        
                        for ($i = 0; $i < count($dados); $i++) {
                            echo "<option value='" . $dados[$i]["id"] . "'>" . $dados[$i]["descricao"] . "</option>";                            
                        }
						?>
					</select>
					<input class="text email" type="email" name="email" placeholder="Email" required="">
					<input class="text" type="text" name="celular" placeholder="Celular" required="">
					<input type="submit" value="Inscrever-se" name="inscricao">
				</form>
				<p>
				<?php 
				if(filter_input(INPUT_GET, "m") == 2){
				    echo "Erro! Não foi possível realizar a inscrição.";
				}elseif(filter_input(INPUT_GET, "m") == 1){
				    echo "Inscrição realizada com sucesso!";
				}
				?></p>
			</div>
		</div>
		<ul class="colorlib-bubbles">
			<li></li>
			<li></li>
			<li></li>
			<li></li>
			<li></li>
			<li></li>
			<li></li>
			<li></li>
			<li></li>
			<li></li>
		</ul>
	</div>
	<!-- //main -->
</body>
</html>