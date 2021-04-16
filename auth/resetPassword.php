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
            <form class="forms" id="passwordReset_form" action="" method="POST">
                <h1>Reset password</h1>

                <div class="input-fields">
                    <input type="password" id="password" name="password" placeholder="password"><br>
                </div>

                <div class="input-fields">
                    <input type="password" id="password-check" name="password_check" placeholder="re-enter pasword"><br>
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
        window.onload = function(){
            var form = document.getElementById('passwordReset_form');
            form.onsubmit = function(e){
                checkPasswordsMatch(e);
                //alert('hi');
            }
        }

        function checkPasswordsMatch(e){
            var password = document.getElementById('password');
            var password_check = document.getElementById('password-check');
            // if passords don't match, add class 'invalid' and notify user that passwords don't match or are empty
            if(password.value.localeCompare(password_check.value) != 0 || password.value.length == 0){    // both the strings are not equal
                password.classList.add('invalid');
                password_check.classList.add('invalid');
                alert('Passwords are empty or don\'t match');
                e.preventDefault();
            } 
        }
    </script>
</body>
</html>
