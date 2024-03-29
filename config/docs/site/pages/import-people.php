
<div class="col-sm-12 import-page-view">
	<h3>Importar personal</h3>
	<p>Seleccione el archivo para importar el personal, si no conoces la forma correcta de realizar la importacion puedes descargar el siguiente archivo y modificarlo.</p>
	
	<div class="col-sm-6">
		<a class="btn btn-sm btn-info" href="<?php echo url_site; ?>/config/docs/site/pages/templates/import-people.ods">Clic Aquí Para Descargar</a>
	</div>
	<div class="col-sm-6">
	
		<form method="POST" action="<?php echo url_site; ?>/api/plugins/excel-upload/personal-final.php" enctype="multipart/form-data" class="form">
			
			<div class="col-sm-4">
				<div class="form-groups">
					<div class="input-groups">
						<span class="input-group-btn">
							<span class="btn btn-sm btn-primary btn-file-image">
								<i class="fas fa-upload"></i> Subir <input required="true" name="file" type="file" >
							</span>
						</span>
					</div>
				</div>
			</div>
			<div class="col-sm-8">
				<button type="submit" name="Submit" class="btn btn-sm btn-success"> Comenzar</button>
			</div>
		</form>
	</div>
	<hr>
</div>
<div class="col-sm-12">
	<div class="container">
		<div class="row">
			<div class="panel panel-primary filterable">
				<div class="panel-heading">
					<h3 class="panel-title">Users</h3>
					<div class="pull-right">
						<button class="btn btn-default btn-xs btn-filter"><span class="glyphicon glyphicon-filter"></span> Filtrar</button>
						<a href="javascript:updateAllPeopleImport();" class="btn btn-default btn-xs btn-update-all"><span class="glyphicon-glyphicon-cloud-upload"></span> Actualizar Todo</a>
					</div>
				</div>
				<table class="table table-responsive">
					<thead>
						<tr class="filters">
							<th><input type="text" class="form-control" placeholder="#" disabled></th>
							<th><input type="text" class="form-control" placeholder="Usuario" disabled></th>
							<th><input type="text" class="form-control" placeholder="Nombre" disabled></th>
							<th><input type="text" class="form-control" placeholder="Cargo" disabled></th>
							<th><input type="text" class="form-control" placeholder="Piloto" disabled></th>
							<th><input type="text" class="form-control" placeholder="Estado" disabled></th>
							<th><input type="text" class="form-control" placeholder="Importar" disabled></th>
						</tr>
					</thead>
					<tbody class="people-body">
					</tbody>
				</table>
			</div>
		</div>
	</div>
</div>

<style>
.filterable {
    margin-top: 15px;
}
.filterable .panel-heading .pull-right {
    margin-top: -20px;
}
.filterable .filters input[disabled] {
    background-color: transparent;
    border: none;
    cursor: auto;
    box-shadow: none;
    padding: 0;
    height: auto;
}
.filterable .filters input[disabled]::-webkit-input-placeholder {
    color: #333;
}
.filterable .filters input[disabled]::-moz-placeholder {
    color: #333;
}
.filterable .filters input[disabled]:-ms-input-placeholder {
    color: #333;
}

</style>

<script>
/*
Please consider that the JS part isn't production ready at all, I just code it to show the concept of merging filters and titles together !
*/
$(document).ready(function(){
    $('.filterable .btn-filter').click(function(){
        var $panel = $(this).parents('.filterable'),
        $filters = $panel.find('.filters input'),
        $tbody = $panel.find('.table tbody');
        if ($filters.prop('disabled') == true) {
            $filters.prop('disabled', false);
            $filters.first().focus();
        } else {
            $filters.val('').prop('disabled', true);
            $tbody.find('.no-result').remove();
            $tbody.find('tr').show();
        }
    });

    $('.filterable .filters input').keyup(function(e){
        /* Ignore tab key */
        var code = e.keyCode || e.which;
        if (code == '9') return;
        /* Useful DOM data and selectors */
        var $input = $(this),
        inputContent = $input.val().toLowerCase(),
        $panel = $input.parents('.filterable'),
        column = $panel.find('.filters th').index($input.parents('th')),
        $table = $panel.find('.table'),
        $rows = $table.find('tbody tr');
        /* Dirtiest filter function ever ;) */
        var $filteredRows = $rows.filter(function(){
            var value = $(this).find('td').eq(column).text().toLowerCase();
            return value.indexOf(inputContent) === -1;
        });
        /* Clean previous no-result if exist */
        $table.find('tbody .no-result').remove();
        /* Show all rows, hide filtered ones (never do that outside of a demo ! xD) */
        $rows.show();
        $filteredRows.hide();
        /* Prepend no-result row if all rows are filtered */
        if ($filteredRows.length === $rows.length) {
            $table.find('tbody').prepend($('<tr class="no-result text-center"><td colspan="'+ $table.find('.filters th').length +'">No result found</td></tr>'));
        }
    });
});
</script>