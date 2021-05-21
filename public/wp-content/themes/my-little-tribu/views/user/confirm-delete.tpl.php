<!DOCTYPE html>
<html lang="en">
<?php get_header(); ?>

<body class="page-index">
    <main>

        <?php
            get_template_part('partials/header.tpl');
        ?>

        <section>
            <a href="<?=wp_delete_post(($postid = 0,  $force_delete = false))"> Confirmer la suppression</a>

            <br/>

            <a href="<?=get_home_url();?>/user/home">Annuler</a>

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