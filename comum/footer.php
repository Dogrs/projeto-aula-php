<?php /* INICIO RODAPE */ ?>
<footer class="sticky-footer">
	<div class="container">
		<div class="text-center">
			<small>Meu Site 2018</small>
		</div>
	</div>
</footer>
<?php /* FIM RODAPE */ ?>

<div id="modal-delete" class="modal fade" tabindex="-1" role="dialog">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-body">
        
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-danger btn-sim">Sim</button>
        <button type="button" class="btn btn-default btn-nao">Não</button>
      </div>
    </div>
  </div>
</div>


<?php /* INICIO SCRIPTS ADICIONAIS */ ?>
<script src="<?php echo $SITE_URL . "/static/vendor/jquery/jquery.min.js"; ?>"></script>
<script src="<?php echo $SITE_URL . "/static/vendor/bootstrap/js/bootstrap.bundle.min.js"; ?>"></script>
<script src="<?php echo $SITE_URL . "/static/vendor/jquery-easing/jquery.easing.min.js"; ?>"></script>
<script src="<?php echo $SITE_URL . "/static/vendor/jquery.mask.min.js"; ?>"></script>
<script src="<?php echo $SITE_URL . "/static/js/sb-admin.min.js"; ?>"></script>
<script src="<?php echo $SITE_URL . "/static/vendor/bootstrap-notify.js" ?>"></script>
<script src="<?php echo $SITE_URL . "/static/vendor/datepicker/js/bootstrap-datepicker.min.js"; ?> "></script>
<script src="<?php echo $SITE_URL . "/static/vendor/datepicker/locales/bootstrap-datepicker.pt-BR.min.js"; ?> "></script>
<script src="<?php echo $SITE_URL . " "; ?> "></script>

<script src="<?php echo $SITE_URL . "/static/js/home.js"; ?> "></script>

<?php /* FIM SCRIPTS ADICIONAIS */ ?>	

<?php /* SCRIPTS DO NOTIFY */ 
if (isset($_SESSION['msg_sucesso']) && $_SESSION['msg_sucesso'])
  {
    ?>
    <script type="text/javascript">
      exibirAlerta(<?php echo json_encode($_SESSION['msg_sucesso']); ?>);
    </script>
    <?php
    unset($_SESSION['msg_sucesso']);
  }

if (isset($_SESSION['msg_erro']) && $_SESSION['msg_erro']) 
  {
    ?>
    <script type="text/javascript">
    exibirAlerta(<?php echo json_encode($_SESSION['msg_erro']); ?>);
    </script>
    <?php
    unset($_SESSION['msg_erro']);
  }
  
 ?>

</body>
</html>