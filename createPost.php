<?php 
include('header.php'); 

requireLogin($current_user, './auth/login.php');
?>

    <main class="flex-container">
      <div class="form-list">
        <form
          class="forms"
          id="create_post_form"
          action="api/post/createpost.php"
          method="POST"
        >
          <h1>Create Post</h1>

          <div class="input-fields">
            <input
              type="text"
              id="board"
              name="post_board"
              placeholder="Board"
            /><br />
          </div>

          <div class="input-fields">
            <input
              type="text"
              id="title"
              name="post_title"
              placeholder="Post Title"
            /><br />
          </div>

          <div class="input-fields">
            <textarea
              id="content"
              name="post_content"
              placeholder="Post Content"
            ></textarea
            ><br />
          </div>

          <div class="input-fields">
            <input
              type="file"
              id="coverImage"
              name="coverImage"
              placeholder="Cover Image"
            /><br />
          </div>

          <div style="text-align: center">
            <input class="buttons" type="submit" value="Create Post" />
          </div>
        </form>
      </div>
    </main>
<?php include('footer.php'); ?>