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
                <?php foreach($listaUfs as $uf) { ?>
                    <tr> 
                        <td> <?php echo $uf->nome; ?> </td>
                        <td> <?php echo $uf->sigla; ?> </td>
                        <td>
                            <a href= "<?php echo "/modulo-estado/cadastro-estado.php?edit=1&id={$uf->id}"; ?>">
                                <button class="btn btn-primary">Editar</button>
                            </a>
                            <button class="btn btn-danger" data-delete-message="<?php echo "Deseja deletar o estado {$uf->nome} ?"; ?>" data-delete-url="<?php echo "/modulo-estado?delete=1&id={$uf->id}"; ?>"  onclick="deletarRegistro(this);">
                            <i class="fa fa-remove"></i>
                            </button>
                        </td>
                    </tr>
                <?php } ?>
            </tbody>
        </table>
    </div>
</div>

<?php include "../comum/footer.php"; ?>

