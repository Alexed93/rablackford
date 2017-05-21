<?php
// Get the header
get_header();

// Setup placeholder variables for later use
$page_title = '';
$monthname = '';

// Check for category or date archives
$object = $wp_query->queried_object;

if (isset($wp_query->query['monthnum'])) {
    $month = $wp_query->query['monthnum'];

    $dateObj = DateTime::createFromFormat('m', $month);
    $monthname = ' '. $dateObj->format('F');

} else {
    $month = '';
}

if(is_category()):
    $page_title = 'News: ' . $object->name;
elseif(is_tag()):
    $page_title = $object->name. ' news';
endif;

?>

<?php get_template_part('views/globals/breadcrumbs'); ?>

<main class="section">
    <div class="container">
        <div class="container--introduction | u-push-bottom@2">
            <?php if ( $page_title ): ?>
                <h1 class="headline"><?php echo $page_title; ?></h1>
            <?php endif; ?>
        </div>
        <?php get_template_part( 'views/post/index' ) ?>
   </div> <!-- .container -->
</main>

<?php get_footer(); ?>

