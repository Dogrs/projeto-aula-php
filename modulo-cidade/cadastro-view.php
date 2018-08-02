<?php
include "../comum/head.php";
include "../comum/side-menu.php";
?>

<?php /* INICIO CONTEUDO */ ?>
<div class="content-wrapper">
	<div class="container-fluid">

	<?php
	include "../comum/migalhas.php";
	?>

	<div class="card">
		<div class="card-header">
        	<i class="fa fa-user"></i> 
			<?php 
			if (isset($cidade)) { 
				echo "Alterar cidade: {$cidade->nome}";
			} else {
				echo "Cadastrar cidade";
			}	
			?>
		</div>

		<div class="card-body">
			<form action="<?php echo $SITE_URL . "/modulo-cidade/cadastro-cidade.php"; ?>" id="form-cadastro" method="POST">
				
				<?php if (isset($cidade)) { ?>
					<input type="hidden" name="id" value="<?php echo $cidade->id; ?>">
				<?php } ?>
				
				<div class="form-group">
					<div class="form-row ">
						<div class="col-md-6">
							<label for="nome">Nome</label>
							<input class="form-control" name="nome" id="nome" placeholder="Nome da cidade" type="text" value="<?php echo ( isset($cidade) ) ? $cidade->nome : ''; ?>" />
							<?php
							/*
							// O codigo PHP dentro do atributo VALEU do input acima, 
							//   equivale ao IF comentado abaixo.
							if ( isset($cidade) ) {
								echo $cidade->nome;
							} else {
								echo '';
							}
							*/
							/* Validação do input nome (este codigo foi passado para a função exibirErro) */
							if ( isset($listaErros['nome']) && $listaErros['nome'] ) {
								?>
								<span class="text-danger"><?php echo $listaErros['nome']; ?></span>
								<?php
							}
							?>
						</div>
						<div class="col-md-6">

							<label for="uf">Estado</label>
							<select class="form-control" name="uf" id="uf" >
								<option value="">Selecione um estado</option>
								<?php
								// ForEach
								foreach ($listaUf as $uf) {
									$checked = '';
									if (isset($cidade) && $cidade->uf_id == $uf->id) {
										$checked = "selected";
									}
									echo "<option {$checked} value=\"{$uf->id}\"> {$uf->nome} ({$uf->sigla})</option>";
									//echo "<option " . $checked . " value=\"" . $uf->id . "\">" . $uf->nome . " (" .$uf->sigla . ")" . "</option>";
								}
								// For tradicional
								/*for ($i=0; $i < count($listaUfs); $i++) {
									echo "<option>" . $listaUfs[$i] . "</option>";
								}*/
								?>
							</select>
							<?php echo exibirErro($listaErros, 'uf'); ?>
						</div>
						
					</div>
				</div>
					
				<div class="form-group">
					<div class="form-row">
						<div class="col-md-12">
							<button class="btn btn-success" type="submit">Salvar</button>
							<a href="/modulo-cidade/">
								<button type="button" class="btn btn-default">Cancelar</button>
							</a>
							<?php if (isset($mensagemSucesso) && $mensagemSucesso) { ?>
								<span class="text-success"><?php echo $mensagemSucesso; ?></span>
							<?php } ?>
							
							<?php
								if (isset($mensagemErro) && $mensagemErro) {
									echo '<span class="text-danger">' . $mensagemErro . '</span>';
								}
							?>
						</div>
					</div>
				</div>
				
			</form>
		</div>

	</div>
</div>
<?php /* FIM CONTEUDO */ ?>

<?php
include "../comum/footer.php";
?>