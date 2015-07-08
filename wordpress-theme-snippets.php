<!-- 
Go through the index file you copied into your theme.
Find the static content that matches each item listed below, then replace it with the provided snippet.
For example, find where it says "Blog Title" then replace it with <?php wp_title(''); ?>
Or, if it says "Instruction", follow the instruction provided instead
-->

Blog Title
<?php wp_title(''); ?>

HOME_URL
<?php echo home_url(); ?>

Site Title
<?php bloginfo('name'); ?>

Tagline
<?php bloginfo('description'); ?>

Header BG
<?php echo get_template_directory_uri() ?>/assets/img


	        <section id="header-main" class="site_header row" style="background:url('<?php echo get_template_directory_uri() ?>/assets/img/coverimage.jpg')">
	        			
	        	<a href="http://derpixler.github.io/30-second-wordpress-theme/" id="logo" class="logo"></a>
                <h1>
                  <a href="<?php echo home_url(); ?>">
                    <?php wp_title(''); ?>
                  </a>
                </h1>
                <p>
                  <a href="<?php echo home_url(); ?>">
                    <?php bloginfo('description'); ?>
                  </a>
                </p>
                
	        </section>


<!-- Start post loop -->
<?php if (have_posts()) : while (have_posts()) : the_post(); ?>

POST_PERMALINK
<?php the_permalink() ?>

Post Title
<?php the_title(); ?>

DATETIME
<?php the_time('Y-m-d'); ?>

June 25, 2015
<?php the_time(__('F j, Y')); ?>

Instruction: Replace all post content - 3 paragraphs
<?php the_content('Read More &raquo;'); ?>

<!-- End post loop -->
<?php endwhile; endif; ?>

Instruction: Replace all content inside "nav_links" class div
<?php posts_nav_link(); ?>

Instruction: Replace the two link elements that load stylesheets in the head section
<?php wp_head(); ?>

Instruction: Place before closing body tag
<?php wp_footer(); ?>

