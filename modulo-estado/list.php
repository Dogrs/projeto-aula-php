<?php
    include "../comum/head.php";
    include "../comum/side-menu.php";
?>

<div class="content-wrapper">
	<div class="container-fluid">
	
		<?php include "../comum/migalhas.php"; ?>

        <?php 
            if ($mensagemSucesso) 
            {
                ?>
                <div class="alert alert-success">
                    <?php echo $mensagemSucesso; ?>
                </div>
                <?php
            }

            if ($listaErros)
            {
                ?>
                <div class="alert alert-danger">
                    <?php echo exibirErro($listaErros, 'delete'); ?>
                </div>
                <?php
            }?>

        <a href="/modulo-estado/cadastro-estado.php">
            <button class="btn btn-default">Novo Estado </button>
            <br>
            <br>
        </a>

        <table class="table table-bordered table-striped">  
            <thead> 
                <tr> 
                    <th> Estado </th>
                    <th> Sigla </th>
                    <th> Ações </th>
                </tr>
            </thead>
            <tbody> 
                <?php foreach($listaEstados as $estado) { ?>
                    <tr> 
                        <th> <?php echo $estado->estado_nome; ?> </th>
                        <th> <?php echo "{$estado->estado_sigla}"; ?> </th>
                        <th>
                            <a href= "<?php echo "/modulo-estado/cadastro-estado.php?edit=1&id={$estado->estado_id}"; ?>">
                                <button class="btn btn-primary">Editar</button>
                            </a>
                            <button class="btn btn-danger" data-delete-message="<?php echo "Deseja deletar o estado {$estado->estado_nome} ?"; ?>" data-delete-url="<?php echo "/modulo-estado?delete=1&id={$estado->estado_id}"; ?>"  onclick="deletarRegistro(this);">
                            <i class="fa fa-remove"></i>
                            </button>
                        </th>
                    </tr>
                <?php } ?>
            </tbody>
        </table>
    </div>
</div>

<script type="text/javascript"></script>
<?php include "../comum/footer.php"; ?>

