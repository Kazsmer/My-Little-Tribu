<?php

// DOC https://rudrastyh.com/wordpress/how-to-add-images-to-media-library-from-uploaded-files-programmatically.html

 
// WordPress environment
require( dirname(__FILE__) . '/../../../wp/wp-load.php' );
 
$wordpress_upload_dir = wp_upload_dir();
// $wordpress_upload_dir['path'] is the full server path to wp-content/uploads/2017/05
// $wordpress_upload_dir['url'] the absolute URL to the same folder, actually we do not need it, just to show the link to file
$i = 1; // number of tries when the file with the same name is already exists
 
$photo = $_FILES['photo'];
$new_file_path = $wordpress_upload_dir['path'] . '/' . $photo['name'];
$new_file_mime = mime_content_type( $photo['tmp_name'] );
 
if( empty( $photo ) )
	die( 'Veuillez sélectionner une photo.' );
 
if( $photo['erreur'] )
	die( $photo['erreur'] );
 
if( $photo['size'] > wp_max_upload_size() )
	die( 'Fichier trop volumineux' );
 
if( !in_array( $new_file_mime, get_allowed_mime_types() ) )
	die( 'WordPress n\'autorise pas le téléchargement de ce type de fichier.' );
 
while( file_exists( $new_file_path ) ) {
	$i++;
	$new_file_path = $wordpress_upload_dir['path'] . '/' . $i . '_' . $photo['name'];
}
 
// looks like everything is OK
if( move_uploaded_file( $photo['tmp_name'], $new_file_path ) ) {
 
 
	$upload_id = wp_insert_attachment( array(
		'guid'           => $new_file_path, 
		'post_mime_type' => $new_file_mime,
		'post_title'     => preg_replace( '/\.[^.]+$/', '', $profilepicture['name'] ),
		'post_content'   => '',
		'post_status'    => 'inherit'
	), $new_file_path );
 
	// wp_generate_attachment_metadata() won't work if you do not include this file
	require_once( ABSPATH . 'wp-admin/includes/image.php' );
 
	// Generate and save the attachment metas into the database
	wp_update_attachment_metadata( $upload_id, wp_generate_attachment_metadata( $upload_id, $new_file_path ) );
 
	// Show the uploaded file in browser
	wp_redirect( $wordpress_upload_dir['url'] . '/' . basename( $new_file_path ) );
 
}