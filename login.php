<?php include_once('./partials/header.php'); ?>

<?php
// import db
require_once("./connection.php");
// Craete Session
session_start();



// check if session is exists
if (isset($_SESSION['user'])) {
   header("location:home.php");
}

if (isset($_REQUEST['btnLogin'])) {

   $emailUser = $_REQUEST['emailUser'];
   $passwordUser = $_REQUEST['passwordUser'];

   $sql = "SELECT * FROM users WHERE email='$emailUser'   LIMIT 1";

   $selectUser =  mysqli_query($conn, $sql);
   $row = mysqli_fetch_assoc($selectUser);


   if (mysqli_num_rows($selectUser) > 0) {

      if (password_verify($passwordUser, $row['password'])) {
         $_SESSION['user']['id'] = $row['id'];
         $_SESSION['user']['username'] = $row['username'];
         $_SESSION['user']['email'] = $row['email'];
         header('location:home.php');
      } else {
         header('location:login.php?msg=danger');
      }
   }
   
   if ($row['email'] !== $emailUser){
      header('location:login.php?msg=danger');

   }



}


?>

<div class="container" style="max-width: 600px;">
   <?php if (isset($_REQUEST['msg'])) : ?>
      <div class="notification is-<?php echo $_REQUEST['msg'] ?>">
         <button class="delete"></button>
         <?php if ($_REQUEST['msg'] === 'success') : ?>
            <p>Your Registration is valid </p>
         <?php elseif ($_REQUEST['msg'] === 'danger') : ?>
            <p>Your Registration is invalid </p>
         <?php endif ?>
      </div>
   <?php endif ?>
   <section class="section is-small">
      <h4 class="title">Login</h4>
      <form method="post">
         <div class="field">
            <label class="label">Email</label>
            <div class="control">
               <input class="input" name="emailUser" type="email" placeholder="Your Email" required>
            </div>
         </div>
         <div class="field">
            <label class="label">Password</label>
            <div class="control">
               <input class="input" name="passwordUser" type="password" placeholder="password" minlength="8" required>
            </div>
         </div>
         <div class="control">
            <button class="button is-link" name="btnLogin">Login</button>
         </div>
      </form>
   </section>


</div>

<?php include_once('./partials/footer.php'); ?>