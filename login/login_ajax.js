function successfulLogIn(){
    // promeni zashtoto e login
    var email = document.getElementById("email").value;
    var password = document.getElementById("password").value;
    $.ajax({
            type : "POST",
            url  : "http://localhost/alumni/login/login.php",
            "Content-Type" : "application/json",
            data : JSON.stringify({ "email" : email, "password" : password }),
            success: function(res){  
                        const response = JSON.parse(res);
                        if(response.success == false){
                            document.getElementById("error_message").innerHTML = response.error_message;
                            return false;
                        } else {
                            window.location.href = "http://localhost/alumni/user/profile.php";
                            return true;
                        }
                    }
        });
        return false;
}
