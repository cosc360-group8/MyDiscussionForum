<?php 
include('header.php'); 

requireLogin($current_user, './auth/login.php');
?>

<main class="flex-container">
    <div class="form-list">
        <form class="forms" action="api/user/edit.php" method="POST" enctype="multipart/form-data">
            <h1>Edit Your Profile</h1>

            <div class="input-fields">
                <input type="text" name="fname" value="<?php print_r($current_user->fname); ?>" placeholder="Your First Name" required /><br />
            </div>
            <div class="input-fields">
                <input type="text" name="lname" value="<?php print_r($current_user->lname); ?>" placeholder="Your Last Name" required /><br />
            </div>
            <div class="input-fields">
                <input type="file" name="pfp" value="<?php print_r($current_user->fname); ?>" /><br />
            </div>

            <div style="text-align: center">
            <input class="buttons" type="submit" value="Save Changes" />
          </div>
        </form>
    </div>
</main>

<?php
include('footer.php');
?>