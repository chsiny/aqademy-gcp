$(document).ready(function() {
  $('button#upvote-btn').click(function(e) {
      e.preventDefault(); // prevent default form submission
      var post_id = $(this).data('post-id'); // get the post ID from the button data attribute
      console.log('Post ID:', post_id); // Debug statement
      var btn = $(this); // store the button element in a variable
      $.ajax({
          type: 'POST',
          url: '../../upvote.php',
          data: { 'post_id': post_id }, // replace 'csrfToken' with your actual token
          dataType: 'json',
          success: function(response) {
              console.log('Response:', response); // Debug statement
              if (response.status === 'success') {
                  var upvotes = parseInt(response.upvotes);
                  $('small#upvote').text(upvotes);
                  btn.prop('disabled', true); // disable the button after upvoting
              }
          },
          error: function() {
              alert('Error upvoting post.'); // display an error message if the AJAX request fails
          }
      });
  });
});