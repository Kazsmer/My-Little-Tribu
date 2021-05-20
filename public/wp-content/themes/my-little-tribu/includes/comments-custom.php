<?php
add_filter('comment_form_fields' , function($fields){
    $fields['comment'] = '<div class="form-group"><label for="exampleFormControlTextarea1"></label><textarea class="form-control" name="comment" id="exampleFormControlTextarea1" rows="3" required></textarea></div>';
    $fields['email'] = '<div class="form-group"><label for="email">Email</label><input class="form-control" name="email" id="email"></div>';
    $fields['author'] = '<div class="form-group"><label for="author">Pseudo</label><input class="form-control" name="author" id="author required"></div>';
    $fields['url'] = '';
    return $fields;
});
?>