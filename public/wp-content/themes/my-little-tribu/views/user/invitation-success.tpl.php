<!DOCTYPE html>
<html lang="en">

<?php get_header(); ?>



<body>
  <?php get_template_part('partials/header.tpl');?>
  <main id="main">
    <div class="site-section">
      <div class="site-section pb-0">
        <div class="container">
            <h2 class="mt-4 text-center">Votre invitation a bien été envoyée!</h2>
            <div class="col-lg-12">
                <div class="px-0 mt-2 col-md-12 col-sm-9 col-sm-12 col-12 b-button-right">
                    <a class="col-md-8 col-sm-9 col-sm-12 col-12 readmore bg-warning text-center mt-5 mx-auto" href="<?=get_home_url();?>/single-private-page">
                        Revenir vers ma tribu
                    </a>
                </div>
            </div>
        </div>
      </div>
  </main>
  
  <?php get_template_part('partials/footer.tpl');?>
 

  
 <?php 
 get_footer();
 ?>
  

</body>

</html>