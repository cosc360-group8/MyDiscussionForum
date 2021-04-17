<?php
    if(!isset($_GET["code"])){
        exit("Can't find the page you're looking for");
    }

    include("header.php");
    include_once $_SERVER['DOCUMENT_ROOT']."/MyDiscussionForum/api/Database.php";
    include_once $_SERVER['DOCUMENT_ROOT']."/MyDiscussionForum/api/User.php";

    $code = $_GET["code"];
    // update password
    $password = $_POST["password"];

    $db_obj = new Database();
    $db_con = $db_obj->connect();

    $user = new User();
    $username = '';
    $email = '';

    if($user->getInfoByCode($db_con, $code)){
        $username = $user->$username;
        $email = $user->$email;

        // update password
        $pw_hash = md5($password);
        $flag = $user->updatePassword($db_con, $username, $email, $pw_hash);

        if($flag == 1){
            $user->deleteFromResetPasswords($db_con, $code);
            echo "<h3>Password updated.</h3>";
        }
        else{
            echo "<h3>unknown error occured</h3>";
        }
    }
    else{
        echo "<h3>unknown error occured</h3>";
    }
?>


<div class="forum-logo">
    <h1>MDF&reg;</h1>
</div> 
    
<main class="flex-container">
    <div class="form-list">
       <form class="forms" id="passwordReset_form" method="POST">
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
