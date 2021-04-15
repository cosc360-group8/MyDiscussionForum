<?php

include("header.php");

if (isset($_SESSION['loggedin']) && $_SESSION['loggedin'] == 1){
    header('Lcoation: ../index.php');
}

?>


    <div class="forum-logo">
        <h1>MDF&reg;</h1>
    </div> 
    
    <main class="flex-container">
        <div class="form-list">
            <form class="forms" id="passwordForgot_form" action="" method="POST">
                <h1>Reset password</h1>

                <div class="input-fields">
                    <input type="text" id="password" name="password" placeholder="password"><br>
                </div>

                <div class="input-fields">
                    <input type="text" id="password-check" name="email" placeholder="re-enter pasword"><br>
                </div>
               
                <div style="text-align: center;">
                <input class="buttons" type="submit" value="Confirm">  
                </div>        
                
                <!-- <div style="text-align: center; font-size: 15px;">
                    <p>Forgot your username? <a href="#">here</a></p>
                </div> -->
            </form>

            
        </div>
    </main>
    <script type="text/javascript">
        document.onload = function(){
            var form = document.getElementById('signup_form');
            form.onsubmit = function(e){
                checkReqFields();
                //alert('hi');
            }
        }

        function checkReqFields(e){
            var username = document.getElementById('username');
            var email = document.getElementById('email');
            var password = document.getElementById('password');
            var password_check = document.getElementById('password-check');

            // create an array of required fields.
            // for each field, if it is empty, add class 'invalid' to highlight the field
            var required_fields = [username, email, password, password_check];
            for(var i = 0; i < required_fields.length; i++){
                if(required_fields[i].value == ''){
                    required_fields[i].classList.add('invalid');
                    e.preventDefault();
                }
            }

            // check if original and re-entered passwords match
            // if passords don't match, add class 'invalid' and notify user that passwords don't match
            if(password.value.localeCompare(password_check.value) != 0){    // both the strings are not equal
                password.classList.add('invalid');
                password_check.classList.add('invalid');
                alert('Passwords don\'t match');
                e.preventDefault();
            } 
        }

    </script>
</body>
</html>