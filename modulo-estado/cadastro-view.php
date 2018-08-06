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
				if (isset($estado)) {echo "Alterar Estado: {$estado->nome}";}
				else {echo "Cadastrar Estado";}
				?>
			</div>

		<div class="card-body">
			<form action="<?php echo $SITE_URL . "/modulo-estado/cadastro-estado.php"; ?>" id="form-cadastro" method="POST">

				<?php if (isset($estado)) { ?>
					<input type="hidden" name="id" value="<?php echo $estado->id; ?>">
				<?php } ?>

				<div class="form-group">
					<div class="form-row ">
						<div class="col-md-8">
							<label for="nome">Nome</label>
							<input class="form-control" name="nome" id="nome" placeholder="Nome do Estado" type="text" value="<?php echo ( isset($estado) ) ? $estado->nome : ''; ?>" />
							<?php
								/* Validação do input nome (este codigo foi passado para a função exibirErro) */
								if ( isset($listaErros['nome']) && $listaErros['nome'] )
								{
							?>
								<span class="text-danger"><?php echo $listaErros['nome']; ?></span>
								<?php
								} ?>
						</div>
						<div class="col-md-4">
							<label for="sigla">Sigla</label> <?php /* o for, leva ao id de baixo, quando se clica no "titulo do campo" */ ?>
							<input class="form-control" name="sigla" id="sigla" placeholder="Sigla do Estado" type="text" value="<?php echo ( isset($estado) ) ? $estado->sigla : ''; ?>"/>
							<?php
								/* Validação do input nome (este codigo foi passado para a função exibirErro) */
								if ( isset($listaErros['sigla']) && $listaErros['sigla'] ) 
								{ ?>
									<span class="text-danger"><?php echo $listaErros['sigla']; ?></span>
							<?php
								} ?>
						</div>
					</div>
				</div>
				<div class="form-group">
					<div class="form-row">
						<div class="col-md-12">
							<button class="btn btn-success" type="submit">Salvar</button>
							<a href="/modulo-estado/"	>
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