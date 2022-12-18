<nav class="navbar navbar-expand-lg fixed-top navbar-dark" id="mynav">
    <div class="container-fluid">
        <?php
        echo '<a class="navbar-brand fw-semibold text-white" href="index.php">Kementrian Kelautan dan Perikanan</a>'
        ?>
        
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        
        <div class="collapse navbar-collapse" id="navbarSupportedContent">
            <ul class="navbar-nav me-auto mb-2 mb-lg-0">
                <?php
                // start sesion jika belum
                if(!session_id()){
                    session_start();
                }
                if(!isset($_SESSION['user_is_login'])){
                    // do notihing
                }

                // cek apakah ada yang login
                else if($_SESSION['user_is_login']){
                    // cek apakah user atau admin
                    if($_SESSION['user']['privilege_level']<2){
                        echo '
                        <li class="nav-item">
                            <a class="nav-link" aria-current="page" href="pages/dashboards/user_dashboard.php">Dashboard</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" aria-current="page" href="#">Data Diri</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" aria-current="page" href="#">Berkas</a>
                        </li>
                        <li class="nav-item dropdown">
                            <a class="nav-link dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                            Hasil
                            </a>
                            <ul class="dropdown-menu">
                                <li><a class="dropdown-item" href="#">Tahap1</a></li>
                                <li><a class="dropdown-item" href="#">Tahap2</a></li>
                            </ul>
                        </li>
                        ';
                    }else{
                        echo '
                        <li class="nav-item">
                            <a class="nav-link" aria-current="page" href="pages/dashboards/pegawai_dashboard.php">Dashboard</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" aria-current="page" href="#">Data Seluruh Pendaftar</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" aria-current="page" href="#">Verifikasi Pendaftar</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" aria-current="page" href="#">Data Pendaftar Lolos</a>
                        </li>
                        ';
                    }
 
                }
                ?>
            </ul>
            <div>
                <?php
                if(isset($_SESSION['user_is_login'])){
                    if($_SESSION['user_is_login']){
                        echo '<a class="nav-link text-white p-2" aria-current="page" href="php/proses_logout.php">Keluar</a>';
                    }
                    else{
                        echo '<a class="nav-link text-white p-2" aria-current="page" href="pages/form_login.php">Masuk</a>';
                    }
                }else{
                    echo '<a class="nav-link rounded p-2 text-white" aria-current="page" href="pages/form_login.php" id="masuk-btn">Masuk</a>';
                }
                ?>
            </div>
        </div>

    </div>
    <style>
        #masuk-btn:hover{
            background-color:#00a5df;
        }
        #mynav{
            background-color: #152238;
        }
    </style>
</nav>