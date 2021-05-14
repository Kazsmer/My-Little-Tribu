<!DOCTYPE html>
<html lang="en">

<?php 
get_header();
?>

<body>
<?php get_template_part('partials/header.tpl');?>

<main id="main">


    <div class="site-section site-portfolio">
      <div class="container">
        <div class="row mb-5 align-items-center">
          <div class="col-md-12 col-lg-6 mb-4 mb-lg-0" data-aos="fade-up">
            <h2>John Doe</h2>
            <div>
              <p class="mb-2">Ma super tribu</p>
            </div>
          </div>
          <div class="col-md-12 col-lg-6 text-left text-lg-right" data-aos="fade-up" data-aos-delay="100">
            <select class="custom-select select-filter">
              <option selected="" value="">
                Evenement
              </option>
              <option value="">
                Design
              </option>
              <option value="">
                Branding
              </option>
              <option value="">
                Photography
              </option>
            </select>
            <select class="custom-select select-filter">
              <option selected="" value="">
                Date
              </option>
              <option value="">
                Design
              </option>
              <option value="">
                Branding
              </option>
              <option value="">
                Photography
              </option>
            </select>
            <select class="custom-select select-filter">
              <option selected="" value="">
                Personne
              </option>
              <option value="">
                Design
              </option>
              <option value="">
                Branding
              </option>
              <option value="">
                Photography
              </option>
            </select>
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
            
            <?php
                if(have_posts()) {
                    while(have_posts()) {
                        the_post();
                        echo '<img class="featured_image" src="' . get_the_post_thumbnail_url() . '"/>';
                        echo '<h1>' . the_title() . '</h1>';

                        echo '<section class="article__content">';
                            the_content();
                        echo '</section>';
                        // WARNING get_template_part fait des erreurs "silencieuses"
                        get_template_part('partials/article-informations.tpl');
                        get_template_part('partials/article-categories.tpl');
                    }
                }
            ?>
              <img class="img-fluid" src="<?= get_theme_file_uri('assets/img/img_1.jpg');?>">
            </a>
          </div>


         <div class="item photography col-sm-6 col-md-4 col-lg-4 mb-4">
            <a href="work-single.html" class="item-wrap fancybox">
              <img class="img-fluid" src="<?= get_theme_file_uri('assets/img/img_1.jpg');?>">
            </a>
          </div>
          <div class="item branding col-sm-6 col-md-4 col-lg-4 mb-4">
            <a href="work-single.html" class="item-wrap fancybox">
              <img class="img-fluid" src="<?= get_theme_file_uri('assets/img/img_1.jpg');?>">
            </a>
          </div>
          <div class="item design col-sm-6 col-md-4 col-lg-4 mb-4">
            <a href="work-single.html" class="item-wrap fancybox">
              <img class="img-fluid" src="<?= get_theme_file_uri('assets/img/img_1.jpg');?>">
            </a>
          </div>
          <div class="item photography col-sm-6 col-md-4 col-lg-4 mb-4">
            <a href="work-single.html" class="item-wrap fancybox">
              <img class="img-fluid" src="<?= get_theme_file_uri('assets/img/img_1.jpg');?>">
            </a>
          </div>
          <div class="item branding col-sm-6 col-md-4 col-lg-4 mb-4">
            <a href="work-single.html" class="item-wrap fancybox">
              <img class="img-fluid" src="<?= get_theme_file_uri('assets/img/img_1.jpg');?>">
            </a>
          </div>
          <div class="item branding col-sm-6 col-md-4 col-lg-4 mb-4">
            <a href="work-single.html" class="item-wrap fancybox">
              <img class="img-fluid" src="<?= get_theme_file_uri('assets/img/img_1.jpg');?>">
            </a>
          </div>
          <div class="item design col-sm-6 col-md-4 col-lg-4 mb-4">
            <a href="work-single.html" class="item-wrap fancybox">
              <img class="img-fluid" src="<?= get_theme_file_uri('assets/img/img_1.jpg');?>">
            </a>
          </div>
          <div class="item photography col-sm-6 col-md-4 col-lg-4 mb-4">
            <a href="work-single.html" class="item-wrap fancybox">
              <img class="img-fluid" src="<?= get_theme_file_uri('assets/img/img_1.jpg');?>">
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
