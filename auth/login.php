<!DOCTYPE html>
<html>
<?php
    if ($_SERVER['REQUEST_METHOD'] == 'POST') { 
        $username = $_POST['username'];
        $password = $_POST['password'];

        if (!empty($username) || !empty($password)) {
            try {
                $connString = "mysql:host=localhost;dbname=userdb";
                $user = "webuser";
                $pass = "P@ssw0rd";
        
                $pdo = new PDO($connString, $user, $pass);
                $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

                $sql = "SELECT username, password FROM users WHERE username = '".$username. "' AND password = '".md5($password)."';";
                $result = $pdo->query($sql);

                if($result->rowCount() > 0) {
                    echo "Logged in successfully.";
                }
                else {
                    echo "Invalid username/password.";
                }
                $pdo = null;
            }
            catch (PDOException $e) {
                die($e->getMessage());
            }
        }
        else
            echo "One of the fields are empty.<br><br>";
    }
    elseif ($_SERVER['REQUEST_METHOD'] == 'GET') { 
        echo "Invalid submission. The form should send a POST request.";
    }
?>
</html>