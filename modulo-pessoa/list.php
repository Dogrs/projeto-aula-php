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
            <button class="btn btn-default">Nova pessoa </button>
            <br>
            <br>
        </a>

        <table class="table table-bordered table-striped">  
            <thead> 
                <tr> 
                    <th> Pessoa </th>
                    <th> CPF </th>
                    <th> Ações </th>
                </tr>
            </thead>
            <tbody> 
                <?php foreach($listaPessoas as $pessoas) { ?>
                    <tr> 
                        <?php $cpfMask = adicionarMascaraCpf($pessoas->cpf); ?>
                        <td> <?php echo" {$pessoas->primeiro_nome} {$pessoas->segundo_nome}"; ?> </td>
                        <td> <?php echo $cpfMask; ?> </td>
                        <td>
                            <a href= "<?php echo "/modulo-pessoa/cadastro-pessoa.php?edit=1&id={$pessoas->id}";?>">
                                <button class="btn btn-primary">Editar</button>
                            </a>
                            <button class="btn btn-danger" data-delete-message="<?php echo "Deseja deletar o pessoa {$pessoas->primeiro_nome} ?"; ?>" data-delete-url="<?php echo "/modulo-pessoa?delete=1&id={$pessoas->id}"; ?>"  onclick="deletarRegistro(this);">
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

