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
					if (isset($pessoa)) {echo "Alterar Pessoa: {$pessoa->primeiro_nome}";}
					else {echo "Cadastrar Pessoa";}
				?>
			</div>

		<div class="card-body">
			<form action="<?php echo $SITE_URL . "/modulo-pessoa/cadastro-pessoa.php"; ?>" id="form-cadastro" method="POST">

				<?php if (isset($pessoa)) { ?>
					<input type="hidden" name="id" value="<?php echo $pessoa->id; ?>">
				<?php } ?>

				<div class="form-row ">
					<div class="col-md-6">
						<label for="tipo_professor">
							<input name="tipo" id="tipo_professor" checked= 'true' type="radio" value="1" > Professor
						</label>
						<label for="tipo_aluno">
							<input name="tipo" id="tipo_aluno" type="radio" value="2" > Aluno
						</label>
						<br>
						<?php echo exibirErro($listaErros, 'tipo'); ?>
					</div>
				</div>

				<div class="form-group">
					<div class="form-row ">
						<div class="col-md-6">
							<label for="primeiro_nome">Primeiro Nome</label>
							<input class="form-control" name="primeiro_nome" id="primeiro_nome" placeholder="Primeiro nome " type="text" value="<?php echo ( isset($pessoa) ) ? $pessoa->primeiro_nome : (isset($_POST['primeiro_nome']) ? $_POST['primeiro_nome'] : ''); ?>" />
							<?php echo exibirErro($listaErros, 'primeiro_nome'); ?>
						</div>
						<div class="col-md-6">
							<label for="segundo_nome">Segundo Nome</label>
							<input class="form-control" name="segundo_nome" id="segundo_nome" placeholder="Sobrenome" type="text" value="<?php echo ( isset($pessoa) ) ? $pessoa->segundo_nome :(isset ($_POST['segundo_nome']) ? $_POST['segundo_nome'] : ''); ?>"/>
							<?php echo exibirErro($listaErros, 'segundo_nome'); ?>
						</div>
					</div>
					<div class="form-row ">
						<div class="col-md-8">
							<label for="email">E-mail</label>
							<input class="form-control" name="email" id="email" placeholder="email" type="email" value="<?php echo ( isset($pessoa) ) ? $pessoa->email :(isset ($_POST['email']) ? $_POST['email'] : ''); ?>"/>
							<?php echo exibirErro($listaErros, 'email'); ?>
						</div>
						<div class="col-md-4">
							<label for="cpf">CPF</label>
							<input class="form-control" name="cpf" id="cpf" placeholder="___.___.___-__" type="text" value="<?php echo ( isset($pessoa) ) ? adicionarMascaraCpf($pessoa->cpf) :(isset ($_POST['cpf']) ? adicionarMascaraCpf($pessoa->cpf) : ''); ?>"/>
							<?php echo exibirErro($listaErros, 'cpf'); ?>
						</div>
					</div>
					<div class="form-row ">
						<div class="col-sm-6" >
							<label for="data_nascimento">Data de Nascimento</label>
							<input type='text' class="form-control datepicker" autocomplete="disable" name="data_nascimento" id="data_nascimento" required placeholder="__/__/____" type="text" value="<?php echo ( isset($pessoa) ) ? $pessoa->data_nascimento :(isset ($_POST['data_nascimento']) ? $_POST['data_nascimento'] : ''); ?>"/>
							<?php echo exibirErro($listaErros, 'data_nascimento'); ?>
						</div>
						<div class="col-md-6">
							Sexo:<br>
							<label for="sexo_masculino">
								<input name="sexo" checked= 'true' id="sexo_masculino" type="radio" value="M" /> Masculino
							</label>
							<label for="sexo_feminino">
								<input name="sexo" id="sexo_feminino" type="radio" value="F" /> Feminino
							</label>
							<br>
							<?php echo exibirErro($listaErros, 'sexo'); ?>
						</div>
					</div>
					<div class="form-row ">
						<div class="col-md-8">
							<label for="endereco">Endereço</label>
							<input class="form-control" name="endereco" id="endereco" placeholder="Endereço" type="text" value="<?php echo ( isset($pessoa) ) ? $pessoa->endereco :(isset ($_POST['endereco']) ? $_POST['endereco'] : ''); ?>"/>
							<?php echo exibirErro($listaErros, 'endereco'); ?>
						</div>
						
						<div class="col-md-4">
							<label for="cep">CEP</label>
							<input class="form-control" name="cep" id="cep" placeholder="CEP" type="text" value="<?php echo ( isset($pessoa) ) ? $pessoa->cep :(isset ($_POST['cep']) ? $_POST['cep'] : ''); ?>"/>
							<?php echo exibirErro($listaErros, 'cep'); ?>
						</div>
					</div>
					<div class="form-row ">
						<div class="col-md-6">
							<label for="bairro">Bairro</label>
							<input class="form-control" name="bairro" id="bairro" placeholder="Bairro" type="text" value="<?php echo ( isset($pessoa) ) ? $pessoa->bairro :(isset ($_POST['bairro']) ? $_POST['bairro'] : ''); ?>"/>
							<?php echo exibirErro($listaErros, 'bairro'); ?>
						</div>
						<div class="col-md-6">
							<label for="numero">Numero</label>
							<input class="form-control" name="numero" id="numero" placeholder="Numero" type="text" value="<?php echo ( isset($pessoa) ) ? $pessoa->numero :(isset ($_POST['numero']) ? $_POST['numero'] : ''); ?>"/>
							<?php echo exibirErro($listaErros, 'numero'); ?>
						</div>
					</div>
					<div class="form-row ">
						<div class="col-md-6">
							<label for="cidade">Cidade</label>
							<select class="form-control" name="cidade" id="cidade" >
								<option value="">Selecione um estado</option>
							</select>
							<?php echo exibirErro($listaErros, 'cidade'); ?>
						</div>

						<div class="col-md-6">
							<label for="uf">Estado</label>
							<select class="form-control" name="uf" id="uf">
								<option value="">Selecione</option>
								<?php 
								foreach($listaUfs as $uf) {echo "<option value=\"{$uf->id}\">{$uf->nome} ({$uf->sigla})</option>";}
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

