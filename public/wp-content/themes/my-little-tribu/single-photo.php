<!DOCTYPE html>
<html lang="en">

<?php 
get_header();
?>

<body>
<?php get_template_part('partials/header.tpl');?>
  <main id="main">
    <div class="site-section">
      <div class="container">
        <div class="row mb-5 align-items-center">
          <div class="col-md-12 col-lg-6 mb-4 mb-lg-0" data-aos="fade-up">
            <h2>Nous à la plage !</h2>
            <div>
              <p class="mb-2">Ma super tribu
                <a href="<?= get_theme_file_uri('addpicture.php');?>">coucou</a>
              </p>
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
        </div>
      </div>

      <div class="site-section pb-0">
        <div class="container">
          <div class="row align-items-stretch">
            <div class="col-md-8" data-aos="fade-up">
              <img src="<?= get_theme_file_uri('assets/img/img_1_big.jpg');?>" alt="Image" class="img-fluid">
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
              <h3 class="h3 heading">Let a comment ! :)</h3>
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
  </main>
  <?php get_template_part('partials/footer.tpl');?>
  <?php 
get_footer();
?>

</body>

</html>
