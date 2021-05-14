<!DOCTYPE html>
<html lang="en">


 <?php 
get_header();
?>


<body>
  <?php get_template_part('partials/header.tpl');?>
  <main id="main">
    <div class="site-section">

      <div class="site-section pb-0">
        <div class="container">

        <?php
            // array_key_exists est comme un isset mais en plus rigoureux
            if(array_key_exists('error', $args)) {
                echo '<div class="error">';
                    echo $args['message'];
                echo '</div>';
            }
        ?>
          <form  method="post" action="<?=get_home_url();?>/user/checkLogin" class="row" data-aos="fade-up">
            <div class="col-lg-12">
              <div class="col-lg-12 px-0 pb-4">
                <div class="input-group">
                  <input type="email" name="email" class="form-control" id="inputPassword2" placeholder="Ton email">
              </div>
            </div>
            <div class="col-lg-12 px-0 pb-4">
              <div class="input-group">
                <input type="password" name="password" class="form-control" id="inputPassword2" placeholder="Ton mot de passe">
            </div>
          </div>
              <div class="px-0 mt-2 col-md-12 col-sm-9 col-sm-12 col-12 b-button-right">
                <button class="col-md-12 col-sm-9 col-sm-12 col-12 readmore">
                  Connexion
                </button>
              </div>
              <div class="col-auto px-0 pt-4">
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