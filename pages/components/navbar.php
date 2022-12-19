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
                    $is_actives=[
                        'Dashboard' => '',
                        'Data Diri' => '',
                        'Berkas' => '',
                        'Hasil' => '',
                    ];
                    if(str_contains($_SERVER['REQUEST_URI'], 'dashboard')){
                        $is_actives['Dashboard'] = ' active';
                    }
                    if(str_contains($_SERVER['REQUEST_URI'], 'datadiri')){
                        $is_actives['Data Diri'] = ' active';
                    }
                    if(str_contains($_SERVER['REQUEST_URI'], 'berkas')){
                        $is_actives['Berkas'] = ' active';
                    }
                    if(str_contains($_SERVER['REQUEST_URI'], 'hasil')){
                        $is_actives['Hasil'] = ' active';
                    }
                    
                    // cek apakah user atau admin
                    if($_SESSION['user']['privilege_level']<2){
                        echo '
                        <li class="nav-item">
                            <a class="nav-link '.$is_actives['Dashboard'].'" aria-current="page" href="pages/dashboards/user_dashboard.php">Dashboard</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link '.$is_actives['Data Diri'].'" aria-current="page" href="pages/lihat_datadiri.php">Data Diri</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link '.$is_actives['Berkas'].'" aria-current="page" href="pages/lihat_berkas.php">Berkas</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link '.$is_actives['Hasil'].'" aria-current="page" href="pages/lihat_hasil.php">Hasil</a>
                        </li>
                        ';
                    }else{
                        echo '
                        <li class="nav-item">
                            <a class="nav-link '.$is_actives['Dashboard'].'" aria-current="page" href="pages/dashboards/pegawai_dashboard.php">Dashboard</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" aria-current="page" href="pages/lihat_seluruh_pendaftar.php?page=1&show=25">Data Seluruh Pendaftar</a>
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
                        echo '<a class="nav-link rounded text-white p-2 text-center my-auth-btn" aria-current="page" href="php/proses_logout.php">Keluar</a>';
                    }
                    else{
                        echo '<a class="nav-link rounded text-white p-2 text-center my-auth-btn" aria-current="page" href="pages/form_login.php">Masuk</a>';
                    }
                }else{
                    echo '<a class="nav-link rounded text-white p-2 text-center my-auth-btn" aria-current="page" href="pages/form_login.php">Masuk</a>';
                }
                ?>
            </div>
        </div>

    </div>
    <style>
        .my-auth-btn:hover{
            background-color:#00a5df;
        }
        #mynav{
            background-color: #152238;
        }
    </style>
</nav>