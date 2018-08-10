<?php //modulo-pessoa/list.php
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

        <a href="/modulo-pessoa/cadastro-pessoa.php">
            <button class="btn btn-default">Novo pessoa </button>
            <br>
            <br>
        </a>

        <table class="table table-bordered table-striped">  
            <thead> 
                <tr> 
                    <th> pessoa </th>
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
                            <a href= "<?php echo "/modulo-pessoa/cadastro-pessoa.php?edit=1&id={$uf->id}"; ?>">
                                <button class="btn btn-primary">Editar</button>
                            </a>
                            <button class="btn btn-danger" data-delete-message="<?php echo "Deseja deletar o pessoa {$uf->nome} ?"; ?>" data-delete-url="<?php echo "/modulo-pessoa?delete=1&id={$uf->id}"; ?>"  onclick="deletarRegistro(this);">
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

