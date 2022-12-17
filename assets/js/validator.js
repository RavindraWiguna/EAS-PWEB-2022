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

// reset validate message except keep
function resetValidateMessage(keep){
    let msgemail = document.getElementById('msgemail');
    let msgusername = document.getElementById('msgusername');
    let msgpassword = document.getElementById('msgpassword');
    let msgc_password = document.getElementById('msgc_password');
    let msgnama_lengkap= document.getElementById('msgnama_lengkap');

    msgemail.textContent='';
    msgusername.textContent='';
    msgpassword.textContent='';
    msgc_password.textContent='';
    msgnama_lengkap.textContent='';

    if(keep == 'email'){
        msgemail.textContent='Email belum valid';
        return;
    }

    if(keep == 'username'){
        msgusername.textContent='Username hanya dapat diisi oleh huruf dan angka';
        return;
    }

    if(keep == 'password'){
        msgpassword.textContent='Password masih kurang dari 9 karakter';
        return;
    }

    if(keep == 'c_password'){
        msgc_password.textContent='Konfirmasi password belum sama dengan password';
        return;
    }
    if(keep =='nama_lengkap'){
        msgnama_lengkap.textContent='Nama lengkap hanya boleh terdiri dari huruf saja';
        return;
    }
}

function validateSign(){
    // alert("clicked");
    let nama_lengkap = document.getElementById('idnama_lengkap').value;

    let email = document.getElementById("idemail").value;
    let username = document.getElementById("idusername").value;
    let password = document.getElementById('idpassword').value;
    let c_password = document.getElementById('idc_password').value;
    
    // regex to check if string is made up of letters only
    let letters = /^[a-zA-Z]+$/;
    let alphanum = /^[0-9a-zA-Z]+$/;
    let emails = /^[^\s@]+@[^\s@]+\.[^\s@]+$/;

    if(nama_lengkap==''
    || email=='' 
    || username == '' 
    || password == '' 
    || c_password == ''){
        alert("Isi seluruh form dengan benar terlebih dahulu");
        resetValidateMessage('');
        return false;
    }

    // alert(nama_lengkap);
    // alert(letters.test(nama_lengkap));
    console.log(nama_lengkap);
    console.log(letters.test(nama_lengkap));
    if(!letters.test(nama_lengkap)){
        document.getElementById('msgnama_lengkap').textContent='Nama hanya dapat terdiri dari huruf saja';
        resetValidateMessage('nama_lengkap');
        return false;
    }

    if(!emails.test(email)){
        document.getElementById('msgemail').textContent='Email belum valid';
        // alert("Isikan email dengan benar");
        resetValidateMessage('email');
        return false;
    }
    
    if(!alphanum.test(username)){
        document.getElementById('msgusername').textContent='Username hanya boleh terdiri dari alpha-numerik';
        // alert("Username hanya boleh terdiri dari alpha-numerik");
        resetValidateMessage('username');
        return false;        
    }

    // check password length and match with confirm password
    if(password.length < 9){
        document.getElementById('msgpassword').textContent='Password kurang dari 9 karakter';
        // alert("Password kurang dari 9 karakter");
        resetValidateMessage('password');
        return false;
    }
    
    if(password != c_password){
        document.getElementById('msgc_password').textContent='Password tidak sama';
        // alert("Password tidak sama");
        resetValidateMessage('c_password');
        return false;
    }

    return true;
}

function validateLogin(){
    let user_email = document.getElementById("iduser_email").value;
    let password = document.getElementById('idpassword').value;

    if(user_email==''
    || password==''){
        alert('Isikan seluruh form dengan benar terlebih dahulu');
        resetValidateMessage(null);
        return false;
    }

    // cek apakah dalam user_email terdapat @
    if(user_email.inc)

    return true;
}