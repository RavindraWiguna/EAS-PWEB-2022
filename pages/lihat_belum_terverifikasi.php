<?php
include("../assets/php/auth_checker.php");
check(2);
?>
<?php
include("../config.php");
include('../assets/php/proses_ambil_belum_terverifikasi.php');
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Pendaftaran Pegawai Kementrian Kelautan dan Perikanan</title>
    <!-- CSS only -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-rbsA2VBKQhggwzxH7pPCaAqO46MgnOM80zW1RWuH61DGLwZJEdK2Kadq2F9CUG65" crossorigin="anonymous">
    <link rel="stylesheet" href="../assets/css/styles.css">
</head>
<body>
    <?php include('components/navbar.php')?>
    <div class="main-gradient pt-5">
        <div class="container">
            <div class="d-flex flex-column text-center text-white mt-4 mb-2">
                <h5>Data Pendaftar Belum Terverifikasi</h5>
            </div>
            <?php
            // cek apakah ada pesan gagal meloloskan peserta atau menggagalkan peserta
            if(isset($_GET['status'])){
                if($_GET['status'] == 'gagal'){
                    if($_GET['pesan']== 'gagal'){
                        echo '
                        <div class="alert alert-danger alert-dismissible fade show" role="alert">
                            <strong>Gagal!</strong> Pendaftar gagal digagalkan.
                            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                        </div>
                        ';
                    }
                    else if($_GET['pesan']== 'lolos'){
                        echo '
                        <div class="alert alert-danger alert-dismissible fade show" role="alert">
                            <strong>Gagal!</strong> Pendaftar gagal diloloskan.
                            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                        </div>
                        ';
                    }
                }
            }
            ?>
            <div class="bg-white rounded px-3 mx-auto my-form-box shadow">
                <div class="pt-2"></div>
                <?php

                $show_names = [
                    'id' => 'ID',
                    'nama' => 'Nama Lengkap',
                ];

                $chunk_pendaftar = get_chunk_pendaftar();
                echo '
                <table class="table table-hover mx-auto">
                <thead>
                    <tr>
                    <th scope="col" class="text-center">ID</th>
                    <th scope="col" class="text-center">Nama</th>
                    </tr>
                </thead>
                <tbody>
                ';
                foreach($chunk_pendaftar as $key => $value){
                    echo '
                    <tr>
                        <th scope="row"><a href="pages/lihat_pendaftar.php?id='.$value['id'].'" class="text-black">'.$value['id'].'</a></th>
                        <td>'.$value['nama'].'</td>
                    </tr>
                    ';
                }
                echo '
                </tbody>
                </table>
                ';
                ?>
                <nav aria-label="Page navigation example" class="pb-1">
                    <ul class="pagination">
                        <li class="page-item">
                        <a class="page-link" href="#" aria-label="Previous" id="prev">
                            <span aria-hidden="true">&laquo;</span>
                        </a>
                        </li>
                        <li class="page-item">
                        <a class="page-link" href="#" aria-label="Next" id="next">
                            <span aria-hidden="true">&raquo;</span>
                        </a>
                        </li>
                    </ul>
                </nav>
            </div>
        </div>
    </div>
    <?php include('components/footer.php');?>

    <script src="../assets/js/validator.js"></script>

    <script>
        function changehref(){
            var prev = document.getElementById('prev');
            var next = document.getElementById('next');
            var page = <?php echo get_page();?>;
            var show = <?php echo get_show();?>;
            var total_data = <?php echo get_total_data();?>;
            var max_page = Math.ceil(total_data/show);
            if(page == 1){
                prev.href = "lihat_seluruh_pendaftar.php?page=1&show="+(show);
            }else{
                prev.href = "lihat_seluruh_pendaftar.php?page="+(page-1)+"&show="+(show);
            }
            if(page == max_page){
                next.href = "lihat_seluruh_pendaftar.php?page="+max_page+"&show="+(show);
            }else{
                next.href = "lihat_seluruh_pendaftar.php?page="+(page+1)+"&show="+(show);
            }
        }
        changehref();
    </script>

    <!-- JavaScript Bundle with Popper -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-kenU1KFdBIe4zVF0s0G1M5b4hcpxyD9F7jL+jjXkk+Q2h455rYXK/7HAuoJl+0I4" crossorigin="anonymous"></script>
</body>
</html>