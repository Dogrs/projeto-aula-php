<?php include "config.php"; ?>

<?php

session_start();


if (!key_exists('cadastro_alunos', $_SESSION)) {
	$_SESSION['cadastro_alunos'] = array();
}


if ($_SERVER['REQUEST_METHOD'] == 'POST') {
	
	print_r($_POST);
}



$listaEstados = array(
	'AC'=>'Acre',
	'AL'=>'Alagoas',
	'AP'=>'Amapá',
	'AM'=>'Amazonas',
	'BA'=>'Bahia',
	'CE'=>'Ceará',
	'DF'=>'Distrito Federal',
	'ES'=>'Espírito Santo',
	'GO'=>'Goiás',
	'MA'=>'Maranhão',
	'MT'=>'Mato Grosso',
	'MS'=>'Mato Grosso do Sul',
	'MG'=>'Minas Gerais',
	'PA'=>'Pará',
	'PB'=>'Paraíba',
	'PR'=>'Paraná',
	'PE'=>'Pernambuco',
	'PI'=>'Piauí',
	'RJ'=>'Rio de Janeiro',
	'RN'=>'Rio Grande do Norte',
	'RS'=>'Rio Grande do Sul',
	'RO'=>'Rondônia',
	'RR'=>'Roraima',
	'SC'=>'Santa Catarina',
	'SP'=>'São Paulo',
	'SE'=>'Sergipe',
	'TO'=>'Tocantins'
);

$listaCidades = array(
	'RS' => array(
		1 => "Alegrete",
		2 => "Porto Alegre",
		3 => "Caxias do Sul",
		4 => "São Leopoldo",
		5 => "Farroupilha",
		6 => "Flores da Cunha",
		7 => "Nova Roma do Sul",
		8 => "Canoas",
		9 => "Viamão",
		10 => "Bento Gonçalves",
	),
	'SC' => array(
		1 => "Florianópolis",
		2 => "Lages",
		3 => "Joinville",
		4 => "São José",
		5 => "Palhoça",
		6 => "Blumenau",
	)
)

?>

<!DOCTYPE html>
<html lang="en">

<head>
	<meta charset="utf-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
	<meta name="description" content="">
	<meta name="author" content="roberzguerra@gmail.com">
	<title>Meu Site</title>

	<!-- Bootstrap core CSS-->
	<link href="<?php echo $SITE_URL . "/static/vendor/bootstrap/css/bootstrap.css"; ?>" rel="stylesheet" type="text/css">
	<!-- Custom fonts for this template-->
	<link href="<?php echo $SITE_URL . "/static/vendor/font-awesome/css/font-awesome.css"; ?>" rel="stylesheet" type="text/css">
	<!-- Custom styles for this template-->
	<link href="<?php echo $SITE_URL . "/static/css/sb-admin.css" ?>" rel="stylesheet">
</head>
<body class="fixed-nav sticky-footer bg-dark" id="page-top">

 

