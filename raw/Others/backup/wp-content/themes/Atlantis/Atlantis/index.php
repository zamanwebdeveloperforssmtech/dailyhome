<?php get_header(); ?>


<div id="welcome" class="rounded">
<p><?php $welc = get_option('atln_welc'); echo stripslashes($welc); ?> </p>	

</div>

<div class='clear'></div>
<div id="content">

<?php if (have_posts()) : ?>
<?php while (have_posts()) : the_post(); ?>

<div class="box <?php if (++$counter % 2 == 0) { echo "lastbox"; }?>" id="post-<?php the_ID(); ?>" >

<div class="entry">

<a href="<?php the_permalink() ?>"><img class="boxim" src="<?php bloginfo('stylesheet_directory'); ?>/timthumb.php?src=<?php get_image_url(); ?>&amp;h=125&amp;w=300&amp;zc=1" alt=""/></a>

<h2><a href="<?php the_permalink() ?>" rel="bookmark" title="Permanent Link to <?php the_title(); ?>"><?php echo substr($post->post_title,0,30); ?></a></h2>

<p><?php the_content_rss('', TRUE, '', 30); ?></p>
</div>
	

<div class='clear'></div>
</div>

<?php endwhile; ?>
<div class="clear"></div>
<div id="navigation">
<?php if(function_exists('wp_pagenavi')) : ?>
<?php wp_pagenavi() ?>
<?php else : ?>
        <div class="alignleft"><?php next_posts_link(__('&laquo; Older Entries','arclite')) ?></div>
        <div class="alignright"><?php previous_posts_link(__('Newer Entries &raquo;','arclite')) ?></div>
        <div class="clear"></div>
<?php endif; ?>

</div>

<?php else : ?>
		<h1 class="title">Not Found</h1>
		<p>Sorry, but you are looking for something that isn't here.</p>
<?php endif; ?>

</div>

<?php get_sidebar(); ?>

<?php get_footer(); ?>