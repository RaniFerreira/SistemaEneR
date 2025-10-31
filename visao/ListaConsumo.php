<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <style>

    </style>
</head>
<body>
        <?php
			if(isset($status)){ echo "<H2>".$status."</H2>";}
			//Se $status está preenchida, imprimir ela
		?>

        <A href="Consumo.php?fun=cadastrar" > Cadastrar </A>
		<br /><br />
			
  
    <TABLE border="2px" width="350px">
        <TR> 
            <TH>ID Consumo</TH>
            <TH>ID Morador</TH>
            <TH>Data Leitura</TH>
            <TH>KWh</TH>  
           
        </TR>

        <?php
            foreach($lista as $c){  
                  
                echo "<TR>"; 
                echo "<TD><A href='Consumo.php?fun=exibir&id=". $c->getIdConsumo() . 
					      "'>" . $c->getIdMorador() . "</A></TD>";   

           
                echo "<TD>" . $c->getIdMorador() . "</TD>";
                echo "<TD>" . $c->getDataLeitura() . "</TD>";
                echo "<TD>" . $c->getKwh() . "</TD>";

                  
            }    
        ?>  
    </TABLE>
</BODY>
</HTML>

    
</body>
</html>