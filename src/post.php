<!DOCTYPE html>
<html>
        <head>
                <title>AQademy</title>
                <link rel="stylesheet" type="text/css" href="/assets/css/bootstrap.css">
                <link rel="icon" href="/assets/img/a.ico">
                <script src="/assets/js/jquery-3.6.0.min.js"></script>
                <script src="/assets/js/bootstrap.js"></script>
                <link rel="stylesheet" href="https://code.jquery.com/ui/1.12.1/themes/base/jquery-ui.css">
                <script src="https://code.jquery.com/jquery-3.6.0.js"></script>
                <script src="https://code.jquery.com/ui/1.13.2/jquery-ui.js"></script>
                <script src="/assets/js/search-box.js"></script>

                <script src="https://www.google.com/recaptcha/api.js" async defer></script>
                <script>
                    function onSubmit(token) {
                        document.getElementById("demo-form").submit();
                    }
                </script>
                <style>
    #dropzone {
        border: 2px dashed #ccc;
        padding: 20px;
        width: 700px; /* Adjust the width as needed */
        margin-bottom: 20px;
        text-align: center;
    }

    #dropzone p {
        margin-top: 0;
    }
</style>
        </head>
        <body class="bg-light">
            <script>
                // Show select image using file input.
                function readURL(input) {
                    $('#default_img').show();
                    if (input.files && input.files[0]) {
                        var reader = new FileReader();

                        reader.onload = function(e) {
                            $('#select')
                                .attr('src', e.target.result)
                                .width(300)
                                .height(200);

                        };

                        reader.readAsDataURL(input. files[0]);
                    }
                }
                $(document).ready(function() {
                    var scrollPosition = sessionStorage.getItem('scrollPosition');
                    if (scrollPosition != null) {
                        $(window).scrollTop(scrollPosition);
                        sessionStorage.removeItem('scrollPosition');
                    }
                });
            </script>

            <nav class="navbar navbar-expand-lg navbar-dark bg-dark">
                <a class="navbar-brand" href="home.php">AQademy</a>
                    <form class="form-inline my-2 my-lg-0" action="'searchPosts.php" method="GET">
                        <input class="form-control mr-sm-2" type="search" placeholder="Search" aria-label="Search" id="search-box" name="searchTitle">
                        <input type="hidden" id="post-id" name="postId">
                        <button class="btn btn-outline-success my-2 my-sm-0" type="submit">Search</button>
                    </form>
                <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
                    <span class="navbar-toggler-icon"></span>
                </button>
                <div class="collapse navbar-collapse" id="navbarNav">

                    
                    <ul class="navbar-nav ml-auto">

                        <li class="nav-item">
                            <a class="nav-link" href="#">Home</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="#">Notification</a>
                        </li>
                        <li class="nav-item dropdown">
                            <a class="nav-link dropdown-toggle" href="#" role="button" data-toggle="dropdown" aria-expanded="false">
                            User
                            </a>
                            <ul class="dropdown-menu dropdown-menu-right">
                            <li><a class="dropdown-item" href="#">Bookmarks</a></li>
                            <li><a class="dropdown-item" href="#">Setting</a></li>
                            <li><hr class="dropdown-divider"></li>
                            <li><a class="dropdown-item" href="#"> Logout </a></li>
                            </ul>
                        </li>

                    </ul>
                </div>
            </nav>
            <div class="container mt-3">
<?php
// Check if a post ID is provided in the URL
if (isset($_GET['id'])) {
    $postId = $_GET['id'];

    // Now you can use $postId to fetch and display the specific post
    $servername = "mysql";
    $db = "cloud_computing";
    $username = "php";
    $password = "php";
    
    // Create connection
    $conn = mysqli_connect($servername, $username, $password, $db);
    
    // Check the database connection
    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    }
    
    // Prepare and execute a SQL query to fetch the post by postId
    $sql = "SELECT * FROM posts WHERE postId = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("i", $postId); // "i" indicates an integer
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result->num_rows > 0) {
        // Fetch the post data
        $post = $result->fetch_assoc();
    ?>
        <h1><?php echo $post['title']; ?></h1>
        <p><?php echo $post['content']; ?></p>
        <p>Posted by <?php echo $post['username']; ?> on <?php echo date('F j, Y, g:i a', strtotime($post['datetime'])); ?></p>
        <label>Likes: </label>
        <small id="upvote"><?= $post['upvotes'] ?></small>
        <br>
        <button id="upvote-btn" class="btn btn-primary" data-post-id="<?= $post['postId'] ?>" data-url="#">Upvote</button>
        <hr>
        <h3>Comments</h3>
        <?php if ($comments) { ?>
            <?php foreach ($comments as $comment) : ?>
            <div class="card mb-3">
                <div class="card-body">
                <h5 class="card-title"><?php echo $comment['username']; ?></h5>
                <p class="card-text"><?php echo $comment['content']; ?></p>
                <p class="card-text"><small class="text-muted">Posted on <?php echo date('F j, Y, g:i a', strtotime($comment['datetime'])); ?></small></p>
                </div>
            </div>
            <?php endforeach; ?>
        <?php } else { ?>
            <p>No comments yet.</p>
        <?php } ?>
        <hr>
        <h4>Add a comment</h4>
        <form method="post" action="#">
            <div class="form-group">
            <input type="hidden" name="postId" value="<?php echo $post['postId']; ?>">
            <label for="content">Comment</label>
            <textarea class="form-control" name="content" rows="3" required></textarea>
            </div>
            <button type="submit" class="btn btn-primary">Submit</button>
        </form>

    <?php } else { ?>
    <p>Post not found.</p>
    <?php }
    // Close the database connection
    $conn->close(); 

} else {
    // Handle cases where no post ID is provided (e.g., show an error message)
    echo "Post not found.";
}
?>
</div>

<script src="assets/js/upvote.js"></script>
<script>
  $(document).ready(function() {
    $(document).on('click', '.bookmarkBtn', function() {
      var postId = $(this).data('post-id');
      $.ajax({
        url: '<?= base_url('bookmark/') ?>' + postId,
        method: 'GET',
        success: function(response) {
          if (response.status == 'success') {
            alert("Successfully bookmarked!");
            window.location.reload();
          } else if (response.status == 'already_bookmarked') {
            alert("This post is already bookmarked!");
          } else {
            alert("Error occurred while bookmarking the post!");
          }
        },
        error: function(xhr, status, error) {
          console.log(xhr.responseText);
        }
      });
    });
  });
</script>


<footer>
    <div class="container">
        <div class="row vcenter">
            <div class="col-xs-6">
                <p>&copy; Hsing-Yu Chen. 2023-<?php echo date("Y"); ?></p>
            </div>
        </div>
    </div>
</footer>
</body>
</html>