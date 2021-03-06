<!DOCTYPE html>
<html lang="en">

<!-- header -->
<?php require '../view/frontend/require/pageHeadTemplate.php' ?>

<body>

  <!-- Navigation -->
  <?php require '../view/frontend/require/navbar.php' ?>

  <!-- Page Head -->
  <?php require '../view/frontend/require/pageHeadTemplate.php'; ?>

  <!-- Page Header -->
  <?php require '../view/frontend/require/postHeader.php' ?>

  <!-- Post Content -->
  <article>
    <div class="container">
      <?php

      // We display the post content from the DB 
      echo $post['content']; 
      
      // We check whether the commentary form was filled 
      if($_SERVER['REQUEST_METHOD'] == 'POST'){ 
        echo '<br><p id="commentarySpace"><b>Votre commentaire a bien été soumis. Il sera soumis à validation par l\'auteur de l\'article</b></p><br>'; 
      }
      ?> 
      <br>

      <!-- We display the form allowing to post comments-->
      <h1 >Espace commentaires</h1>
      <form action="index.php?action=post&id= <?= filter_input(INPUT_GET, "id", FILTER_SANITIZE_NUMBER_INT) ?>#commentarySpace" class="comments_form" method="POST">
        <input type="hidden" name="postId" value=" <?= filter_input(INPUT_GET, "id", FILTER_SANITIZE_NUMBER_INT) ?> ">
        <label class= "nameLabel_comments_form">Votre nom</label> <br> <input type="text" name="commentAuthor" class= "nameInput_comments_form"><br>
        <label class= "commentLabel_comments_form">Votre commentaire</label> <br> <textarea name="commentContent" class= "commentContent_comments_form"></textarea><br>
        <button type="submit" name="submit">Envoyer</button>
      </form>
      <br>
      <?php

      	//We get the comments of a post
      	require '../view/frontend/require/getPostComments.php'; 
       ?>
    </div>
  </article>

  <hr>

    <!-- Footer -->
    <?php require("../view/frontend/require/footer.php") ?>
 
    <!-- bootstrap footer -->
   <?php require("../view/frontend/require/boostrapFooter.php") ?>

</body>
</html>
