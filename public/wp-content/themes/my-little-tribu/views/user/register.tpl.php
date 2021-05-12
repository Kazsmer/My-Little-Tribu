<!DOCTYPE html>
<html lang="en">



<?php 
get_header();
?>


<body>
  <?php get_template_part('partials/header.tpl');?>
  <main id="main">
    <?php
      if(array_key_exists('error', $args)) {
          echo '<div class="class error">';
              echo '<ul>';
              foreach($args['messages'] as $message) {
                  echo '<li>' . $message . '</li>';
              }
              echo '</ul>';
          echo '</div>';
      }
    ?>
    <div class="site-section">

      <div class="site-section pb-0">
        <div class="container">
          <form method="post" action="<?=get_home_url();?>/user/register" class="row" data-aos="fade-up" >
            <div class="col-lg-12">
              <div class="flex px-0 pb-4">              
                <div class="col-lg-6 pl-0">
                  <div class="input-group">
                    <input type="text" name="prenom" class="form-control" id="inputPassword2" placeholder="Ton prénom">
                  </div>
                </div>
                <div class="col-lg-6 px-0">
                  <div class="input-group">
                    <input type="text" name="nom" class="form-control" id="inputPassword2" placeholder="Ton nom">
                  </div>
                </div>
              </div>
              <div class="flex px-0 pb-4">              
                <div class="col-lg-6 pl-0">
                  <div class="input-group">
                    <input type="email" name="email" class="form-control" id="inputPassword2" placeholder="Ton email">
                  </div>
                </div>
                <div class="col-lg-6 px-0">
                  <div class="input-group">
                    <input type="password" name="password" class="form-control" id="inputPassword2" placeholder="Ton mot de passe">
                  </div>
                </div>
              </div>
              <div class="px-0 mt-5 col-md-12 col-sm-9 col-sm-12 col-12 b-button-right">
                <button class="col-md-12 col-sm-9 col-sm-12 col-12 readmore">
                  Créer mon compte
                </button>
              </div>
            </div>
            </form>
        </div>
      </div>
  </main>
  
  <?php get_template_part('partials/footer.tpl');?>
 

  
 <?php 
 get_footer();
 ?>
  

</body>

</html>
