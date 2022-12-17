function getAge(dateString) 
{
    var today = new Date();
    var birthDate = new Date(dateString);
    var age = today.getFullYear() - birthDate.getFullYear();
    var m = today.getMonth() - birthDate.getMonth();
    if (m < 0 || (m === 0 && today.getDate() < birthDate.getDate())) 
    {
        age--;
    }
    return age;
}
function get_date(){
    var today = new Date();
    var dd = String(today.getDate()).padStart(2, '0');
    var mm = String(today.getMonth() + 1).padStart(2, '0'); //January is 0!
    var yyyy = today.getFullYear();
    
    var databula = [
        "Invalid"
        ,"Januari",
        "Februari",
        "Maret",
        "April",
        "Mei",
        "Juni",
        "Juli",
        "Agustus"
        ,"September"
        ,"Oktober"
        ,"November",
        "Desember"
    ]

    today = dd + ' ' + databula[parseInt(mm)] + ' ' + yyyy;
    return today;
}

function validate(){
    var tanggalisi = document.getElementById("tanggalisi");
    tanggalisi.innerHTML ="Surabaya, " + get_date();
    // alert("clicked");
    var nama = document.getElementById("data_nama").value;
    var tempatLahir = document.getElementById("data_tempat_lahir").value;
    // is astring
    var tanggalLahir = document.getElementById('data_tgl_lahir').value;
    var unit = document.getElementById("data_unit");
    var desa = document.getElementById("data_desa");
    var kecamatan = document.getElementById("data_kecamatan");
    var telp = document.getElementById("data_telp");
    var catlomba = checkradiobutton();

    var letters = /^[A-Za-z]+$/
    var numbers = /^[0-9]+$/
    var alphanum = /^[0-9a-zA-Z]+$/

    if(nama=='' 
    || tempatLahir == '' 
    || tanggalLahir == '' 
    || unit == ''
    || desa == ''
    || kecamatan == ''
    ||telp == ''
    || catlomba == -1){
        alert("Isi seluruh form dengan benar terlebih dahulu");
    }

    else if(!letters.test(nama)){
        alert("Nama hanya dapat diisi dengan huruf");
    }
    else if(! letters.test(tempatLahir)){
        alert("Tempat lahir hanya dapat diisi dengan huruf");
    }
    else if(getAge(tanggalLahir) < 18){
        alert("Harus berumur paling tidak 18 tahun");
    }
    else if(! alphanum.test(unit)){
        alert("Unit hanya dapat diisi dengan alphanumerik");
    }
    else if(!letters.test(desa)){
        alert("Desa hanya dapat diisi dengan huruf");
    }
    else if(! letters.test(kecamatan)){
        alert("Kecamatan hanya dapat diisi dengan huruf");
    }
    else if(numbers.test(telp)){
        alert("Nomor telepon hanya dapat diisi dengan angka");
    }

    else{
        alert("Berhasil mendaftar");
    }


    // checkradiobutton();
    
    // var cp = document.getElementById('p2').value;
    // alert(tanggalLahir);
    // console.log(tanggalLahir);
    // alert(typeof(tanggalLahir));
}

// reset validate sign message except keep
function resetValidateSignMessage(keep){
    let msgemail = document.getElementById('msgemail');
    let msgusername = document.getElementById('msgusername');
    let msgpassword = document.getElementById('msgpassword');
    let msgc_password = document.getElementById('msgc_password');


    if(keep == 'email'){
        msgemail.textContent='Email belum valid';
        msgusername.textContent='';
        msgpassword.textContent='';
        msgc_password.textContent='';
        return;
    }
    if(keep == 'username'){
        msgemail.textContent='';
        msgusername.textContent='Username hanya dapat diisi oleh huruf dan angka';
        msgpassword.textContent='';
        msgc_password.textContent='';
        return;
    }
    if(keep == 'password'){
        msgemail.textContent='';
        msgusername.textContent='';
        msgpassword.textContent='Password masih kurang dari 9 karakter';
        msgc_password.textContent='';
        return;
    }
    if(keep == 'c_password'){
        msgemail.textContent='';
        msgusername.textContent='';
        msgpassword.textContent='';
        msgc_password.textContent='Konfirmasi password belum sama dengan password';
        return;
    }
}

function validateSign(){
    // alert("clicked");
    let email = document.getElementById("idemail").value;
    let username = document.getElementById("idusername").value;
    let password = document.getElementById('idpassword').value;
    let c_password = document.getElementById('idc_password').value;
    
    let letters = /^[A-Za-z]+$/;
    let numbers = /^[0-9]+$/;
    let alphanum = /^[0-9a-zA-Z]+$/;
    let emails = /^\w+([\.-]?\w+)*@\w+([\.-]?\w+)*(\.\w{2,3})+$/;

    if(email=='' 
    || username == '' 
    || password == '' 
    || c_password == ''){
        alert("Isi seluruh form dengan benar terlebih dahulu");
        resetValidateSignMessage(null);
        return false;
    }

    if(!emails.test(email)){
        document.getElementById('msgemail').textContent='Email belum valid';
        // alert("Isikan email dengan benar");
        resetValidateSignMessage('email');
        return false;
    }
    
    if(!alphanum.test(username)){
        document.getElementById('msgusername').textContent='Username hanya boleh terdiri dari alpha-numerik';
        // alert("Username hanya boleh terdiri dari alpha-numerik");
        resetValidateSignMessage('username');
        return false;        
    }

    // check password length and match with confirm password
    if(password.length < 9){
        document.getElementById('msgpassword').textContent='Password kurang dari 9 karakter';
        // alert("Password kurang dari 9 karakter");
        resetValidateSignMessage('password');
        return false;
    }
    
    if(password != c_password){
        document.getElementById('msgc_password').textContent='Password tidak sama';
        // alert("Password tidak sama");
        resetValidateSignMessage('c_password');
        return false;
    }

    return true;
}