<?php
/**
 * Template part for displaying Author Bio on Single Posts
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/
 *
 * @package Pixanews
 */

$content = "";
$display_name = get_the_author_meta( 'display_name', $post->post_author );
if ( empty( $display_name ) )
	$display_name = get_the_author_meta( 'nickname', $post->post_author );
	
$user_description = get_the_author_meta( 'user_description', $post->post_author );	
$user_website = get_the_author_meta('url', $post->post_author);
$user_posts = get_author_posts_url( get_the_author_meta( 'ID' , $post->post_author));
?>
<div class="pixanews-author-bio-box row">
	<div class="author-avatar col-md-2 col-3">
		<a href="<?php echo esc_url($user_posts); ?>"><?php echo get_avatar( get_the_author_meta('user_email') , 90 ); ?></a>
	</div>
	<div class="author-info col-md-10 col-9">
		<div class="h3"><?php echo esc_html($display_name); ?></div>
		<?php echo esc_html($user_description); ?>
		<?php if ( ! empty( $user_website ) ) {
			echo '<div><a href="' . esc_url($user_website) .'" target="_blank" rel="nofollow"><i class="fa fa-globe"></i></a></div>'; 
			} ?>
	</div>
</div>

<?php
// if ( ! empty( $display_name ) )
//   $author_details = '<p class="author_name">' . esc_html($display_name) . '</p>';
// 
// 
// if ( ! empty( $user_website ) ) {
// 	  
// 	// Display author website link
// 	$author_details .= ' | <a href="' . $user_website .'" target="_blank" rel="nofollow">Website</a></p>';
// 	  
// 	} else { 
// 	// if there is no author website then just close the paragraph
// 	$author_details .= '</p>';
// }
// 	  
// // Pass all this info to post content  
// $content = $content . '<footer class="author_bio_section" >' . $author_details . '</footer>';
// 	
// echo $content;