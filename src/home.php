<?php
session_start(); // Start the session

if (!isset($_SESSION['username'])) {
    header("Location: index.php");
    exit;
}
?>
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
                            <a class="nav-link" href="home.php">Home</a>
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
                            <li><a class="dropdown-item" href="logout.php"> Logout </a></li>
                            </ul>
                        </li>

                    </ul>
                </div>
            </nav>
            
            <div class="container">
    <br><br>
  <div class="row">
    <div class="col-md-12">
      <h1>Posts</h1>
      <a href="newPost.php" class="btn btn-primary float-right">Add New Post</a>
    </div>
  </div>
  <br>
<?php

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

$sql = "SELECT * FROM posts ORDER BY postId DESC";

$result = $conn->query($sql);
$posts = [];
while ($row = $result->fetch_assoc()) {
    $posts[] = $row;
}

?>

    <div class="row post-container">
        <?php foreach ($posts as $post) : ?>
            <div class="col-md-4">
                <div class="card mb-4 box-shadow">
                    <div class="card-body">
                        <h5 class="card-title">
                            <?= $post['title'] ?>
                            <a data-post-id="<?= $post['postId'] ?>" class="bookmarkBtn btn btn-outline-success btn-sm float-right">Bookmark</a>
                        </h5>
                        <p class="card-text">By <?= $post['username'] ?></p>
                        <p style="font-size:12px" class="card-text"><?= $post['datetime'] ?></p>
                        <div class="d-flex justify-content-between align-items-center">
                            <div class="btn-group">
                                <a href="post.php?id=<?= $post['postId'] ?>" class="btn btn-sm btn-outline-info">View</a>
                            </div>
                            <small class="text-muted">Likes: <?= $post['upvotes'] ?></small>
                        </div>
                    </div>
                </div>
            </div>
        <?php endforeach; ?>
        <div id="loading-spinner" class="col-md-12 text-center" style="display:none;">
            <i class="fa fa-spinner fa-spin fa-3x"></i>
        </div>

    </div>
<?php
// Close data connection
    $conn->close();
?>

</div>

<script>
    
    var start = <?= count($posts) ?>;
  $(window).scroll(function() {

    console.log('scrolling');
    console.log($(document).height());
    console.log($(window).scrollTop());
    console.log($(window).height());
    console.log(start);
    sessionStorage.setItem('scrollPosition', $(window).scrollTop());
    if($(window).scrollTop() + 752.01 > $(document).height()) {
        
        $('#loading-spinner').show();
           // ajax call get data from server and append to the div
        $.ajax({
            url: '<?= base_url('/posts/loadPosts') ?>',
            method: 'POST',
            data: {start:start},
            success: function(response){
                console.log(response);
                start += 3;
                $('.post-container').append(response);
                if(response.trim() == '') {
                    $('#load-more-btn').attr('disabled', true);
                }
            },
            complete: function() {
                // hide loading spinner
                $('#loading-spinner').hide();
            }
        });
    }
});
</script>
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