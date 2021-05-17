<!DOCTYPE html>
<html lang="en">

<?php 
use MyLittleTribu\Model\GuestTribeModel;

get_header();
?>

<body>
 <?php get_template_part('partials/header.tpl');?> 
 <main id="main">
    <div class="site-section">
      <div class="container">
        <div class="row mb-5 align-items-center">
          <div class="col-md-12 col-lg-6 mb-4 mb-lg-0" data-aos="fade-up">
            <h2>Partager une photo</h2>
            <div>
              <p class="mb-2">Avec ma super tribu</p>
            </div>
          </div>
        </div>
      </div>

      <div class="site-section pb-0">
        <div class="container">
          <form class="row" data-aos="fade-up" action="<?=get_home_url();?>/processUpload" method="post" enctype="multipart/form-data">
            
            <div class="col-lg-6">
              
              <div class="col-lg-12 px-0 pb-4">
                  <input type="text" class="form-control" id="photoTitle" placeholder="Titre de la photo">
              </div>
              
              <div class="flex">              
                
                <div class="col-lg-6 pl-1">
                </div>
                
              </div>
              <div class="col-lg-12 px-0 pt-4">
                <div class="input-group">


                <?php
                  $user = wp_get_current_user();
                  // $user = $user->ID;
                  //var_dump($user);die;

                  $guestTribeModel = new GuestTribeModel();
                  $tribeParticipations = $guestTribeModel->getTribeByGuestId($user->ID);

                  // pour chaque association guest/tribe
                  echo '<fieldset>';
                   echo '<div>';
                     echo '<select class="custom-select" id="inputGroupSelect04" aria-label="Example select with button addon">';
                      echo '<option selected> Choisis ta Tribu </option>';
                      foreach ($tribeParticipations as $participation) {
                        $tribe = $participation->getTribe();
                        echo '<option value="'. $tribe->ID . '">' . $tribe->post_title . '</option>';
                      }
                     echo '</select>';
                   echo '<div>';
                  echo '</fieldset>';

                  ?>

                </div>
              </div>
              <div class="col-auto px-0 pt-4">
              </div>
            </div>

              <div class="col-lg-6" data-aos="fade-up" data-aos-delay="100">
                <div class="input-group">
                    <input type="file" class="form-control" id="inputGroupFile04" aria-describedby="inputGroupFileAddon04" style="height: 20vh;" name="photo">
                </div>
                <div class="px-0 mt-5 col-md-12 col-sm-9 col-sm-12 col-12 b-button-right">
                  <button class="col-md-12 col-sm-9 col-sm-12 col-12 readmore">
                    Ajouter une photo
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
