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
                <a class="navbar-brand">AQademy</a>
                
                <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
                    <span class="navbar-toggler-icon"></span>
                </button>
                <div class="collapse navbar-collapse" id="navbarNav">

                    
                    <ul class="navbar-nav ml-auto">
                        <li class="nav-item">
                            <a class="nav-link" href="index.php">Login</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="register.php">Register</a>
                        </li>
                    </ul>
                </div>
            </nav>
            
            <div class="container">
                <div class="col-4 offset-4">
                    <br><br>

                            <h2 class="text-center">Login</h2> 
                            <br><br>      
                            <form action="login.php" method="post">
                                <div class="form-group">
                                    <input type="text" class="form-control" placeholder="Username" required="required" name="username">
                                </div>
                                <div class="form-group">
                                    <input type="password" class="form-control" placeholder="Password" required="required" name="password">
                                </div>

                                <div class="form-group">
                                    <button type="submit" class="btn btn-primary btn-block">Log in</button>
                                </div>
                                <div class="clearfix">
                                    <label class="float-left form-check-label"><input type="checkbox" name="remember"> Remember me</label>
                                    <!-- <a href="<?php echo base_url('forget_password')?>" class="float-right">Forgot Password?</a> -->
                                </div>
                            </form>
                </div>
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