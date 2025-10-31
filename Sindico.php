<?php


	if(isset($_GET["fun"])){

		$fun = $_GET["fun"];
		
		if($fun == "cadastrar"){
			
			include_once(__DIR__ . "/controle/sindicoControle/CadastrarSindico_class.php");

			$pag = new CadastrarSindico();
			
		}
	
	}
	
	
?>