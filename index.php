<!doctype html>
<html lang="en">
  <head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css" integrity="sha384-Vkoo8x4CGsO3+Hhxv8T/Q5PaXtkKtu6ug5TOeNV6gBiFeWPGFN9MuhOf23Q9Ifjh" crossorigin="anonymous">

    <title>MyCRUD@kingslayer</title>
  </head>
  <body>
    <div class="container mt-2 mb-4 p-2 shadow bg-white">
      <form action="CRUDquery.php" method="POST">
         <div class="form-row justify-content-center">
           <div class="col-auto">
              <input type="text" name="username" class="form-control" id="username" placeholder="User name">
           </div> 
           <div class="col-auto">
              <input type="text" name="password" class="form-control" id="password" placeholder="Password">
           </div>
           <div class="col-auto">
              <button type="submit" name="save" class="btn btn-info">Save</button>
           </div>
         </div>
      </form>
    </div>
    <?php require_once("CRUDquery.php"); ?>

    <div class="container">
       <?php if(isset($_SESSION['msg'])): ?>
       <div class="<?= $_SESSION['alert']; ?>">
          <?= $_SESSION['msg']; 
          unset($_SESSION['msg']); ?>
       </div>
       <?php endif; ?>

       <table class="table">
          <thead>
              <tr>
                  <th>Id</th>
                  <th>User Name</th>
                  <th>Password</th>
                  <th>Action</th>
              </tr>
          </thead>
          <tbody>
              <form action="CRUDquery.php" method="POST">
              <?php 
              #coding to display user data
              $sQuery = "SELECT * FROM account LIMIT 20";
              $result = $conn->query($sQuery);

              # coding for edit button
              $x = 1;

              while($row = $result->fetch_assoc()): ?>
              <tr>
                  <td><?= $row['id']; ?></td>
                  <td><?= $row['username']; ?></td>
                  <td><?= $row['password']; ?></td>
                  <td style="width: 15%;">
                      <button type="submit" name="delete" value="<?= $row['id']; ?>" class="btn btn-danger">Delete</button>
                      <button type="button" name="edit" value="<?= $x; $x++;?>" class="btn btn-primary">Edit</button>
                  </td>
              </tr>
            
             <?php endwhile; ?>
             </form> 
          </tbody>
       </table>


    </div>
    <script src="https://code.jquery.com/jquery-3.4.1.slim.min.js" integrity="sha384-J6qa4849blE2+poT4WnyKhv5vZF5SrPo0iEjwBvKU7imGFAV0wwj1yYfoRSJoZ+n" crossorigin="anonymous"></script> 
    <script type="text/javascript">
       $(document).ready(function(){
           setTimeout(function(){
               $(".alert").remove();
           }, 3000);

           $(".btn-primary").click(function() {
               $(".table").find('tr').eq(this.value).each(function(){
                   $("#username").val($(this).find('td').eq(1).text());
                   $("#password").val($(this).find('td').eq(2).text());
                   $(".btn-info").val($(this).find('td').eq(0).text());
               });
               $(".btn-info").attr("name", "edit");
           });
       });
    </script>
  </body>
</html>