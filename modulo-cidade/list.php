<?php
    include "../comum/head.php";
    include "../comum/side-menu.php";
?>

<div class="content-wrapper">
	<div class="container-fluid">
	
		<?php include "../comum/migalhas.php"; ?>


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
                        <th> <?php echo $cidade->cidade_nome; ?> </th>
                        <?php /*<th> <?php echo $cidade->uf_nome; ?> (<?php echo $cidade->uf_sigla; ?>) </th> */?>
                        <th> <?php echo "{$cidade->uf_nome} ({$cidade->uf_sigla})"; ?> </th>
                        <th>
                            <button class="btn btn-primary">Editar</button>
                            <button class="btn btn-danger">
                                <i class="fa fa-fw fa-close"></i>
                            </button>
                        </th>
                    </tr>
                <?php } ?>

            </tbody>

        </table>
    </div>
</div>

<?php include "../comum/footer.php"; ?>

