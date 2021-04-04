<!DOCTYPE html>
<html>

<?php
    // Generic structure only
    try {
        $connString = "mysql:host=localhost;dbname=userdb";
        $user = "webuser";
        $pass = "P@ssw0rd";

        $pdo = new PDO($connString, $user, $pass);
        $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

        $sql = "SELECT username, email FROM users WHERE username = '".$username. "' OR email = '".$email."';";
        $result = $pdo->query($sql);

        while ($row = $result->fetch()) {
            echo $row['username']." ".$row['email']."<br/></br>";
        }

        if($result->rowCount() > 0) {
            echo "User already exists with this name and/or email.</br>";
            echo "<a href='lab9-1.html'>Return to user entry.</a>";
        }
        else {
            echo "An account for user ".$firstname." has been created.";
            $sql = "INSERT INTO users VALUES ('".$username."','".$firstname."','".$lastname."','".$email."','".md5($password)."');";
            $result = $pdo->query($sql);
        }
        $pdo = null;
    }

    catch (PDOException $e) {
        die($e->getMessage());
    }
?>
</html>
