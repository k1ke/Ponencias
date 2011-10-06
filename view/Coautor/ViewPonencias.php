<?php global $ponencias;?>


<p>Seleccione el recuadro de la(s) ponencia(s) en la(s) que usted participo</p>

<!--Definir action-->
<form id="list" name="deleteItems" action="" method="post">
	<table>
	<tr>
		<th colspan="3" class="tablebar"></th>
		<th colspan="4" class="tablebar">
			<ul class="inlinelist">
				<li id="count2"><b>1 - <?=count( $ponencias )?> de <?=count( $ponencias )?></b></li>
			</ul>
		</th>
	</tr>
	<tr>
		<th id="header" style="text-align: center">ID</th>
		<th id="header"><input value="" name="select_all" onclick="cbTbl.selectAll(this); updateDeleteButtons(this);" type="checkbox"></th>
		<th id="header">Titulo</th>
		<th id="header">Eje tematico</th>
		<th id="header">Lugar</th>
		<th id="header">Fecha</th>
	</tr>
	<?php for( $i = 0, $subtotal = 0; $i < count($ponencias); $i++){?>
	<tr class="" id="ARTICLE_COLLECTION_SELECTION_<?=$i?>">
		<td style="width: 30px;text-align: center"><?=$ponencias[$i]->getId()?></td>
		<td style="width: 40px"><input value="true"
			name="COLLECTION_SELECTION_<?=$i?>.<?=base64_encode($ponencias[$i]->getId())?>"
			onclick="cbTbl.selectOne(this); updateDeleteButtons(this);"
			type="checkbox"></td>
		<td><a href="javascript:void(0)"
			onclick="goto( 'EvaluatePonencia.php?id=<?=$ponencias[$i]->getId()?>&action=view' );"><?=$ponencias[$i]->getTitulo()?></a></td>
		<!--arriba en "goto" se pretende que se vea la ponencia como cuando se va a evaluar una ponencia
		obviamente con sus modificaciones pero quiza con la misma estructura-->
		<td><?=$ponencias[$i]->getEjeTematico()?></td>
		<td><?=$ponencias[$i]->getSala()?></td>
		<td><?=$ponencias[$i]->getFecha()?></td>
	</tr>
	<?php }
	if( $i == 0 ){ ?>
		<tr class="" id="ARTICLE_COLLECTION_SELECTION_0">
			<td colspan="7" align="center">
				<em>No tiene ninguna ponencia asiganda para evaluación</em>
			</td>
		</tr>
	<?php } ?>

	<tr>
		<th colspan="3" class="tablebar"></th>
		<th colspan="4" class="tablebar">
			<ul class="inlinelist">
				<li id="count"><b>1 - <?=count( $ponencias )?> de <?=count( $ponencias )?></b></li>
			</ul>
		</th>
	</tr>
	</table>
	<input type="submit" value="Confirmar Participacion">
	
</form>
