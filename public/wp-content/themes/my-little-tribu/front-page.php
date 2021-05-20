<!DOCTYPE html>
<html lang="en">


<?php
get_header();
?>


<body>
  <?php get_template_part('partials/header-front-page.tpl'); ?>
  <main id="main">
    <div class="hero-banner" style="background-image: url('<?= get_theme_file_uri('assets/img/hero-banner.jpg'); ?>');background-repeat: no-repeat;background-size: cover;color:#fff;">
      <div class="container h-100 d-flex align-items-center">
        <div class="row mb-5 w-100">
          <div class="col-md-12 col-lg-6 mb-4 mb-lg-0" data-aos="fade-up">
            <h2 class="h2-img mb-3">Rejoins ta tribu !</h2>
            <div>
              <p class="mb-2">Le site pour partager des photos et vidéos dans un espace privé</p>
            </div>
            <form action="<?=get_home_url();?>/user/register" method="post">
              <button class="col-lg-5 col-md-5 col-sm-5 col-sm-5 col-5 readmore">
            </form>
            S'inscrire
            </button>
          </div>
        </div>
      </div>
    </div>
    <div class="site-section pb-0 h-100">
      <div class="container">
        <div class="row d-flex align-items-center justify-content-center">
          <div class="col-md-6" data-aos="fade-up">
            <img src="<?= get_theme_file_uri('assets/img/table.jpg'); ?>" alt="Image" class="img-fluid">
          </div>
          <div class="col-md-6 ml-auto" data-aos="fade-up" data-aos-delay="100">
            <div class="col-md-12 col-lg-7 mb-4 mb-lg-0 mx-auto" data-aos="fade-up">
              <h2>Le concept</h2>
              <div>
                <p class="mb-2">L’idée de My Little Tribu est née de personnes qui subissent l’éloignement, principalement géographique et souhaitent échanger facilement des moments de joie, avec leurs proches, grâce à ce merveilleux instrument qu’est une photographie.</p>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
    <div class="site-section pb-0 mb-5 h-100">
      <div class="container">
        <div class="row d-flex align-items-center justify-content-center">
          <div class="col-md-6 ml-auto" data-aos="fade-up" data-aos-delay="100">
            <div class="col-md-12 col-lg-7 mb-4 mb-lg-0 mx-auto" data-aos="fade-up">
              <h2>Partagez chaque instant</h2>
              <div>
                <p class="mb-2">My Little Tribu est le nouveau cocon de tous ceux que vous aimez et souhaitez retrouver!</p>
              </div>
            </div>
          </div>
          <div class="col-md-6" data-aos="fade-up">
            <img src="<?= get_theme_file_uri('assets/img/tree.jpg'); ?>" alt="Image" class="img-fluid">
          </div>
        </div>
      </div>
    </div>
    <div class="site-section pb-0 h-100" style="margin-bottom:15vh">
      <div class="container">
        <div class="row d-flex align-items-center justify-content-center">
          <div class="col-md-6" data-aos="fade-up">
            <img src="<?= get_theme_file_uri('assets/img/laptop.jpg'); ?>" alt="Image" class="img-fluid">
          </div>
          <div class="col-md-6 ml-auto" data-aos="fade-up" data-aos-delay="100">
            <div class="col-md-12 col-lg-7 mb-4 mb-lg-0 mx-auto" data-aos="fade-up">
              <h2>Comment ça marche?</h2>
              <div>
                <ol class="mb-2">
                  <li>Inscris-toi</li>
                  <li>Crée ta tribu</li>
                  <li>Invite tes proches</li>
                  <li>Partagez vos photos !</li>
                </ol>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </main>
  <?php get_template_part('partials/footer.tpl'); ?>



  <?php
  get_footer();
  ?>
</body>

</html>