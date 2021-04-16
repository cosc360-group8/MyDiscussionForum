<?php

include("header.php");

if (isset($_SESSION['loggedin']) && $_SESSION['loggedin'] == 1){
    header('Location: ../index.php');
}

?>

    <div class="forum-logo">
        <h1>MDF&reg;</h1>
    </div> 
    
    <main class="flex-container">
        <div class="form-list">
            <form class="forms" id="signup_form" action="../api/user/create.php" method="POST">
                <h1>Sign up</h1>

                <div class="input-fields">
                    <input type="text" id="firstname" name="firstname" placeholder="First name"><br>
                </div>

                <div class="input-fields">
                    <input type="text" id="lastname" name="lastname" placeholder="Last name"><br>
                </div>

                <div class="input-fields">
                    <input type="text" id="username" name="username" placeholder="username"><br>
                </div>

                <div class="input-fields">
                    <input type="email" id="email" name="email" placeholder="email"><br>
                </div>

                <div class="input-fields">
                    <input type="password" id="password" name="password" placeholder="password"><br>
                </div>

                <div class="input-fields">
                    <input type="password" id="password-check" name="password-check" placeholder="re-enter password"><br>
                </div>
               
                <div style="text-align: center;">
                <input class="buttons" type="submit" value="Create">  
                </div>        
                
                <div style="text-align: center; font-size: 15px;">
                    <p>Already a Member? Login <a href="./login.php">here</a></p>
                </div>
            </form>           
        </div>
    </main>

    <script type="text/javascript">
        window.onload = function(){
            var form = document.getElementById('signup_form');
            form.onsubmit = function(e){
                if(checkReqFields(event)){
                    checkPasswordsMatch(event);
                }
                //alert('hi');
            }
        }

        // function to check field validity
        function checkReqFields(event){
            var username = document.getElementById('username');
            var firstname = document.getElementById('firstname');
            var lastname = document.getElementById('lastname');
            var email = document.getElementById('email');
            var password = document.getElementById('password');
            var password_check = document.getElementById('password-check');
            
            // creating an array of required fields to check field validity
            var required_fields = [username, email, password, password_check];
            for(var i = 0; i < required_fields.length; i++){
                if(required_fields[i].value.length == 0){  // if a field is empty
                    required_fields[i].classList.add('invalid');
                    alert('One or more fields are empty');
                    event.preventDefault();
                    return false;
                }        
            }
            return true;    // all fields are valid
        }

        // function to check if passwords match
        function checkPasswordsMatch(event){
            var password = document.getElementById('password');
            var password_check = document.getElementById('password-check');
            if(password.value.localeCompare(password_check.value) != 0){    // both the strings are not equal
                password.classList.add('invalid');
                password_check.classList.add('invalid');
                alert('Passwords don\'t match');
                event.preventDefault();
            } 
        }

    </script>
</body>
</html>