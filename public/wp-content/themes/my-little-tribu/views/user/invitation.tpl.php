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
          <form method="post" action="<?=get_home_url();?>/user/invitation" class="row" data-aos="fade-up">
            <div class="col-lg-12">
              <div class="col-lg-12 px-0 pb-4">
                <div class="input-group">
                  <input type="text" name="invitation" class="form-control" id="inputPassword2" placeholder="Invite une personne dans ta tribu">
                </div>
                </div>
                <div class="px-0 mt-2 col-md-12 col-sm-9 col-sm-12 col-12 b-button-right">
                <button class="col-md-12 col-sm-9 col-sm-12 col-12 readmore">
                  Envoyer
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