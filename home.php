<?php include_once('./partials/header.php'); ?>

<?php session_start(); ?>

<section class="hero">
  <div class="hero-body">
    <?php if (isset($_SESSION['user'])) : ?>
      <p class="title">
        Home Page
      </p>
      <p class="subtitle">
        Welcome <?php echo $_SESSION['user']['username'] ?>
      </p>
      <p class="subtitle">
        Your ID: <?php echo $_SESSION['user']['id'] ?>
      </p>
      <p class="subtitle">
        Your Email:<span class="has-text-primary"> <?php echo $_SESSION['user']['email'] ?></span>
      </p>
      <a class="button is-primary" href="logout.php">
        Log Out
      </a>
  </div>
<?php else : ?>
  <p class="title is-danger">You Must be Logged ...</p>
<?php endif ?>


</section>

<?php include_once('./partials/footer.php'); ?>