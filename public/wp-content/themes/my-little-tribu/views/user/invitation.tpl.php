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
          <form method="post" action="<?=get_home_url();?>/user/invitation-success" class="row" data-aos="fade-up">
            <div class="col-lg-12">
              <div class="col-lg-12 px-0 pb-4">
                <div class="input-group">
                <?php
                // recupere guest 

                // recupere le user courant OK
                // recupere les users incrit sur le site (guest & creator)
                // attention si courant user = un utilisateur inscrit "css-hidden"

                $user = wp_get_current_user();
                $userID = $user->ID;
                
                    $blogusers = get_users( array( 'role__in' => [] ) );

                    echo '<select name="invitation" class="custom-select" id="exampleFormControlSelect1"">';
                    echo '<option selected >Invite une personne dans ta tribu</option>';
                      foreach ( $blogusers as $user ) {
                        if($user->ID === $userID){
                          //unset($blogusers[$userID]);
                          echo '<option value="" style="display:none"></option>';
                        }else{
                          echo '<option value="' . $user->ID .'">' . esc_html( $user->user_login ) . '</option>';
                        }
                      }
                    echo '</select>';
                ?>
                </div>
                </div>
                  <div class="px-0 mt-2 col-md-12 col-sm-9 col-sm-12 col-12 b-button-right">
                   <button class="col-md-12 col-sm-9 col-sm-12 col-12 readmore">
                     <a href="<?=get_home_url();?>/user/invitation-success"> Envoyer </a>
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