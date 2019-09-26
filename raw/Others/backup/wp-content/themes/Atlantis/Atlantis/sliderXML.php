<?php require_once( '../../../wp-load.php' );
header("Content-type: text/xml");
echo '<?xml version="1.0" encoding="utf-8" ?>
<Piecemaker>
<Settings>
<imageWidth>900</imageWidth>
<imageHeight>300</imageHeight>';
echo '<segments>10</segments>';
echo '<tweenTime>2</tweenTime>';
echo '<tweenDelay>0.1</tweenDelay>';
echo '<tweenType>easeInOutBack</tweenType>';
echo '<zDistance>300</zDistance>';
echo '<expand>3</expand>';
echo '<innerColor>0x000000</innerColor>';
echo '<textBackground>0x622534</textBackground>';
echo '<textDistance>5</textDistance>';
echo '<shadowDarkness>100</shadowDarkness>';
echo '<autoplay>3</autoplay>'; 
echo '
</Settings>';
?>
<?php 
	$gldcat = get_option('atln_gldcat'); 
	$gldct =  get_option('atln_gldct');
	$my_query = new WP_Query('category_name='.$gldcat.'&showposts='.$gldct.'');
	while ($my_query->have_posts()) : $my_query->the_post();$do_not_duplicate = $post->ID;
?>
<?php $preview = get_post_meta($post->ID, 'slides_value', $single = true)  ?>
<Image Filename="<?php echo $preview; ?>">
  <Text>
	<headline><?php //the_title(); ?></headline>
	<break>.</break>
	<paragraph><?php// the_content_rss('', TRUE, '', 40); ?></paragraph>
	<break>.</break>
	<inline> <a href="<?php the_permalink() ?>"> Read More </a></inline>
  </Text>
</Image>
<?php endwhile; ?>
<?php wp_reset_query(); ?>
<?php echo '</Piecemaker>'; ?>