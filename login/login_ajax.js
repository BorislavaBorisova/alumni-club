function successfulLogIn(event){
    // promeni zashtoto e login
    event.preventDefault();
    var email = document.getElementById("email").value;
    var password = document.getElementById("password").value;
    $.ajax({
            type : "POST",
            url  : "http://" + window.location.host + "/alumni/login/login.php",
            "Content-Type" : "application/json",
            data : JSON.stringify({ "email" : email, "password" : password }),
            success: function(res){  
                        const response = JSON.parse(res);
                        if(response.success == false){
                            document.getElementById("error_message").innerHTML = response.error_message;
                            return false;
                        } else {
                            window.location.href = "http://" + window.location.host + "/alumni/user/profile.php";
                            return true;
                        }
                    }
        });
        return false;
}
