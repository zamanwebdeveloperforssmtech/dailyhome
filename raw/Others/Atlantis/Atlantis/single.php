<?php get_header(); ?>

<div id="content" >

<?php if (have_posts()) : ?>

<?php while (have_posts()) : the_post(); ?>

<div <?php post_class('post') ?> id="post-<?php the_ID(); ?>">
<div class="title">

<h2><a href="<?php the_permalink() ?>" rel="bookmark" title="Permanent Link to <?php the_title(); ?>"><?php the_title(); ?></a></h2>
	<span class="author"> Posted by <?php the_author(); ?></span> 
	<span class='date'>Posted on <?php the_time('M - d - Y'); ?></span>
<div class="clear"></div>
</div>


<div class="entry">

<?php the_content('Read the rest of this entry &raquo;'); ?>
<?php include (TEMPLATEPATH . '/ad1.php'); ?>
<div class="clear"></div>
<?php wp_link_pages(array('before' => '<p><strong>Pages: </strong> ', 'after' => '</p>', 'next_or_number' => 'number')); ?>
</div>



<div class="singleinfo">

<span class="category">Categories: <?php the_category(', '); ?> </span>

</div>
<?php if ( get_the_author_meta( 'description' ) ) : // If a user has filled out their description, show a bio on their entries  ?>
					<div id="entry-author-info" class="rounded">
						<div id="author-avatar">
							<?php echo get_avatar( get_the_author_meta( 'user_email' ), apply_filters( 'twentyten_author_bio_avatar_size', 60 ) ); ?>
						</div><!-- #author-avatar -->
						<div id="author-description">
							<h3><?php printf( esc_attr__( 'About %s'), get_the_author() ); ?></h3>
							<?php the_author_meta( 'description' ); ?>
							
							<div id="author-link">
								<a href="<?php echo get_author_posts_url( get_the_author_meta( 'ID' ) ); ?>">
									<?php printf( __( 'View all posts by %s <span class="meta-nav">&rarr;</span>' ), get_the_author() ); ?>
								</a>
							</div><!-- #author-link	-->
							</div><!-- #author-description -->
							<div id="author-share" class="rounded">
							<ul>
							<li><a href="<?php bloginfo('rss2_url'); ?>" ><img src="<?php bloginfo('stylesheet_directory'); ?>/images/rss.png" title="subscribe" alt="RSS"/></a></li>
							
							<li> <a href="http://www.google.com/reader/link?url=<?php the_permalink() ?>&title=<?php the_title(); ?>&srcURL=<?php bloginfo('url'); ?>" target="_blank" rel="nofollow external"><img
src="<?php bloginfo('stylesheet_directory'); ?>/images/buzz.png" width="50" height="58" alt="" /></a></li>

<li> <a class="DiggThisButton DiggMedium" href="http://digg.com/submit?url=<?php the_permalink() ?>&title=<?php the_title(); ?>&bodytext=<?php the_excerpt(); ?></a>
<script src="http://widgets.digg.com/buttons.js" type="text/javascript"></script> </li>

					
					</ul>
					
					</div><!-- #entry-author-info -->
					<div class="clear"></div>
					</div><!-- #entry-author-info -->
<?php endif; ?>
</div>


<?php comments_template(); ?>

	<?php endwhile; else: ?>

		<h1 class="title">Not Found</h1>
		<p>I'm Sorry,  you are looking for something that is not here. Try a different search.</p>

<?php endif; ?>

</div>

<?php get_sidebar(); ?>
<?php get_footer(); ?>