<!DOCTYPE html>
<html lang="en">
<?php

use OProfile\Model\WPDeveloperModel;

get_header(); ?>

<body class="page-index">
    <main>

        <?php
        // get_template_part('partials/header.tpl');
        $user = wp_get_current_user();
        $developerCPT = WPDeveloperModel::findByAuthorId($user->ID);

        // $developerCPT est un objet de type WP_Post
        // calcul de l'url de l'article $developerCPT
        $url = get_permalink($developerCPT);
        ?>

        <section>

            <ul>
            <li><a href="<?=get_home_url();?>/user/confirm-delete">Supprimer mon compte</a></li>

            <li><a href="<?=get_home_url();?>/user/edit">Editer mon profil</a></li>

            <li><a href="<?=$url;?>">Voir ma fiche développeur</a></li>
            </ul>
        </section>

        <?php
            get_template_part('partials/footer.tpl');
        ?>
    </main>

    <?php
        get_footer();
    ?>

</body>
</html>