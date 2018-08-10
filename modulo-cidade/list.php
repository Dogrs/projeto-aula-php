<?php //modulo-cidade/list.php
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
            }
                ?>
        

        <a href="/modulo-cidade/cadastro-cidade.php">
            <button class="btn btn-default">Nova Cidade </button>
            <br>
            <BR>
        </a>

        <table class="table table-bordered table-striped">  
            <thead> 
                <tr> 
                    <th> Cidade </th>
                    <th> Estado </th>
                    <th> Ações </th>
                </tr>
            </thead>
            <tbody> 
                <?php foreach($listaCidades as $cidade) { ?>
                    <tr> 
                        <td> <?php echo $cidade->cidade_nome; ?> </td>
                        <?php /*<th> <?php echo $cidade->uf_nome; ?> (<?php echo $cidade->uf_sigla; ?>) </th> */?>
                        <td> <?php echo "{$cidade->uf_nome} ({$cidade->uf_sigla})"; ?> </td>
                        <td>
                            <a href= "<?php echo "/modulo-cidade/cadastro-cidade.php?edit=1&id={$cidade->cidade_id}"; ?>">
                                <button class="btn btn-primary">Editar</button>
                            </a>
                            <button class="btn btn-danger" data-delete-message="<?php echo "Deseja deletar a cidade {$cidade->cidade_nome} ?"; ?>" data-delete-url="<?php echo "/modulo-cidade?delete=1&id={$cidade->cidade_id}"; ?>"  onclick="deletarRegistro(this);">
                            <i class="fa fa-remove"></i>
                            </button>
                        </td>
                    </tr>
                <?php } ?>
            </tbody>
        </table>
    </div>
</div>

<script type="text/javascript"> </script>

<?php include "../comum/footer.php"; ?>

