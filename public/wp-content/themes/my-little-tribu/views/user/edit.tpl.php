<!DOCTYPE html>
<html lang="en">
<?php get_header(); ?>

<body class="page-index">
    <main>

        <?php
            get_template_part('partials/header.tpl');
            // echo $toto;
        ?>



        <form method="post" action="<?=get_home_url();?>/user/update">
            <fieldset>
                <label>
                    Email :
                    <input name="email" value="<?=$args['email'];?>"/>
                </label>
            </fieldset>

            <fieldset>
                <label>
                    Address :
                    <textarea name="address"><?=
                        // Ne pas oublier de "sécuriser" son code html pour éviter des injections javascript
                        esc_html($args['address']);
                    ?></textarea>
                </label>
            </fieldset>
            <div>
                <button>Update</button>
            </div>


        </form>

        <?php
            get_template_part('partials/footer.tpl');
        ?>
    </main>

    <?php
        get_footer();
    ?>

</body>
</html>