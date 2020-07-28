<?php

/**
 ***************************************************************************
 * Sidebar - Contact
 ***************************************************************************
 *
 * The sidebar is used to define any side-information to be presented
 * for a template. Think categories from a blog listing template and
 * related/children for pages.
 *
 */

/**
 * Get options fields
 */
$address = get_field('postal_address', 'options');
$email = get_field('email_address', 'options');
$phone = get_field('phone_number', 'options');

/**
 * Count address lines
 */
//$c_addr  = count($address);

/**
 * Count address lines
 */
//$c_openh  = count($open_hours);

?>

<aside class="sidebar" role="complementary">
    <?php if($address): ?>
        <article class="sidebar__section">
            <h2 class="gamma | sidebar__heading">
                <span class="icon | icon--address icon--small"></span>
                Address
            </h2>
            <div class="sidebar__content">
                <?php foreach($address as $k => $i): ?>
                    <?php echo $i['line'] . '<br>'; ?>
                <?php endforeach; ?>
            </div>
        </article>
    <?php endif; ?>

    <?php if($phone): ?>
        <article class="sidebar__section">
            <h2 class="gamma | sidebar__heading">
                <span class="icon | icon--phone icon--small"></span>
                Phone
            </h2>
            <div class="sidebar__content">
                <a href="tel:<?php echo ra_format_tel($phone); ?>"><span class="sidebar__list--underline"><?php echo $phone; ?></span></a>
            </div>
        </article>
    <?php endif; ?>

    <?php if($email): ?>
        <article class="sidebar__section">
            <h2 class="gamma | sidebar__heading">
                <span class="icon | icon--mail icon--small"></span>
                Email
            </h2>
            <div class="sidebar__content">
                <a href="mailto:<?php echo antispambot($email); ?>"><span class="sidebar__list--underline"><?php echo antispambot($email); ?></span></a>
            </div>
        </article>
    <?php endif; ?>
</aside>
