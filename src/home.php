<html>
        <head>
                <title>AQademy</title>
                <link rel="stylesheet" type="text/css" href="/assets/css/bootstrap.css">
                <link rel="icon" href="/images/a.ico">
                <script src="/assets/js/jquery-3.6.0.min.js"></script>
                <script src="/assets/js/bootstrap.js"></script>
                <link rel="stylesheet" href="https://code.jquery.com/ui/1.12.1/themes/base/jquery-ui.css">
                <script src="https://code.jquery.com/jquery-3.6.0.js"></script>
                <script src="https://code.jquery.com/ui/1.13.2/jquery-ui.js"></script>
                <script src="/assets/js/search-box.js"></script>
                <!-- <script>
                    var searchUrl = "<?php echo base_url('/autocomplete'); ?>";
                </script>
                <script>
                    var postUrl = "<?php echo base_url('/post/')?>";
                </script> -->
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
                <a class="navbar-brand">AQademy</a>
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
            
            <div class="container">
                
            </div>
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