<?php

$twitter = get_field('twitter', 'options');
$facebook = get_field('facebook', 'options');

?>
<?php get_template_part( 'views/globals/openhours' ); ?>
<footer class="footer">
    <div class="container">
        <div class="grid">
            <div class="grid__item grid__item--6-12-bp3">
                <a href="http://solidfuel.co.uk/approved-coal-wood-merchants/">
                    <img src="<?php echo get_stylesheet_directory_uri(); ?>/assets/img/acm.png" title="Approved Coal Merchant" alt="Approved Coal Merchant">
                </a>
                <a href="https://www.rha.uk.net/">
                    <img src="<?php echo get_stylesheet_directory_uri(); ?>/assets/img/rha.png" title="Road Haulage Association" alt="Road Haulage Association" class="u-push-left">
                </a>
                <a href="https://www.fsb.org.uk/">
                    <img src="<?php echo get_stylesheet_directory_uri(); ?>/assets/img/fsb.png" title="Federation of Small Businesses" alt="Federation of Small Businesses" class="u-push-left">
                </a>
                <a href="#">
                    <img src="<?php echo get_stylesheet_directory_uri(); ?>/assets/img/80years.png" title="Celebrating 80 years of business" alt="Celebrating 80 years of business" class="u-push-left celebration">
                </a>
            </div>
            <div class="grid__item grid__item--6-12-bp3 | socialmedia">
                <?php if ($twitter): ?>
                    <a href="<?php echo $twitter; ?>" class="icon icon--xlarge icon--twitter"></a>
                <?php endif; ?>
                <?php if ($facebook): ?>
                    <a href="<?php echo $facebook; ?>" class="icon icon--xlarge icon--facebook | u-push-left@2"></a>
                <?php endif; ?>
            </div>
        </div>
        <div class="copyright__info | u-push-top zeta">
            Copyright &copy; <?php echo date('Y'); ?> RA Blackford | Created by <a href="mailto:alexed93@gmail.com" class="link">Alex Edwards</a>
        </div>
    </div>
</footer>

<?php wp_footer(); ?>

</body>
</html>
