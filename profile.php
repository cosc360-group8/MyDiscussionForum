<?php include('header.php'); ?>
    <main class="flex-container">
        <div class="blog-posts">     <!-- blog-posts consists of posts from different threads -->
            <div class="post-content">
                <h2 class="thread">/football</h2>
                <div class="post-info">
                    <span>4 hours ago</span>
                </div>
                <h1 class="post-title">The situation at Barcelona</h1>
                <figure class="post-pic">
                    <img src="images\fcb.webp" title="The situation at Barcelona"  />
                </figure>
                <span class="publisher">by boi1da</span>
                <p class="post-text">
                   Lorem ipsum dolor sit, amet consectetur adipisicing elit. Repellendus pariatur incidunt iste inventore sequi
                   tempora at ipsa quia deleniti necessitatibus ad enim illo corrupti esse commodi praesentium sunt,
                   tenetur repudiandae.
                </p>
            </div>


            <div class="comment-wrapper">
                <form action="" class="form">
                    <div class="input-group">
                        <label for="name">Name</label><br>
                        <input type="text" id="name" placeholder="Enter your name:" required>
                    </div>
                    <div class="input-group">
                        <label for="email">Email</label><br>
                        <input type="text" id="email" placeholder="Enter your email:" required>
                    </div>
                    <div class="input-group">
                        <label for="comment">Comment</label><br>
                        <textarea id="comment" placeholder="Enter your comment:" required></textarea>
                    </div>
                </form>
                <div class="prev-comments">
                    <div class="single-items">
                        <h4>Kevin Nguyen</h4>
                        <p>Lorem ipsum dolor sit amet consectetur, adipisicing elit. Vitae, nobis fugiat non obcaecati quod culpa fuga reprehenderit consectetur, reiciendis optio facere laboriosam qui. Cumque incidunt, eaque ea dolorem accusamus perferendis temporibus, totam dolor laboriosam porro perspiciatis officia quos consequuntur doloremque voluptas maiores labore mollitia accusantium cum hic quisquam numquam? Maxime!</p>
                    </div>
                    <div class="single-items">
                        <h4>Jane Upton</h4>
                        <p>Lorem ipsum dolor sit amet consectetur, adipisicing elit. Vitae, nobis fugiat non obcaecati quod culpa fuga reprehenderit consectetur, reiciendis optio facere laboriosam qui. Cumque incidunt, eaque ea dolorem accusamus perferendis temporibus, totam dolor laboriosam porro perspiciatis officia quos consequuntur doloremque voluptas maiores labore mollitia accusantium cum hic quisquam numquam? Maxime!</p>
                    </div>
                </div>
            </div>
        </div>

        <aside class="side-bar post-content">
            <h1>Trending</h1>
            <p>Lorem ipsum dolor sit amet consectetur adipisicing elit. Et dignissimos sint fugit delectus, eligendi quos perferendis nisi deleniti dolorem possimus aliquam provident culpa nobis neque ratione quo consectetur est iste.</p>
        </aside>
    </main>
<?php include('footer.php'); ?>