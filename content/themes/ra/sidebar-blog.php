<?php

/**
 ***************************************************************************
 * Sidebar - Default
 ***************************************************************************
 *
 * The sidebar is used to define any side-information to be presented
 * for a template. Think categories from a blog listing template and
 * related/children for pages.
 *
 */

// Get archives
$categories = ra_get_categories();
$current_cat = is_category( get_queried_object() ) ? get_queried_object()->name : '';

?>


<aside class="sidebar" role="complementary">
    <?php if ( $categories ) : ?>
        <article class="sidebar__section">
            <h2 class="gamma | sidebar__heading">
                Categories
            </h2>
            <div class="sidebar__content">
                <ul class="sidebar__list">
                    <?php foreach ( $categories as $category ) : ?>
                        <?php $current = $current_cat == $category->name ? 'class="is-current"' : ''; ?>
                        <li <?= $current ?>>
                            <?php if ( $current ) : ?>
                                <?php echo $category->name; ?>
                            <?php else : ?>
                                <a href="<?php echo get_term_link( $category ); ?>"><?php echo $category->name; ?></a>
                            <?php endif; ?>
                        </li>
                    <?php endforeach; ?>
                </ul>
            </div>
        </article> <!-- .sidebar__section -->
    <?php endif; ?>
</aside>

