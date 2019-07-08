function Login() {

    var username = document.getElementById('username').value;
    var password = document.getElementById('password').value;

    console.log("User Enter :: " + username + "," + password);
    let user = {};

    const params = new URLSearchParams();
    params.append('check', "scan");
    axios.post('php/getlogin.php', params).then(function (response) {
        var LoginFail = false;
        user = response.data;
        console.log(user);

        for (let index = 0; index < user.length; index++) {

            if (username == user[index].username && password == user[index].password) {

                console.log("Login Success");
                Success_session(user[index].firstname, user[index].surname, user[index].status, user[index].id, user[index].password);
                LoginFail = false;
                break;

            } else {
                console.log("Login Fail");
                LoginFail = true;
            }

        }

        if (LoginFail) {
            console.log("LoginFail =" + LoginFail);
            alert("การ Login ล้มเหลว กรุณากรอก ID และ Password ใหม่ !");
        }
    });

}

function Success_session(si_fname, si_sname, si_st, si_id, si_password) {

    const params = new URLSearchParams();
    params.append('login', 'Success');
    params.append('firstname', si_fname);
    params.append('surname', si_sname);
    params.append('status', si_st);
    params.append('id', si_id);
    params.append('password', si_password);
    params.append('check', "Add");
    axios.post('php/SessionLogin.php', params).then(function (response) {
        //CheckLogin();
        window.location.href = "./index.html";
    });

}