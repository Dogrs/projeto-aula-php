<?php
    include '../comum/head.php';
?>

<style type="text/css">
    @media (min-width: 992px) 
    {   
        footer.sticky-footer
        {
            width: 100%;
        }
    }
</style>

<div class="container">
    <div class="card card-login mx-auto mt-5">
    <div class="card-header">Entrar</div>
    <div class="card-body">
        <form action="/login/" method="POST">
            <div class="form-group">
                <div class="form-label-group">
                <label for="inputemail">Email</label>
                <input type="email" name="inputemail" id="inputemail" class="form-control" placeholder="E-mail" required="required" autofocus="autofocus">
                </div>
            </div>
            <div class="form-group">
                <div class="form-label-group">
                <label for="inputsenha">Senha</label>
                <input type="password" name="inputsenha" id="inputsenha" class="form-control" placeholder="Senha" required="required">
                </div>
            </div>
            <?php if (isset($mensagemErro) && $mensagemErro) { ?>
                <div class="alert alert-danger">
                <?php echo $mensagemErro; ?>
                </div>
            <?php } ?>
            <button type="submit" class="btn btn-primary btn-block">Login</button>
        </form>
        <div class="text-center">
        
        <a class="d-block small mt-3" href="forgot-password.html">Redefinir senha!</a>
        </div>
    </div>
    </div>
</div>

<?php
include '../comum/footer.php';
?>