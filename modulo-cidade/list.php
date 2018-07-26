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
                </tr>
            </thead>
            <tbody> 
                <?php foreach($listaCidades as $cidade) { ?>
                    <tr> 
                        <th> <?php echo $cidade->cidade_nome; ?> </th>
                        <?php /*<th> <?php echo $cidade->uf_nome; ?> (<?php echo $cidade->uf_sigla; ?>) </th> */?>
                        <th> <?php echo "{$cidade->uf_nome} ({$cidade->uf_sigla})"; ?> </th>
                    </tr>
                <?php } ?>

            </tbody>

        </table>
    </div>
</div>

<?php include "../comum/footer.php"; ?>

