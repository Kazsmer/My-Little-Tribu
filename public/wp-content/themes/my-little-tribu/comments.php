<?php

use MyLittleTribu\CommentWalker;

$count = absint(get_comments_number());

wp_list_comments([
    'style' => 'div',
    'format' => 'html5',
    'avatar_size' => 0,
    'walker' => new CommentWalker()
]);
paginate_comments_links();

if ($count > 0){

    echo '<h2>Commentaire'  . $count > 1 ? 's' : '' . '</h2>';
} else {
    echo '';
}

if (comments_open()){
    comment_form([
        'title_reply' => '',
        'logged_in_as' => '',
        'class_submit' => 'btn col-md-12 col-sm-9 col-sm-12 col-12 readmore bg-warning ',
        'label_submit' => 'Envoyer'
    ]);
}

?>


