<!DOCTYPE html>
<html lang="en">

<?php 
use MyLittleTribu\Model\GuestTribeModel;


get_header();
?>

<body>
<?php get_template_part('partials/header.tpl');
?>


<main id="main">

  <?php
    // La tribu et les posts si tu es créator
    $user = wp_get_current_user();
    $userID = $user->ID;
  
    //Nom de l'utilisateur courant 
    $usersName = get_users( array( 'include' => [$userID]));
    $currentUsersName = $usersName[0]->user_login;
  
    // Selection de la tribu en fonction du user courant
    $usertribe = new WP_Query( array( 'author' => $userID, 'post_type' => 'tribe' ) );
    $chosetribe = $usertribe->posts;

    // PREMIERE BOUCLE 
    
      foreach ($chosetribe as $chose) {
        // Photos de la tribu
        $args = array(
          'meta_value' => $chose->ID,
          'post_type'  => 'photo'
        );
        $query = new WP_Query( $args );
  
        // Toutes les photos
        $photo = $query->posts;
        $counterPhots = count($photo);
  
        $photoL = $query->posts;
        
      echo '<div class="site-section site-portfolio">';
        echo '<div class="container">';
          echo '<div class="row mb-5 align-items-center">';
            echo '<div class="col-md-12 col-lg-6 mb-4 mb-lg-0" data-aos="fade-up">';
              echo '<h2>Bonjour, ' . $currentUsersName . '</h2>';
              echo '<div>';
              echo '<p class="mt-3"> Ma tribu -> <strong>' . $chose->post_title .'</strong></p>';
              echo '</div>';
            echo '</div>';
          echo '<div class="col-md-12 col-lg-6 text-left text-lg-right" data-aos="fade-up" data-aos-delay="100">';
        echo '</div>';
        echo '<div class="col-md-6 mt-4" data-aos="fade-up" data-aos-delay="100">';
          echo '<button class="readmore d-block w-50"> Ajouter une image </button>';
          echo '<a href="#" style="color: rgb(255, 87, 87); font-size: 9pt;">Supprimer ma tribu</a>';
        echo '</div>';
        echo '</div>';
          echo '<div id="portfolio-grid" class="row no-gutter" data-aos="fade-up" data-aos-delay="200">';
          // Toutes les photos
          foreach ($photoL as $all) {
                    // Les Taxonomies de tous les posts
                      $terms = get_terms( array(
                        'post_type' => 'photo',
                        'p' => $all->ID,
                        'taxonomy' => array ('person', 'event'),
                        'hide_empty' => false,
                      ) );
              echo '<div class="item web col-sm-6 col-md-4 col-lg-4 mb-4">';
              echo '<a href="work-single.html" class="item-wrap fancybox">';
              //echo '<h1  class="mb-3">' . $all->post_title . '</h1>';
              echo '<div style="display: flex;" class="mb-3">';
              foreach ($terms as $terms) {
                  echo '<span class="badge badge-info mr-1">'. $terms->slug .'</span>';
              }
              echo '</div>';
              echo '<div style="width:350px; height:350px; overflow: hidden;">';
                echo '<img class="img-zoom" src="' . get_the_post_thumbnail_url($all->ID, 'large') . '">';
                //echo '<div style="background-size: cover; background: url(' . get_the_post_thumbnail_url($all->ID, 'medium') . '); width:350px; height:350px;"></div>';
                //echo get_the_post_thumbnail( $all->ID, 'large', array('class' => 'img-fluid') );
              echo '</div>';
              echo '</a>';
              echo '</div>';

          }
          echo '</div>';
        echo '</div>';
      echo '</div>';
      }
  
     
    // La tribu et les posts si tu es guest (d'une seul tribu)
    $guestTribeModel = new GuestTribeModel();
    $tribeParticipations = $guestTribeModel->getTribeByGuestId($userID);
    foreach ($tribeParticipations as $tribes) {
      // ID de la tribu
      $args = array(
        'post_type' => 'tribe',
        'p' => $tribes->tribe_id
      );
      $querytribe = new WP_Query( $args );
    
      // Nom de la tribu
      $tribeTitle = $querytribe->posts[0]->post_title;
  
          // Photos de la tribu
      $args = array(
        'meta_value' => $tribes->tribe_id,
        'post_type'  => 'photo'
      );
      $query = new WP_Query( $args );
  
      // Toutes les photos
      $photo = $query->posts;
      $counterPhots = count($photo);
  
      $photoL = $query->posts;
    
    // DEUXIEME BOUCLE 
    // les users guest
    $guestTribeModel = new GuestTribeModel();
    $guestParticipations = $guestTribeModel->getGuestByTribeId($tribes->tribe_id);
  

    echo '<div class="site-section site-portfolio">';
    echo '<div class="container">';
      echo '<div class="row mb-5 align-items-center">';
        echo '<div class="col-md-12 col-lg-6 mb-4 mb-lg-0" data-aos="fade-up">';
          echo '<div>';
          echo '<p class="mb-2"> Tribu Invité -> <strong>' . $tribeTitle .'</strong></p>';
          echo '</div>';
        echo '</div>';
      echo '<div class="col-md-12 col-lg-6 text-left text-lg-right" data-aos="fade-up" data-aos-delay="100">';
    echo '</div>';
    echo '<div class="col-md-6 mt-4" data-aos="fade-up" data-aos-delay="100">';
      echo '<button class="readmore d-block w-50"> Ajouter une image </button>';
    echo '</div>';
    echo '</div>';
      echo '<div id="portfolio-grid" class="row no-gutter" data-aos="fade-up" data-aos-delay="200">';
      // Toutes les photos
      foreach ($photoL as $all) {
                // Les Taxonomies de tous les posts
                  $terms = get_terms( array(
                    'post_type' => 'photo',
                    'p' => $all->ID,
                    'taxonomy' => array ('person', 'event'),
                    'hide_empty' => false,
                  ) );

          echo '<div class="item web col-sm-6 col-md-4 col-lg-4 mb-4">';
          echo '<a href="work-single.html" class="item-wrap fancybox">';
          echo '<h1  class="mb-3">' . $all->post_title . '</h1>';
          echo '<div style="display: flex;" class="mb-3">';
          foreach ($terms as $terms) {
              echo '<span class="badge badge-info mr-1">'. $terms->slug .'</span>';
          }
          echo '</div>';
          echo '<img class="img-zoom" src="' . get_the_post_thumbnail_url($all->ID, 'large') . '">';
          echo '</a>';
          echo '</div>';

      }
      echo '</div>';
    echo '</div>';
  echo '</div>';

    }
  ?>

    <!--<div class="site-section site-portfolio">
      <div class="container">
        <div class="row mb-5 align-items-center">
          <div class="col-md-12 col-lg-6 mb-4 mb-lg-0" data-aos="fade-up">
            <h2><?= $currentUsersName ?></h2>
            <div>
              <p class="mb-2"><?= $tribeTitle ?></p>
            </div>
          </div>
          <div class="col-md-12 col-lg-6 text-left text-lg-right" data-aos="fade-up" data-aos-delay="100">
          </div>
          <div class="col-md-6 mt-4" data-aos="fade-up" data-aos-delay="100">
            <button class="readmore d-block w-50">
              Ajouter une image
            </button>

            <a href="#" style="color: rgb(255, 87, 87); font-size: 9pt;">Supprimer ma tribu</a>
          </div>
        </div>
        <div id="portfolio-grid" class="row no-gutter" data-aos="fade-up" data-aos-delay="200">
          <div class="item web col-sm-6 col-md-4 col-lg-4 mb-4">
            <a href="work-single.html" class="item-wrap fancybox">
              <h1>Blabla</h1>
              <img class="img-fluid" src="<?= get_theme_file_uri('assets/img/img_1.jpg');?>">
            </a>
          </div>
        </div>
      </div>
    </div>-->



</main>

  <?php get_template_part('partials/footer.tpl');?>
  <?php 
get_footer();
?>

</body>

</html>
