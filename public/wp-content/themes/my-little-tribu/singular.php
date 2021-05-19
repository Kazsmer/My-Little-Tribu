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
              // echo '<h2>Bonjour, ' . $currentUsersName . '</h2>';
              echo '<div>';
              echo '<h2 class="mt-3"> Bienvenue dans votre tribu <strong>' . $chose->post_title .'</strong></h2>';
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
                      $tax0 = 'event';
                      $tax1 = 'person';
                      $terms0 = get_the_terms( $all->ID, $tax0 );
                      $terms1 = get_the_terms( $all->ID, $tax1 );
                      $i=0;
              echo '<div class="item web col-sm-6 col-md-4 col-lg-4 mb-4">';
              echo '<a href="work-single.html" class="item-wrap fancybox">';
              //echo '<h1  class="mb-3">' . $all->post_title . '</h1>';
              echo '<div style="display: flex;" class="mb-3">';
              if(empty($terms0)){
                echo '<span class="badge badge-info mr-1"></span>';
              }else{
                foreach ($terms0 as $terms) {
                  $i++;
                  echo '<span class="badge badge-pill badge-info mr-1">'. $terms->slug .'</span>';
                  if($i == '2'){
                    break;
                  }
                }
              }
              if(empty($terms1)){
                echo '<span class="badge badge-info mr-1"></span>';
              }else{
                  foreach ($terms1 as $terms) {
                    $i++;
                      echo '<span class="badge badge-pill badge-warning mr-1">'. $terms->slug .'</span>';
                      if($i == '2'){
                        break;
                      }
                  }
              }
              echo '</div>';
              //$categoriesList = get_the_category($all->ID);
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
          echo '<h2 class="mb-2"> Vous êtes invité dans la tribu <strong>' . $tribeTitle .'</strong> </h2>';
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
                    $tax0 = 'event';
                    $tax1 = 'person';
                    $terms0 = get_the_terms( $all->ID, $tax0 );
                    $terms1 = get_the_terms( $all->ID, $tax1 );

          echo '<div class="item web col-sm-6 col-md-4 col-lg-4 mb-4">';
          echo '<a href="work-single.html" class="item-wrap fancybox">';
        
          echo '<div style="display: flex;" class="mb-3">';
          if(empty($terms0)){
            echo '<span class="badge badge-info mr-1"></span>';
          }else{
            foreach ($terms0 as $terms) {
              echo '<span class="badge badge-info mr-1">'. $terms->slug .'</span>';
            }
          }
          if(empty($terms1)){
            echo '<span class="badge badge-info mr-1"></span>';
          }else{
              foreach ($terms1 as $terms) {
                  echo '<span class="badge badge-info mr-1">'. $terms->slug .'</span>';
              }
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

</main>

  <?php get_template_part('partials/footer.tpl');?>
  <?php 
get_footer();
?>

</body>

</html>
