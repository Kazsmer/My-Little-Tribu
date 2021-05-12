<!DOCTYPE html>
<html lang="en">
<?php get_header(); ?>

<body class="page-index">
    <main>

        <?php
            get_template_part('partials/header.tpl');
        ?>

        <section>
            Vos informations ont bien été mises à jour !
        <section>
            <a href="<?=get_home_url();?>/user/home">Revenir à ma page personnelle</a>
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