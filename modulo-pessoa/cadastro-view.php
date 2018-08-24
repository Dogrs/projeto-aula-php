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
			<?php if (isset($pessoa)) {
				echo "Alterar pessoa: {$pessoa->getNomeCompleto()}";
			} else {
				echo "Cadastrar pessoa";
			}
			?>
		</div>

		<div class="card-body">
			<form action="<?php echo $SITE_URL . "/modulo-pessoa/cadastro-pessoa.php"; ?>" id="form-cadastro" method="POST">
				<!-- O input hidden "id" serve para enviar o ID da pessoa que 
					estamos editando para o PHP saber qual registro ele precisa 
					alterar. 
				-->
				<?php
				
				if ($pessoa->id) { ?>
					<input type="hidden" name="id" value="<?php echo $pessoa->id; ?>" />
				<?php } ?>

				<div class="form-row ">
					<div class="col-md-6">
						<label for="tipo_professor">
							<input name="tipo" id="tipo_professor" type="radio" value="1" <?php echo ($pessoa->tipo == '1' ? 'checked' : '');?> > Professor
						</label>
						<label for="tipo_aluno">
							<input name="tipo" id="tipo_aluno" type="radio" value="2" <?php echo ($pessoa->tipo == '2' ? 'checked' : '');?> > Aluno
						</label>
						<br>
						<?php echo exibirErro($listaErros, 'tipo'); ?>
					</div>
				</div>
			
				<div class="form-group">
					<div class="form-row ">
						<div class="col-md-6">
							<label for="primeiro_nome">Primeiro nome</label>
							<input class="form-control" name="primeiro_nome" id="primeiro_nome" placeholder="Primeiro nome" type="text" value="<?php echo $pessoa->primeiro_nome; ?>"  />
							<?php echo exibirErro($listaErros, 'primeiro_nome'); ?>
						</div>
						<div class="col-md-6">
							<label for="segundo_nome">Sobrenome</label>
							<input class="form-control" name="segundo_nome" id="segundo_nome" placeholder="Sobrenome" type="text" value="<?php echo $pessoa->segundo_nome; ?>"  />
							<?php echo exibirErro($listaErros, 'segundo_nome'); ?>
						</div>
					</div>
				</div>

				<div class="form-group">
					<div class="form-row ">
						<div class="col-md-6">
							<label for="cpf">CPF</label>
							<input class="form-control" name="cpf" id="cpf" placeholder="___.___.___-__" type="text" value="<?php echo $pessoa->cpf; ?>"  />
							<?php echo exibirErro($listaErros, 'cpf'); ?>
						</div>
						<div class="col-md-6">
							Sexo:<br>
							<label for="sexo_masculino">
								<input name="sexo" id="sexo_masculino" type="radio" value="M" <?php echo ($pessoa->sexo == 'M' ? 'checked' : ''); ?> /> Masculino
							</label>
							<label for="sexo_feminino">
								<input name="sexo" id="sexo_feminino" type="radio" value="F" <?php echo ($pessoa->sexo == 'F' ? 'checked' : ''); ?> /> Feminino
							</label>
							<br>
							<?php echo exibirErro($listaErros, 'sexo'); ?>
						</div>
					</div>
				</div>

				<div class="form-group">
					<div class="form-row">
						<div class="col-md-6">
							<label for="email">Email</label>
							<input class="form-control" name="email" id="email" placeholder="email" type="email" value="<?php echo $pessoa->email; ?>"  />
							<?php echo exibirErro($listaErros, 'email'); ?>
						</div>
						<div class="col-md-6">
							<label for="data_nascimento">Data nascimento</label>
							<input class="form-control datepicker" name="data_nascimento" id="data_nascimento" placeholder="__/__/____" type="text" autocomplete="disable" value="<?php echo $pessoa->getDataNascimentoFormatada(); ?>"  />
							<?php echo exibirErro($listaErros, 'data_nascimento'); ?>
						</div>
					</div>				
				</div>
				
				<div class="form-group">
					<div class="form-row">
						<div class="col-md-6">
							<label for="endereco">Endereço</label>
							<input class="form-control" name="endereco" id="endereco" placeholder="Rua, logradouro..." type="text" value="<?php echo$pessoa->endereco; ?>"  />
							<?php echo exibirErro($listaErros, 'endereco'); ?>
						</div>
						<div class="col-md-6">
							<label for="bairro">Bairro</label>
							<input class="form-control" name="bairro" id="bairro" placeholder="Bairro" type="text" value="<?php echo $pessoa->bairro; ?>"  />
							<?php echo exibirErro($listaErros, 'bairro'); ?>
						</div>
					</div>				
				</div>

				<div class="form-group">
					<div class="form-row">
						<div class="col-md-6">
							<label for="numero">Número</label>
							<input class="form-control" name="numero" id="numero" placeholder="0000" type="text" value="<?php echo $pessoa->numero; ?>"  />
							<?php echo exibirErro($listaErros, 'numero'); ?>
						</div>
						<div class="col-md-6">
							<label for="cep">Cep</label>
							<input class="form-control" name="cep" id="cep" placeholder="_____-___" type="text" value="<?php echo $pessoa->cep; ?>"  />
							<?php echo exibirErro($listaErros, 'cep'); ?>
						</div>
					</div>				
				</div>

				<div class="form-group">
					<div class="form-row">
						<div class="col-md-6">
							<label for="uf">Estado</label>
							<select class="form-control" name="uf" id="uf">
								<option value="">Selecione</option>
								<?php 
								
								foreach($listaUfs as $uf) {
									$checked = '';
									if (isset($pessoa) && $uf->id == $pessoa->uf_id) {
										$checked = 'selected';
									}
									echo "<option {$checked} value=\"{$uf->id}\">{$uf->nome} ({$uf->sigla})</option>";
								}
								?>
							</select>
							<?php echo exibirErro($listaErros, 'uf'); ?>
						</div>
						<div class="col-md-6">
							<label for="cidade">Cidade</label>
							<select class="form-control" name="cidade" id="cidade" >
								<option value="">Selecione</option>
							</select>
							<?php echo exibirErro($listaErros, 'cidade'); ?>
						</div>
					</div>				
				</div>

					
				<div class="form-group">
					<div class="form-row">
						<div class="col-md-12">
							<button class="btn btn-success" type="submit">Salvar</button>
							<a href="/modulo-pessoa/">
								<button class="btn btn-default" type="button">Cancelar</button>
							</a>
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

