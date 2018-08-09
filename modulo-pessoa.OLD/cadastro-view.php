<?php 
	include "../comum/head.php"; //volta uma pasta da atual entra no diretorio comum e le o head
	include "../comum/side-menu.php";
?>

<?php /* INICIO CONTEUDO */ ?>

<div class="content-wrapper">
	<div class="container-fluid">

		<?php include "../comum/migalhas.php"; ?>

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
								foreach ($listaUf as $uf) {
									echo "<option value=\"" . $uf->id . "\">" . $uf->nome . "</option>";
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
<?php /* FIM CONTEUDO */ ?>

<?php include "../comum/footer.php"; ?>