<?php
include("../assets/php/auth_checker.php");
check(2);
?>
<?php
include("../config.php");
include('../assets/php/proses_ambil_pendaftar.php');
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
                <h5>Data Seluruh Pendaftar</h5>
            </div>
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
                        <th scope="row"><a href="" class="text-black">'.$value['id'].'</a></th>
                        <td>'.$value['nama'].'</td>
                    </tr>
                    ';
                }
                echo '
                </tbody>
                </table>
                ';
                ?>
                
            </div>
        </div>
    </div>
    <?php include('components/footer.php');?>

    <script src="../assets/js/validator.js"></script>
    <!-- JavaScript Bundle with Popper -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-kenU1KFdBIe4zVF0s0G1M5b4hcpxyD9F7jL+jjXkk+Q2h455rYXK/7HAuoJl+0I4" crossorigin="anonymous"></script>
</body>
</html>