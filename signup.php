<?php include_once('./partials/header.php'); ?>

<?php

// import db
require_once("./connection.php");
// Craete Session
session_start();
session_destroy();

// See What happen in session
// print_r($_SESSION);




// When Submit information 
if (isset($_REQUEST['btnSignUp'])) {


   $fullname = $_REQUEST['fullName'];
   $username = $_REQUEST['userName'];
   $emailUser = $_REQUEST['email'];
   $passwordUser = $_REQUEST['passowrdUser'];

   // // Select All Users
   // $data_select = "SELECT * FROM users ";
   // // get all data 
   // // $results  =mysqli_query($conn,$data_select);
   // // Row of data 
   // // $data =  mysqli_fetch_assoc($results);
   // // print($data["password"]);
   $hash_pass = password_hash($passwordUser, PASSWORD_DEFAULT);
   $craeted = date('Y.m.d H.i.s');

   $sql = "INSERT INTO users (fullname,username,email,password,created) VALUES ('$fullname','$username','$emailUser','$hash_pass','$craeted')";

   $results = mysqli_query($conn, $sql);
   if ($results) {
      header("location:signup.php?msg=success");
   }else{
      header("location:signup.php?msg=danger");
   }
}



?>


<div class="container" style="max-width: 600px;">
   <?php if (isset($_REQUEST['msg'])) : ?>
      <div class="notification is-<?php echo $_REQUEST['msg']?>">
         <button class="delete"></button>
         <?php if ($_REQUEST['msg'] ==='success'):?>
            <p>Your Registration is valid </p>
         <?php elseif ($_REQUEST['msg'] ==='danger'):?>  
            <p>Your Registration is invalid </p>

         <?php endif ?>
      </div>
   <?php endif ?>
   <section class="section is-small">
      <h4 class="title">Sign Up</h4>
      <form method="post" action="./signup.php">
         <div class="field">
            <label class="label">Full Name</label>
            <div class="control">
               <input class="input" name="fullName" type="text" placeholder="Your Full Name" required>
            </div>
         </div>
         <div class="field">
            <label class="label">User Name</label>
            <div class="control">
               <input class="input" name="userName" type="text" placeholder="Your User Name" required>
            </div>
         </div>
         <div class="field">
            <label class="label">Email</label>
            <div class="control">
               <input class="input" name="email" type="email" placeholder="Your Email" required>
            </div>
         </div>
         <div class="field">
            <label class="label">Password</label>
            <div class="control">
               <input class="input" name="passowrdUser" type="password" placeholder="password" required minlength="8">
            </div>
         </div>
         <div class="control">
            <button class="button is-link" name="btnSignUp">Sign Up</button>
         </div>
      </form>
   </section>


</div>



<?php include_once('./partials/footer.php'); ?>