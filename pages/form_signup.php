<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Daftar | Kementrian Kelautan dan Perikanan Prov.Jawa Timur</title>
    <!-- CSS only -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-rbsA2VBKQhggwzxH7pPCaAqO46MgnOM80zW1RWuH61DGLwZJEdK2Kadq2F9CUG65" crossorigin="anonymous">
    <link rel="stylesheet" href="../assets/css/styles.css">
</head>
<body>
    <?php include('components/navbar.php')?>
    <div class="main-gradient pt-5">
        <div class="container">
            <div class="d-flex flex-column text-center text-white mt-4">
                <h5>Silahkan mengisi form dibawah ini untuk membuat akun pendaftar</h5>
            </div>
            <div class="bg-white rounded px-3 auth-box mx-auto">
                <form method="POST" action="../assets/php/proses_signup.php" onSubmit="return validateSign()">
                    <fieldset>
                    <!-- Email input -->
                    <div class="form-outline pt-3">
                        <label class="form-label text-black" for="email">Email</label>
                        <input type="email" name="email" class="form-control" placeholder="Email anda" id="idemail"/>
                        <p id="msgemail" class="text-danger"></p>
                    </div>

                    <!-- Username input -->
                    <div class="form-outline mt-3">
                        <label class="form-label text-black" for="username">Username</label>
                        <input type="text" name="username" class="form-control" placeholder="Username anda" id="idusername"/>
                        <p id="msgusername" class="text-danger"></p>
                    </div>

                    <!-- Password input -->
                    <div class="form-outline mt-3">
                        <label class="form-label text-black" for="password">Password</label>    
                        <input type="password" name="password" class="form-control" placeholder="Password akun" id="idpassword"/>     
                        <p id="msgpassword" class="text-danger"></p>
                    </div>

                    <!-- Konfirmasi Password -->
                    <div class="form-outline mt-3">
                        <label class="form-label text-black" for="c_password">Konfirmasi Password</label>    
                        <input type="password" name="c_password" class="form-control" placeholder="Password akun" id="idc_password"/> 
                        <p id="msgc_password" class="text-danger"></p>
                    </div>
                    
                    <!-- Login and Signin -->
                    <div class="d-flex justify-content-between mt-2">
                        <!-- submit -->
                        <input type="submit" class="btn btn-primary btn-block mb-4" name="daftar" value="Mendaftar"/>         
                        <!-- login -->
                        <a href="form_login.php">Saya sudah punya akun</a>
                    </div>
                    </fieldset>
                </form>
            </div>
        </div>
        <?php include('components/footer.php');?>
    </div>
    <script src="../assets/js/validator.js"></script>
    <!-- JavaScript Bundle with Popper -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-kenU1KFdBIe4zVF0s0G1M5b4hcpxyD9F7jL+jjXkk+Q2h455rYXK/7HAuoJl+0I4" crossorigin="anonymous"></script>
</body>
</html>