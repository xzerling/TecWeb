
	<h1>Monitoreo de evaluaciones</h1>

	<div class="container">
		<table class="table">
			<thead>
				<tr>
					<th>Asignatura</th>
					<th>Seccion</th>
					<th>Fecha</th>
				</tr>
			</thead>
			<tbody>
				<? foreach($evaluadas as $row): ?>
				<tr bgcolor="#72ff67">
					
						<td> <? echo $row->nombre; ?> </td>
						<td> <? echo $row->seccion; ?> </td>
						<td> <? echo $row->fecha ?> </td>
				</tr>
				<? endforeach;?>
				<? foreach($pendientes as $row): ?>
					<tr bgcolor="fff667">
						<td> <? echo $row->nombre; ?> </td>
						<td> <? echo $row->seccion; ?> </td>
						<td> <? echo $row->fecha; ?> </td>
					</tr>
				<? endforeach;?>
				<? foreach($atrasadas as $row): ?>
					<tr bgcolor="ff7676">
						<td> <? echo $row->nombre; ?> </td>
						<td> <? echo $row->seccion; ?> </td>
						<td> <? echo $row->fecha; ?> </td>
					</tr>
				<? endforeach;?>
			</tbody>
		</table>
	</div>

</body>
</html>
