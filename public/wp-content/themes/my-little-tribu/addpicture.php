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
        </div>
      </div>

      <div class="site-section pb-0">
        <div class="container">
          <form class="row" data-aos="fade-up">
            <div class="col-lg-6">
              <div class="col-lg-12 px-0 pb-4">
                  <input type="password" class="form-control" id="inputPassword2" placeholder="Titre de la photo">
              </div>
              <div class="flex">              
                <div class="col-lg-6 pl-1">
                  <div class="input-group">
                    <select class="custom-select" id="inputGroupSelect04" aria-label="Example select with button addon">
                      <option selected>Choose...</option>
                      <option value="1">One</option>
                      <option value="2">Two</option>
                      <option value="3">Three</option>
                    </select>
                  </div>
                </div>
                <div class="col-lg-6 px-0">
                  <div class="input-group">
                    <select class="custom-select" id="inputGroupSelect04" aria-label="Example select with button addon">
                      <option selected>Choose...</option>
                      <option value="1">One</option>
                      <option value="2">Two</option>
                      <option value="3">Three</option>
                    </select>
                  </div>
                </div>
              </div>
              <div class="col-lg-12 px-0 pt-4">
                <div class="input-group">
                  <select class="custom-select" id="inputGroupSelect04" aria-label="Example select with button addon">
                    <option selected>Choose...</option>
                    <option value="1">One</option>
                    <option value="2">Two</option>
                    <option value="3">Three</option>
                  </select>
                </div>
              </div>
              <div class="col-auto px-0 pt-4">
              </div>
            </div>
              <div class="col-lg-6" data-aos="fade-up" data-aos-delay="100">
                <div class="input-group">
                    <input type="file" class="form-control" id="inputGroupFile04" aria-describedby="inputGroupFileAddon04" style="height: 20vh;">
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
