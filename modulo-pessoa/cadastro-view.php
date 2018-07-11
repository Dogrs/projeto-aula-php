<?php

$listaUfs = [
	'RS' => 'Rio Grande do Sul',
	'SC' => 'Santa Catarina',
	'PR' => 'Paraná',
];


$listaCidades = [
	'RS' => [
		'Caxias do Sul',
		'Porto Alegre',
	],
	'SC' => [
		'Florianópolis',
		'Lages'
	],
	'PR' => [
		'Curitiba',
		'Cascavel',
	]
];

?>

<!DOCTYPE html>
<html lang="en">

<head>
	<meta charset="utf-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
	<meta name="description" content="">
	<title>Meu Site</title>

	<!-- Bootstrap core CSS-->
	<link href="<?php echo $SITE_URL . "/static/vendor/bootstrap/css/bootstrap.css"; ?>" rel="stylesheet" type="text/css">
	<!-- Custom fonts for this template-->
	<link href="<?php echo $SITE_URL . "/static/vendor/font-awesome/css/font-awesome.css"; ?>" rel="stylesheet" type="text/css">
	<!-- Custom styles for this template-->
	<link href="<?php echo $SITE_URL . "/static/css/sb-admin.css" ?>" rel="stylesheet">
</head>
<body class="fixed-nav sticky-footer bg-dark" id="page-top">

<?php /* INICIO MENU PRINCIPAL */ ?>
    <nav class="navbar navbar-expand-lg navbar-dark bg-dark fixed-top" id="mainNav">
        <a class="navbar-brand" href="index.html">Start Bootstrap</a>
        <button class="navbar-toggler navbar-toggler-right" type="button" data-toggle="collapse"
                data-target="#navbarResponsive" aria-controls="navbarResponsive" aria-expanded="false"
                aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarResponsive">
            <ul class="navbar-nav navbar-sidenav" id="exampleAccordion">
                <li class="nav-item" data-toggle="tooltip" data-placement="right" title="Dashboard">
                    <a class="nav-link" href="/">
                        <i class="fa fa-fw fa-user"></i>
                        <span class="nav-link-text">Cadastro de Pessoas</span>
                    </a>
                </li>
                <li class="nav-item" data-toggle="tooltip" data-placement="right" title="Dashboard">
                    <a class="nav-link" href="/">
                        <i class="fa fa-fw fa-list"></i>
                        <span class="nav-link-text">Lista de Pessoas</span>
                    </a>
                </li>
            </ul>

            <ul class="navbar-nav sidenav-toggler">
                <li class="nav-item">
                    <a class="nav-link text-center" id="sidenavToggler">
                        <i class="fa fa-fw fa-angle-left"></i>
                    </a>
                </li>
            </ul>
            <ul class="navbar-nav ml-auto">
                <li class="nav-item">
                    <a class="nav-link" data-toggle="modal" data-target="#exampleModal">
                        <i class="fa fa-fw fa-sign-out"></i>Sair</a>
                </li>
            </ul>
        </div>
    </nav>
    <?php /* FIM MENU PRINCIPAL */ ?>

<div class="content-wrapper">
	<div class="container-fluid">

		<?php /* MIGALHAS */ ?>
		<ol class="breadcrumb">
			<li class="breadcrumb-item">
				<a href="#">Home</a>
			</li>
		</ol>

	<div class="card">
		<div class="card-header">
        	<i class="fa fa-user"></i> Cadastro de Pessoa
		</div>

		<div class="card-body">

			<form action="<?php echo $SITE_URL . "/modulo-pessoa/cadastro-pessoa.php"; ?>" id="form-cadastro" method="POST">

				<div class="form-group">
					<div class="form-row ">
						<div class="col-md-6">
							<label for="nome">Nome completo</label>
							<input class="form-control" name="nome" id="nome" placeholder="Nome completo" type="text" />
							<?php
							/* Validação do input nome (este codigo foi passado para a função exibirErro) */
							if ( isset($listaErros['nome']) && $listaErros['nome'] ) {
								?>
								<span class="text-danger"><?php echo $listaErros['nome']; ?></span>
								<?php
							}
							?>
						</div>
						<div class="col-md-6">
							<label for="email">Email</label>
							<input class="form-control" name="email" id="email" placeholder="Email" type="text" />
							<?php echo exibirErro($listaErros, 'email'); ?>
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
							<?php echo exibirErro($listaErros, 'sexo'); ?>
						</div>
						<div class="col-md-6">
							<label for="data_nascimento">Data de Nascimento</label>
							<input class="form-control" name="data_nascimento" id="data_nascimento" placeholder="__/__/____" type="text" />
							<?php echo exibirErro($listaErros, 'data_nascimento'); ?>
						</div>
					</div>
				</div>

				<div class="form-group">
					<div class="form-row">
						<div class="col-md-6">
							<label for="uf">Estado</label>
							<select class="form-control" name="uf" id="uf" >
								<option value="">Selecione um estado</option>
								<?php
								// ForEach
								foreach ($listaUfs as $key => $uf) {
									echo "<option value=\"" . $key . "\">" . $uf . "</option>";
								}

								// For tradicional
								/*for ($i=0; $i < count($listaUfs); $i++) {
									echo "<option>" . $listaUfs[$i] . "</option>";
								}*/
								?>
							</select>
							<?php echo exibirErro($listaErros, 'uf'); ?>
						</div>
						<div class="col-md-6">
							<label for="cidade">Cidade</label>
							<select class="form-control" name="cidade" id="cidade">
								<option value="">Selecione uma cidade</option>
								<?php
								foreach($listaCidades as $siglaUf => $listaNomesCidades) {

									foreach($listaNomesCidades as $nomeCidade) {
										echo "<option value='$nomeCidade'  data-uf='$siglaUf'>" . $nomeCidade . "</option>";
									}

								}
								?>
							</select>
							<?php echo exibirErro($listaErros, 'cidade'); ?>
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
<script src="<?php echo $SITE_URL . "/static/js/sb-admin.min.js"; ?>"></script>
<script src="<?php echo $SITE_URL . "/static/js/home.js"; ?> "></script>
	
</body>