<!-- O JS abaixo é utilizado somente nesta tela -->
<script type="text/javascript">
$(document).ready(function(){
	$('.datepicker').datepicker({
		format: 'dd/mm/yyyy',
		language: 'pt-BR'
	}).mask('00/00/0000');
	$('#cpf').mask('000.000.000-00');
	$('#cep').mask('00000-000');
	$("#uf").on('change', function(){
		var selectUf = $(this);
		var ufId = selectUf.val();
		if (ufId) {
			// Executa funcao Ajax para buscar todas as cidades do estado selecionado
		
			var selectCidade = $('#cidade');
			var options = '<option value=\"\">Selecione</option>';
			selectUf.attr('disabled', true);
			selectCidade
				.attr('disabled', true)
				.find('option:first')
				.html('Buscando cidades...');
			$.ajax({
				url: '<?php echo $SITE_URL . "/modulo-pessoa/ajax.php"; ?>',
				dataType: 'json',
				data: {
					uf_id: ufId
				},
				success: function(dados) {
					
					if (dados.length > 0) {
						for(var i=0; i < dados.length; i++) {
							// Forma de preencher as cidades mais ineficiente.
							//$("#cidade").append("<option value=\"" + dados[i].id + "\">" + dados[i].nome + "</option>")
							options += "<option value=\"" + dados[i].id + "\">" + dados[i].nome + "</option>"
						}
					}
				},
				error: function(erro) {
					console.log(erro);
				}
			}).always(function() {
				selectCidade.html(options);
				selectUf.attr('disabled', false);
				selectCidade.attr('disabled', false);
				if (options > 0) {
					selectCidade.find('option:first').html('Selecione');
				}
				<?php
				if (isset($pessoa) && $pessoa->cidade_id) {
					?>
					var cidadeId = "<?php echo $pessoa->cidade_id; ?>";
					$("#cidade").val(cidadeId);
					<?php
				}
				?>
			});
		}
	}).change();
});
</script>