# MyDiscussionForum

## Project Description
The objective is to create a discussion forum similar to Reddit. Registered users can browse the site and create posts/comments while unregistered users can still browse the site as well. Administrators should be able to disable user accounts and remove posts if needed. 

To start exploring the forum, you can navigate to index.php.
 
**Admin account:**
Username: hello@world.com
Password: 12345678

**Standard account:**
Username: jsmith@gmail.com 
Password: jsmith123

**phpMyAdmin:**
https://c360.nrieske.com/phpmyadmin/
Username: phpmyadmin
Password: dS44pQ!G?p=ppC[^

## Database
**DiscForum.sql** - contains database structures for posts, users, and comments. If this is to be imported into another database, ensure that the database name is DiscForum.

**ForumUsers (table)** - this table stores the data for all registered users. The data it stores is:
- A User ID: this uniquely identifies the user.
- Email: this is the email address that the user can login with. This email is also used for password recovery.
- Firstname: this is the user’s first name and is displayed on their profile.
- Lastname: this is the user’s last name and is displayed on their profile.
- Username: this is the user’s display name which is used when showing who posted a post or comment. The username is also displayed on the user’s profile.
- Password hash: this is used to authenticate the user during login. This is the hashed version of the plaintext password entered by the user during signup. The hash algorithm used is SHA-256.
- Profile Img: this is the url to the user’s profile picture relative to the root directory of the website (not the webserver!).
- Created On: this keeps track of when the user created their account. This is also displayed on the user’s profile.
- Is Admin and Is Enabled: these are flags used to indicate the status of an account. If the is admin flag is set, the user can access the admin panels. If the is enabled flag is not set, it indicates that an administrator disabled the user’s account.

**ForumPosts (table)** - this table stores the data for all posts. The data it stores is:
-The post ID: this is used for uniquely identifying a post.
- The user ID: this indicates who created the post. This is also a foreign key with updates/deletions set to cascade.
- Date Posted: this indicates when the post was created.
- The Title: the post’s title.
- Picture: this is the path to the image that was uploaded as part of the post.
- Content: this is the post’s text content.
- Board: this is the post’s topic.
- Score: this column is unused, but we planned to implement a feature where users could vote on posts and comments; however, due to time constraints, we were unable to implement this before the deadline.

**ForumComments (table)** - this table stores the data for all comments. The data it stores is:
- The comment ID; this is used for uniquely identifying the comment.
- The user ID: this indicates who created the comment. This is also a foreign key with updates/deletions set to cascade.
- The post ID: this indicates on which post the comment was made. This is also a foreign key with updates/deletions set to cascade.
- Date Posted: this indicates when the comment was created.
- Content: this is the comment’s text content.
- Score: similar to the score column in the ForumPosts table, this column is unused (for the same reason).

## Home
**index.php** - Home page and allows access to other parts of MDF. The news feed fetches previews of the most recent posts from users. Unregistered users can see all of the posts.

## Posts
**post.php**  - Shows the full version of a post after the user clicked on it. Comments are displayed at the bottom of the post. Unregistered can see the posts but cannot see the comments or submit comments.
**createPost.php** - Users can submit a post, attach an image and tag it to a board.

## Profile
**profile.php** - Posts that are created by the currently logged in user will be displayed. Only users that are logged in can view this tab on the nav-bar.

## Authentication
**login.php** - After entering their credentials, users are placed in a login session. All authentication fields are validated to make sure they are not empty and follow the correct format before submission.
**signup.php** - Users can create a new account after entering their credentials.
**forgotPassword.php** - Users have to enter their username and recovery email.
**passwordRecover.php** - Send an email to the user with a link to resetPassword.php
**resetPassword.php** - User can update their old password

## Admin
**adminPosts.php** - Displays all the posts on the forum in a table format. Admin can delete any posts.
**adminUsers.php** - Displays all the users information in a table format. An user can be enable/disable from logging in or enable/disable admin rights. 


