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
            <form class="forms" id="passwordForgot_form" action="passwordRecover.php" method="POST">
                <h1>Forgot password</h1>

                <div class="input-fields">
                    <input type="text" id="username" name="username" placeholder="username"><br>
                </div>

                <div class="input-fields">
                    <input type="text" id="email" name="email" placeholder="recovery email"><br>
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
        window..onload = function(){
            var form = document.getElementById('passwordForgot_form');
            form.onsubmit = function(e){
                checkReqFields(event);
                //alert('hi');
            }
        }

        function checkReqFields(event){
            var email = document.getElementById('email');
            var password = document.getElementById('password');        
            // creating an array of required fields to check field validity
            var required_fields = [email, password];
            for(var i = 0; i < required_fields.length; i++){
                if(required_fields[i].value.length == 0){  // if a field is empty
                    required_fields[i].classList.add('invalid');
                    alert('One or more fields are empty');
                    event.preventDefault();               
                }        
            }          
        }

    </script>
</body>
</html>