<div class="content-wrapper">
	<div class="container-fluid">

		<?php /* MIGALHAS */ ?>
		<ol class="breadcrumb">
			<li class="breadcrumb-item">
				<a href="#">Home</a>
			</li>
		</ol>
		<h1>Página Inicial</h1>
		<hr>


	   
	<table class="table table-striped table-hover">
		<thead>
			<tr>
				<th>ID</th>
				<th>Nome</th>
			</tr>
		</thead>
		<tbody>
			<tr>
				<td>1000</td>
				<td>Rober Guerra</td>
			</tr>
			<tr>
				<td>2000</td>
				<td>João Silva</td>
			</tr>
		</tbody>
	</table>

	<div class="card">
		<div class="card-header">
        	<i class="fa fa-table"></i> Cadastro de Alunos
		</div>

		<div class="card-body">

			<form action="" id="form-cadastro" method="POST">

				<div class="form-group">
					<div class="form-row">
						<div class="col-md-6">
							<label for="nome">Nome completo</label>
							<input class="form-control" name="nome" id="nome" placeholder="Nome completo" type="text" />
						</div>
						<div class="col-md-6">
							<label for="email">Email</label>
							<input class="form-control" name="email" id="email" placeholder="Email" type="text" />
						</div>
					</div>
				</div>

				<div class="form-group">
					<div class="form-row">
						<div class="col-md-6">
							<label>Sexo</label>
							<div class="radio">
								<label>
									<input name="sexo" id="sexo_masculino" value="M" type="radio"> Masculino
									Masculino
								</label>
							</div>
							<div class="radio">
								<label>
									<input name="sexo" id="sexo_feminino" value="F" type="radio"> Feminino
									Feminino
								</label>
							</div>
						
						</div>
						<div class="col-md-6">
							<label for="data_nascimento">Data de Nascimento</label>
							<input class="form-control" name="data_nascimento" id="data_nascimento" placeholder="__/__/____" type="text" />
						</div>
					</div>
				</div>

				<div class="form-group">
					<div class="form-row">
						<div class="col-md-6">
							<label for="uf">Estado</label>
							<select class="form-control" name="uf" id="uf">
								<option>Selecione um estado</option>
								<?php
									foreach($listaEstados as $siglaUf => $nomeUf) {
										echo "<option value=\"" . $siglaUf . "\" >" . $nomeUf . "</option>";
									}
								?>
							</select>
						</div>
						<div class="col-md-6">
							<label for="cidade">Cidade</label>
							<select class="form-control" name="uf" id="uf">

							</select>
						</div>
					</div>
				</div>
					
				<div class="form-group">
					<div class="form-row">
						<div class="col-md-12">
							<button class="btn btn-success" type="submit">Salvar</button>
						</div>
					</div>
				</div>
				
			</form>
		</div>

	</div>
</div>

<footer class="sticky-footer">
	<div class="container">
		<div class="text-center">
			<small>Meu Site 2018</small>
		</div>
	</div>
</footer>

<!-- Modal -->
<div class="modal fade" id="modalRemover" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
	<div class="modal-dialog" role="document">
		<div class="modal-content">
			<div class="modal-header">
				<h4 class="modal-title" id="modalRemoverTitle">Remover registro</h4>
				<button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
			</div>
			<div class="modal-body">

			</div>
			<div class="modal-footer">
				<form method="post" class="modal-form" action="">
					<input type="hidden" name="id" class="input-id" value="" />
					<button type="button" class="btn btn-default" data-dismiss="modal">Cancelar</button>
					<button type="submit" class="btn btn-danger btn-remover">Sim, remover</button>
				</form>
			</div>
		</div>
	</div>
</div>


<script src="<?php echo $SITE_URL . "/static/vendor/jquery/jquery.min.js"; ?>"></script>
<script src="<?php echo $SITE_URL . "/static/vendor/bootstrap/js/bootstrap.bundle.min.js"; ?>"></script>
<script src="<?php echo $SITE_URL . "/static/vendor/jquery-easing/jquery.easing.min.js"; ?>"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery.mask/1.14.15/jquery.mask.min.js"></script>
<script src="<?php echo $SITE_URL . "/static/js/sb-admin.min.js" ?>"></script>

<script type="text/javascript">
/*
	$('#toggleNavPosition').click(function () {
		$('body').toggleClass('fixed-nav');
		$('nav').toggleClass('fixed-top static-top');
	});

	$('#toggleNavColor').click(function () {
		$('nav').toggleClass('navbar-dark navbar-light');
		$('nav').toggleClass('bg-dark bg-light');
		$('body').toggleClass('bg-dark bg-light');
	});

	$(document).ready(function(){

		$('.table .btn-remover').on('click', function() {
			var $btn = $(this);
			var id = $btn.attr('data-id');
			var url = $btn.attr('data-url');

			var $modal = $('#modalRemover');
			var nome = $('.table #table_tr_' + id + ' .table-item-name').text();
			$modal.find('.modal-title').html("Remover registro");
			$modal.find('.modal-body').html("Deseja remover o registro <strong>" + nome +"</strong>?");
			$modal.find('.modal-form').attr('action', url);
			$modal.find('.input-id').val(id);

			$modal.modal('show');
		});


		var $price = $('.input-decimal');
		if ($price.length) {
			$price.mask("###0,00", {
				clearIfNotMatch: true,
				reverse: true,
			});
		}

	})
*/
</script>

	
</body>
