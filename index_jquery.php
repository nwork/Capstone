<!DOCTYPE html>
<html>
  <head>
    <title>Get Data From a MySQL Database Using jQuery and PHP</title>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/2.1.3/jquery.min.js"></script>
    <script>
      $(document).ready(function(){
        // Set form variable
        var form = $('#search_form');
        
        // Hijack form submit
        form.submit(function(event){
          // Set username variable
          var username = $('#username').val(); 
          
          // Check if username value set
          if ( $.trim(username) != '' ) {
            // Process AJAX request
            $.post('process.php', {name: username}, function(data){
              // Append data into #results div
              $('#results').html(data);
            });
          }
          
          // Prevent default form action
          event.preventDefault();
        });
      });
    </script>
  </head>
  <body>
    <span>Search by name: </span>
    <form method="POST" action="process.php" id="search_form">
      <input type="text" id="username" name="name">
      <input type="submit" id="submit" value="Search">
    </form>
    <div id="results"></div>
  </body>
</html>
