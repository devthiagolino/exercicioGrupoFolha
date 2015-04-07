<?php
	
	header('Content-Type: text/html; charset=utf-8');

	function calcularRestoString($string = false){

		$__valores = array();
		$__letras = array('A','B','C','D','E','F','G','H','I','J','K','L','M','N','O','P','Q','R','S','T','U','V','W','X','Y','Z');
		
		for($i = 0; $i <= 25; $i++){
			$__valores[$__letras[$i]] = $i+1;
		}
		
		if($string){
			$__str_in_array = str_split($string);
			if(is_array($__str_in_array) && count($__str_in_array)){
				$__total_letras = count($__str_in_array);
				$__total_multip = 1;
				for($i = 0; $i < $__total_letras; $i++){
					$__total_multip = $__total_multip * (int) $__valores[$__str_in_array[$i]];
				}
			}

			return $__total_multip % 45;

		}

		return false;

	}

	function compareCometaGrupo($cometaGrupo = array()){
		if(is_array($cometaGrupo) && count($cometaGrupo)){
			$html = '<table class="tg" style="undefined;table-layout: fixed;">';
			$html .= '<tr><thead><th>Cometa / Grupo</th><th>Resto Cometa</th><th>Resto Grupo</th><th>Vai?</th></thead></tr><tbody>';
			foreach ($cometaGrupo as $cometa => $grupo) {
				$totalCometa = calcularRestoString($cometa);
				$totalGrupo = calcularRestoString($grupo);
				$vaiOuNao = ($totalCometa == $totalGrupo) ? 'S' : 'N';
				$html .= '<tr>';
					$html .= "<td>{$cometa} / {$grupo}</td>";
					$html .= "<td>{$totalCometa}</td>";
					$html .= "<td>{$totalGrupo}</td>";
					$html .= "<td>{$vaiOuNao}</td>";
				$html .='</tr>';
			}
			$html .= '</tbody></table>';
			return $html;
		}
		return false;
	}


	$__compare = array(
		'HALLEY' => 'AMARELO',
		'ENCKE' => 'VERMELHO',
		'WOLF' => 'PRETO',
		'KUSHIDA' => 'AZUL',
	);

	echo compareCometaGrupo($__compare);


	if(isset($_GET['palavra']) && !empty($_GET['palavra'])){
		$retorno = false;

		$palavra = trim($_GET['palavra']);
		$__palavra_in_array = explode(',', $palavra);
		$comparar = array();
		if(is_array($__palavra_in_array)){
			$comparar[$__palavra_in_array[0]] = $__palavra_in_array[1];
			$retorno = compareCometaGrupo($comparar);
		}
	}
	
?>

<h3>Quer fazer o teste?</h3>
<p>Digite separado por vírgula o nome do "COMETA" e "GRUPO". Exemplo: HALLEY, AMARELO</p>	

<form action="ovni.php" method="get">
	<label for="string">
		Digite a palavra:
	</label>
	<input type="text" name="palavra" id="palavra">
	<button type="submit">Calcular Resto</button>
</form>

<?php if($retorno): ?>
	<hr>	
	<?php echo $retorno; ?>
<?php endif; ?>
<style type="text/css">
.tg  {border-collapse:collapse;border-spacing:0;border-color:#ccc;}
.tg td{font-family:Arial, sans-serif;font-size:14px;padding:10px 5px;border-style:solid;border-width:1px;overflow:hidden;word-break:normal;border-color:#ccc;color:#333;background-color:#fff;}
.tg th{font-family:Arial, sans-serif;font-size:14px;font-weight:normal;padding:10px 5px;border-style:solid;border-width:1px;overflow:hidden;word-break:normal;border-color:#ccc;color:#333;background-color:#f0f0f0;}
</style>