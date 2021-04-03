<?php get_header(); 
while(have_posts()) {
	the_post();
	?>

	<h2 class="page-heading"><?php the_title(); ?></h2>
	<div id="post-container">
		<section id="blogpost">
			<div class="card">
				<div class="card-meta-blogpost">
					Posted by <?php the_author(); ?> on <?php the_time('F j, Y') ?> in <a href="#"><?php echo get_the_category_list(', ') ?></a>
				</div>
				<div class="card-image">
					<img src="<?php echo get_the_post_thumbnail_url(get_the_ID()); ?>" alt="Card Image">
				</div>
				<div class="card-description">
					<?php the_content(); ?>
				</div>
			</div>

			<div id="comments-section">
				<?php 

				$fields   =  array(
					'author' =>
					'<input placeholder="Name" <input id="author" name="author" type="text" value="' . esc_attr( $commenter['comment_author'] ) . '" size="30" maxlength="245"' . $aria_req . $html_req . ' />',
					'email'  =>
					'<input placeholder="Email" <input id="email" name="email" ' . ( $html5 ? 'type="email"' : 'type="text"' ) . ' value="' . esc_attr(  $commenter['comment_author_email'] ) . '" size="30" maxlength="100" aria-describedby="email-notes"' . $aria_req . $html_req  . ' />',
				);

				$args = array(
					'title_reply' => 'Share your thoughts',
					'fields' => $fields,
					'comment_fild' => '<textarea placeholder="Your Comment" id="comment" name="comment" aria-required="true" placeholder="' . $comment_body .'"></textarea>',
					'comment_notes_before' => '<p class="comment-notes">Your email address will not be published. All fields are required.</p>'

				);

				comment_form($args); 

				$comments_number = get_comments_number();
				if($comments_number != 0) {
					?>

					<div class="comments">
						<h3>What others say</h3>
						<ol class="all-comments">
							<?php 
							$comments = get_comments(array(
								'post_id' => $post->ID,
								'status' => 'approve'
							));
							wp_list_comments(array(
								'per_page' => 15
							), $comments);
							?>
						</ol>
					</div>

					<?php
				}
				?>
			</div>
		</section>

	<?php } ?>

	<aside id="sidebar">
		<h3>Sidebar Heading</h3>
		<p>Sidebar 1</p>
	</aside>
</div>

<?php get_footer(); ?>