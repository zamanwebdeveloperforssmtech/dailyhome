<?php get_header(); ?>
<div id="content">

<h2 class="pagetitle">Search Results</h2>
<?php if (have_posts()) : ?>

<?php while (have_posts()) : the_post(); ?>
		
<div  <?php post_class() ?>  id="post-<?php the_ID(); ?>">

<div class="title">

<h2><a href="<?php the_permalink() ?>" rel="bookmark" title="Permanent Link to <?php the_title(); ?>"><?php the_title(); ?></a></h2>
	<span class="author"> Posted by <?php the_author(); ?></span> 
	<span class='date'>Posted on <?php the_time('M - d - Y'); ?></span>
<div class="clear"></div>
</div>



<div class="entry">
<a href="<?php the_permalink() ?>"><img class="postim" src="<?php bloginfo('stylesheet_directory'); ?>/timthumb.php?src=<?php get_image_url(); ?>&amp;h=125&amp;w=300&amp;zc=1" alt=""/></a>


	<?php the_excerpt(); ?> 

<div class="clear"></div>
	
</div>



<div class="singleinfo">

<span class="category">Categories: <?php the_category(', '); ?> </span>

</div>


</div>
		<?php endwhile; ?>

 <div id="navigation">
<?php
if(function_exists('wp_pagenavi')) { wp_pagenavi(); }
?>
</div>

	<?php else : ?>

		<h1 class="title">Not Found</h1>
		<p>Sorry, but you are looking for something that isn't here.</p>

	<?php endif; ?>

</div>
<?php get_sidebar(); ?>
<?php get_footer(); ?>