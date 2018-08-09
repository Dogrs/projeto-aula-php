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
        		<i class="fa fa-user"></i>
				<?php
					if (isset($pessoa)) {echo "Alterar Pessoa: {$pessoa->nome}";}
					else {echo "Cadastrar Pessoa";}
				?>
			</div>

		<div class="card-body">
			<form action="<?php echo $SITE_URL . "/modulo-pessoa/cadastro-pessoa.php"; ?>" id="form-cadastro" method="POST">

				<?php if (isset($pessoa)) { ?>
					<input type="hidden" name="id" value="<?php echo $uf->id; ?>">
				<?php } ?>

				<div class="form-group">
					<div class="form-row ">
						<div class="col-md-6">
							<label for="primeiro_nome">Primeiro Nome</label>
							<input class="form-control" name="primeiro_nome" id="primeiro_nome" placeholder="Primeiro nome da pessoa" type="text" value="<?php echo ( isset($pessoa) ) ? $pessoa->primeiro_nome : ''; ?>" />
							<?php echo exibirErro($listaErros, 'primeiro_nome'); ?>
						</div>
						<div class="col-md-6">
							<label for="segundo_nome">Segundo Nome</label>
							<input class="form-control" name="segundo_nome" id="segundo_nome" placeholder="Segundo nome da pessoa" type="text" value="<?php echo ( isset($pessoa) ) ? $pessoa->segundo_nome : ''; ?>"/>
							<?php echo exibirErro($listaErros, 'segundo_nome'); ?>
						</div>
					</div>
					<div class="form-row ">
						<div class="col-md-8">
							<label for="email">E-mail</label>
							<input class="form-control" name="email" id="email" placeholder="email" type="text" value="<?php echo ( isset($pessoa) ) ? $pessoa->email : ''; ?>" />
							<?php echo exibirErro($listaErros, 'email'); ?>
						</div>
						<div class="col-md-4">
							<label for="cpf">CPF</label>
							<input class="form-control" name="cpf" id="cpf" placeholder="CPF" type="text" value="<?php echo ( isset($pessoa) ) ? $pessoa->cpf : ''; ?>"/>
							<?php echo exibirErro($listaErros, 'cpf'); ?>
						</div>
					</div>
					<div class="form-row ">
						<div class="col-md-6">
							<label for="data_nascimento">Data de Nascimento</label>
							<input class="form-control" name="data_nascimento" id="data_nascimento" placeholder="__/__/____" type="text" value="<?php echo ( isset($pessoa) ) ? $pessoa->data_nascimento : ''; ?>"/>
							<?php echo exibirErro($listaErros, 'data_nascimento'); ?>
						</div>
						<div class="col-md-6">
							<label for="tipo">Tipo</label>
							<select class="form-control" name="tipo" id="tipo" type="text" ?>" />
							<option value="">Selecione um tipo</option>
								<?php foreach ($pessoa as $pessoas) {echo "<option value=\"" . $pessoas->tipo . "\">" . $pessoas->tipo . "</option>";}?>
							</select>
							<?php echo exibirErro($listaErros, 'tipo'); ?>
							</div>
							</div>
					<div class="form-row ">
						<div class="col-md-8">
							<label for="endereco">Endereço</label>
							<input class="form-control" name="endereco" id="endereco" placeholder="Endereço" type="text" value="<?php echo ( isset($pessoa) ) ? $pessoa->endereco : ''; ?>" />
							<?php echo exibirErro($listaErros, 'endereco'); ?>
						</div>
						
						<div class="col-md-4">
							<label for="cep">CEP</label>
							<input class="form-control" name="cep" id="cep" placeholder="CEP" type="text" value="<?php echo ( isset($pessoa) ) ? $pessoa->cep : ''; ?>"/>
							<?php echo exibirErro($listaErros, 'cep'); ?>
						</div>
					</div>
					<div class="form-row ">
						<div class="col-md-6">
							<label for="bairro">Bairro</label>
							<input class="form-control" name="bairro" id="bairro" placeholder="Bairro" type="text" value="<?php echo ( isset($pessoa) ) ? $pessoa->bairro : ''; ?>" />
							<?php echo exibirErro($listaErros, 'bairro'); ?>
						</div>
						<div class="col-md-6">
							<label for="numero">Numero</label>
							<input class="form-control" name="numero" id="numero" placeholder="Numero" type="text" value="<?php echo ( isset($pessoa) ) ? $pessoa->numero : ''; ?>"/>
							<?php echo exibirErro($listaErros, 'numero'); ?>
						</div>
					</div>
					<div class="form-row ">
						<div class="col-md-6">
							<label for="cidade">Cidade</label>
							<input class="form-control" name="cidade" id="cidade" placeholder="Cidade" type="text" value="<?php echo ( isset($pessoa) ) ? $pessoa->cidade : ''; ?>" />
							<?php echo exibirErro($listaErros, 'cidade'); ?>
						</div>
						<div class="col-md-6">
							<label for="estado">Estado</label>
							<select class="form-control" name="estado" id="estado" type="text" ?>" />
							<option value="">Selecione um estado</option>
								<?php foreach ($listaUf as $uf) {echo "<option value=\"" . $uf->id . "\">" . $uf->nome . "</option>";}?>
							</select>
							<?php echo exibirErro($listaErros, 'estado'); ?>
						</div>
					</div>

				</div>
				
				<div class="form-group">
					<div class="form-row">
						<div class="col-md-12">
							<button class="btn btn-success" type="submit">Salvar</button>
							<a href="/modulo-pessoa/"	>
								<button type="button" class="btn btn-default">Cancelar</button>
							</a>
							<?php if (isset($mensagemSucesso) && $mensagemSucesso) 
								{ ?>
									<span class="text-success"> <?php echo $mensagemSucesso; ?> </span>
								<?php } ?>
							<?php 
								if (isset($mensagemErro) && $mensagemErro)
								{
									echo '<span class = "text-danger">'. $mensagemErro .'</span>';
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

<?php include "../comum/footer.php"; ?>