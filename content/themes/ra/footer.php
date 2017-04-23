<?php

$twitter = get_field('twitter_url', 'options');
$facebook = get_field('facebook_url', 'options');

?>

<footer class="footer">
    <div class="container">
        <div class="grid">
            <div class="grid__item grid__item--6-12-bp2">
                <a href="#">
                    <img src="<?php echo get_stylesheet_directory_uri(); ?>/assets/dist/img/acm.png" title="Approved Coal Merchant" alt="Approved Coal Merchant">
                </a>
                <a href="#">
                    <img src="<?php echo get_stylesheet_directory_uri(); ?>/assets/dist/img/rha.png" title="Road Haulage Association" alt="Road Haulage Association" class="u-push-left@2">
                </a>
                <a href="#">
                    <img src="<?php echo get_stylesheet_directory_uri(); ?>/assets/dist/img/fsb.png" title="Federation of Small Businesses" alt="Federation of Small Businesses" class="u-push-left@2">
                </a>
            </div>
            <div class="grid__item grid__item--6-12-bp2 | socialmedia">
                <?php if ($twitter): ?>
                    <a href="#" class="icon icon--xlarge icon--facebook"></a>
                <?php endif; ?>
                <?php if ($facebook): ?>
                    <a href="#" class="icon icon--xlarge icon--twitter | u-push-left@2"></a>
                <?php endif; ?>
            </div>
        </div>
        <div class="copyright__info | u-push-top zeta">
            Copyright &copy; <?php echo date('Y'); ?> RA Blackford | Created by <a href="#" class="link">Alex Edwards</a>
        </div>
    </div>
</footer>

<?php wp_footer(); ?>

</body>
</html>

<link rel="stylesheet" href="<?php echo get_stylesheet_directory_uri(); ?>/assets/dist/css/styles.css">
