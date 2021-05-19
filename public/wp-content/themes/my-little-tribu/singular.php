<!DOCTYPE html>
<html lang="en">

<?php 
get_header();

  // Private-Page
    // -> Lien <a>
     // -> Premalink (post->private_page)
  
  // PhotoDetails
    // var_dump (get_post)
     //blabla

      // (post_id->private_page) === (post_id->photo_details)

      //get_the_category (event)


?>

<?php 

  if(have_posts()) : while (have_posts()) : the_post();

?>


<body>
<?php get_template_part('partials/header.tpl');?>
  <main id="main">
    <div class="site-section">
      <div class="container">
        <div class="row mb-5 align-items-center">
          <div class="col-md-12 col-lg-6 mb-4 mb-lg-0" data-aos="fade-up">
            <h2><?php the_title() ?></h2>
            <div>
            <?php
            // charge le post courant
              get_post();
              // récupèrer la valeur du post meta (liste de tableaux)
              $customMeta = get_post_meta(get_post()->ID,'', true);
              //var_dump($customMeta);
              // boucle sur les tableaux                 
              $i=0;
              foreach ($customMeta as $customMeta) {
                $i++;
                //var_dump($customMeta);
                if($i == 3){
                  // recuperation de l'id de la tribu dans le 4eme tableaux
                $id = $customMeta[0];
                //var_dump($id);
                break;
                }
              }

              // chercher dans le CPT tribu le post de l'id recupere
              $args = array(
                'post_type' => 'tribe',
                'p' => $id
              );

              $querytribe = new WP_Query( $args );
              // Nom de la tribu
              $tribeTitle = $querytribe->posts[0]->post_title;

              echo '<p class="mb-2">' . $tribeTitle . '</p>'
            ?>
            </div>
          </div>
        </div>
      </div>

      <div class="site-section pb-0">
        <div class="container">
          <div class="row align-items-stretch">
            <div class="col-md-8" data-aos="fade-up">
              <img src="<?php the_post_thumbnail_url() ?>" alt="Image" class="img-fluid">
            </div>
            <div class="col-md-3 ml-auto" data-aos="fade-up" data-aos-delay="100">
              <div class="sticky-content">
                <h3 class="h3">Doe Garcia</h3>
                <p class="mb-4"><span class="text-muted">My super tribu</span></p>

                <div>
                  <p>Super ! :)</p>

                </div>
              </div>
              <div class="sticky-content mt-4">
                <h3 class="h3">Doe Marietta</h3>
                <p class="mb-4"><span class="text-muted">My super tribu</span></p>

                <div>
                  <p>Marietta ! :)</p>

                </div>
              </div>
            </div>
          </div>
        </div>
      </div>


      <div class="site-section pb-0">
        <div class="container">
          <div class="row justify-content-center text-center mb-4">
            <div class="col-12">
              <h3 class="h3 heading">Laissez un commentaire !</h3>
              <?php comment_form([
                'title_reply' => '',
                'class_container' => 'col-12',
                'class_form' => 'col-12',
                'class_submit' => 'col-12'
                ])?>
              <form action="">
                <div class="form-group w-100">
                  <textarea class="form-control" id="exampleFormControlTextarea1" rows="3"></textarea>
                </div>
                <div class="center">
                  <button class="readmore d-block w-50">
                    Ajouter un commentaire
                  </button>
                </div>
              </form>
            </div>
          </div>
          <div class="justify-content-end">
            <a class="mt-5" href="#" style="color: rgb(255, 87, 87); font-size: 9pt;">Supprimer ma tribu</a>
          </div>
        </div>
      </div>

      <?php
      endwhile; endif; 
      ?>
  </main>
  <?php get_template_part('partials/footer.tpl');?>
  <?php 
get_footer();
?>

</body>

</html>