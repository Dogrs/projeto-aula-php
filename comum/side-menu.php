
<?php /* INICIO MENU PRINCIPAL */ ?>
    <nav class="navbar navbar-expand-lg navbar-dark bg-dark fixed-top" id="mainNav">
        <a class="navbar-brand" href="index.html">Start Bootstrap</a>
        <button class="navbar-toggler navbar-toggler-right" type="button" data-toggle="collapse"
                data-target="#navbarResponsive" aria-controls="navbarResponsive" aria-expanded="false"
                aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarResponsive">
            <ul class="navbar-nav navbar-sidenav" id="exampleAccordion">
                <li class="nav-item" data-toggle="tooltip" data-placement="right" title="Dashboard">
                    <a class="nav-link" href="/modulo-estado/">
                        <i class="fa fa-fw fa-list"></i>
                        <span class="nav-link-text">Estados</span>
                    </a>
                </li>
                <li class="nav-item" data-toggle="tooltip" data-placement="right" title="Dashboard">
                    <a class="nav-link" href="/modulo-cidade/">  
                        <a class="nav-link" href="/modulo-cidade/">
                        <i class="fa fa-fw fa-list"></i>
                        <span class="nav-link-text">Cidades</span>
                    </a>
                </li>
                <li class="nav-item" data-toggle="tooltip" data-placement="right" title="Dashboard">
                    <a class="nav-link" href="/modulo-pessoa/">  
                        <a class="nav-link" href="/modulo-pessoa/">
                        <i class="fa fa-fw fa-user"></i>
                        <span class="nav-link-text">Pessoas</span>
                    </a>
                </li>
                <li class="nav-item" data-toggle="tooltip" data-placement="right" title="Dashboard">
                <a class="nav-link" href="/login/logout.php">
                    <i class="fa fa-fw fa-user"></i>
                    <span class="nav-link-text">Sair</span>
                </a>
            </li>
            </ul>

            <ul class="navbar-nav sidenav-toggler">
                <li class="nav-item">
                    <a class="nav-link text-center" id="sidenavToggler">
                        <i class="fa fa-fw fa-angle-left"></i>
                    </a>
                </li>
            </ul>
            <ul class="navbar-nav ml-auto">
                <li class="nav-item">
                    <a class="nav-link" data-toggle="modal" data-target="#exampleModal">
                        <i class="fa fa-fw fa-sign-out"></i>Sair</a>
                </li>
            </ul>
        </div>
    </nav>
<?php /* FIM MENU PRINCIPAL */ ?>