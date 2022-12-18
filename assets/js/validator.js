// Menghitung umur berdasarkan tanggal lahir
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

// reset validate message except keep
function resetValidateMessage(keep){
    let msgemail = document.getElementById('msgemail');
    let msgusername = document.getElementById('msgusername');
    let msgpassword = document.getElementById('msgpassword');
    let msgc_password = document.getElementById('msgc_password');
    let msgnama_lengkap= document.getElementById('msgnama_lengkap');
    let msgform = document.getElementById('msgform');

    let msgnik = document.getElementById('msgnik');
    let msgtanggal_lahir = document.getElementById('msgtanggal_lahir');
    let msgtempat_lahir = document.getElementById('msgtempat_lahir');
    let msgjenis_kelamin = document.getElementById('msgjenis_kelamin');
    let msgagama = document.getElementById('msgagama');
    let msgstatus_perkawinan = document.getElementById('msgstatus_perkawinan');

    let arr = [msgemail,msgusername,msgpassword,msgc_password,msgnama_lengkap,msgform, 
               msgnik, msgtanggal_lahir, msgtempat_lahir, msgjenis_kelamin, msgagama, 
               msgstatus_perkawinan];
    
    for(let i=0;i<arr.length;i++){
        if(arr[i])
            arr[i].textContent='';
    }

    let arr_keep_msgs = {
        'email' : 'Email belum valid',
        'username' : 'Username hanya dapat diisi oleh huruf dan angka',
        'password' : 'Password masih kurang dari 9 karakter',
        'c_password' : 'Konfirmasi password belum sama dengan password',
        'nama_lengkap' : 'Nama lengkap hanya boleh terdiri dari huruf saja',
        'form' : 'Isi seluruh form dengan benar terlebih dahulu',
        'nik' : 'NIK harus terdiri dari 16 digit angka',
        'tanggal_lahir' : 'Tanggal lahir tidak valid',
        'tempat_lahir' : 'Tempat lahir tidak valid',
    };

    if(keep in arr_keep_msgs){
        document.getElementById('msg'+keep).textContent = arr_keep_msgs[keep];
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
    let letters = /^[a-zA-Z\s]*$/;
    let alphanum = /^[0-9a-zA-Z]+$/;
    let emails = /^[^\s@]+@[^\s@]+\.[^\s@]+$/;

    if(nama_lengkap==''
    || email=='' 
    || username == '' 
    || password == '' 
    || c_password == ''){
        // alert("Isi seluruh form dengan benar terlebih dahulu");
        resetValidateMessage('form');
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
    // alert('clicked');
    let user_email = document.getElementById("iduser_email").value;
    let password = document.getElementById('idpassword').value;

    if(user_email==''
    || password==''){
        // alert('ini bos');
        resetValidateMessage('form');
        return false;
    }
    // alert('done');
    return true;
}

function validateDataDiri(){
    // validasi nik, nama, tanggal lahir, tempat lahir, jenis kelamin, agama, status perkawinan
    let nik = document.getElementById('idnik').value;
    let nama = document.getElementById('idnama_lengkap').value;
    let tempat_lahir = document.getElementById('idtempat_lahir').value;
    let tanggal_lahir = document.getElementById('idtanggal_lahir').value;
    let jenis_kelamin = document.getElementById('idjenis_kelamin').value;
    let agama = document.getElementById('idagama').value;
    let status_perkawinan = document.getElementById('idstatus_perkawinan').value;

    if(nik=='' || nama=='' || tempat_lahir=='' || tanggal_lahir=='' || jenis_kelamin=='' || agama=='' || status_perkawinan==''){
        resetValidateMessage('form');
        document.getElementById('msgform').scrollIntoView(false);
        return false;
    }

    // validasi nik apakah terdiri dari angka saja dengan regex
    let numbers = /^[0-9]+$/;
    if(!numbers.test(nik)){
        resetValidateMessage('nik');
        document.getElementById('msgnik').scrollIntoView(false);
        return false;
    }

    // validasi apakah nama hanya terdiri dari huruf dan spasi
    let letters = /^[a-zA-Z\s]*$/;
    if(!letters.test(nama)){
        resetValidateMessage('nama');
        document.getElementById('msgnama').scrollIntoView(false);
        return false;
    }

    // validasi apakah umur sudah diatas 18 tahun
    let umur = getAge(tanggal_lahir);
    if(umur < 18){
        resetValidateMessage('tanggal_lahir');
        document.getElementById('msgtanggal_lahir').scrollIntoView(false);
        return false;
    }

    // validasi apakah tempat lahir hanya terdiri dari huruf dan spasi
    if(!letters.test(tempat_lahir)){
        resetValidateMessage('tempat_lahir');
        document.getElementById('msgtempat_lahir').scrollIntoView(false);
        return false;
    }

    // validasi apakah jenis kelamin sudah dipilih
    if(jenis_kelamin==''){
        resetValidateMessage('jenis_kelamin');
        document.getElementById('msgjenis_kelamin').scrollIntoView(false);
        return false;
    }

    // validasi apakah agama sudah dipilih
    if(agama==''){
        resetValidateMessage('agama');
        document.getElementById('msgagama').scrollIntoView(false);
        return false;
    }

    // validasi apakah status perkawinan sudah dipilih
    if(status_perkawinan==''){
        resetValidateMessage('status_perkawinan');
        document.getElementById('msgstatus_perkawinan').scrollIntoView(false);
        return false;
    }

    return true;
}


function showPassword(event) {
    let x, icon;
    if(event.path[0].tagName =='BUTTON'){
        x = event.path[1].childNodes[1];
        icon = event.path[0].childNodes[1];
    }else{
        // path[0] is img
        x = event.path[2].childNodes[1];
        icon = event.path[0];
    }

    if (x.type === "password") {
        x.type = "text";
        icon.src ='../assets/media/eye-open.svg';
    } else {
        x.type = "password";
        icon.src ='../assets/media/eye-closed.svg';
    }  
}