<?php include "../comum/footer.php"; /*?>


<script type="text/javascript">

	$(document).ready(function()
	{
		$('.datepicker').datepicker(
		{
			format:'dd/mm/yyyy',
			language:'pt-BR',
		}).mask('00/00/0000');
		
		$('#cpf').mask('000.000.000-00'); 

		$('#cep').mask('00000-000');

		$("#uf").on('change', function(){
			var selectUf = $(this); //pega o componente UF quando ele é modificado
			var ufId = selectUf.val(); //pega o valor do UF selecionado (value = id do estado)
			console.log(ufId);
			console.log("caraio3");

			if (ufId) 
			{
				var selectCidade = $('#cidade'); //pega o componente cidade
				var options = '<option value=\"\">Selecione um estado</option>'; //inicia o componente "options" com o valor "selecione"
				selectUf.attr('disabled', true); //altera o atributo HTML do componente selectUF para desabilitado, para que não possa alterar
				selectCidade.attr('disabled', true) //altera o atributo da Cidade para desabilitado
					.find('option:first')	//pega o primeiro valor de option do "componente select"
					.html('Buscando cidades...'); //escreve em cidade " buscando" para fazer de conta que está procurando

console.log("vai Chamar o AJAX");

				$.ajax(
				{ 
					url: '<?php echo $SITE_URL . "/modulo-pessoa/ajax.php"; ?>', //url que será chamada quando o UF for alterado
					dataType: 'json',		//tipo de "linguagem" será usada
					data: 					//oque será passado para o URL, "nome da chave:valor" pode passar mais de um valor
					{
						uf_id: ufId
					},
					success: function(dados) //executa havendo retorno OK do URL
						if (dados.length > 0)  //se tiver algo dentro de "dados"
						{
							for(var i=0; i < dados.length; i++)  //não existe FOREACH aqui pois é JavaScript tem que ser FOR mesmo //
							{
								//$("#cidade").append("<option value=\"" + dados[i].id + "\">" + dados[i].nome + "</option>") 	// outra forma de preencher as cidades.
								options += "<option value=\"" + dados[i].id + "\">" + dados[i].nome + "</option>"//adiciona, a cada passada, o id e o nome de cada cidade em uma linha de options
							}
						}
					},
					error: function(erro) // executa quando tem erros no retorno do url
					{
						console.log(erro);
					}
				}).always(function() //Sempre executa após retorno da URL
				{
					selectCidade.html(options); 			//pega o "objeto cidade"
					selectUf.attr('disabled', false); 		//habilita o "objeto estado"
					selectCidade.attr('disabled', false);	//habilita o "objeto cidade"
					if (options > 0) 
					{
						selectCidade.find('option:first').html('Selecione um estado');
					}
				});
			}
		});
	});
</script>

*/?>

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
			console.log("vai Chamar o AJAX");

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
						dd(ufId);
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
				});
				
			}
		});
	});
</script>