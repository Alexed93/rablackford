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

// Get child pages
$children = ra_children_or_siblings($post->ID);

?>

<?php if($children): ?>
        <aside class="sidebar" role="complementary">
            <article class="sidebar__section">
                <h2 class="gamma | sidebar__heading">
                    In this section
                </h2>
                <div class="sidebar__content">
                    <ul class="sidebar__list">
                    <?php foreach( $children as $post ) : setup_postdata($post); ?>
                        <li class="<?php echo is_page($post->ID) ? 'is-current' : ''; ?>">
                            <a href="<?php echo get_permalink($post->ID); ?>"><?php echo get_the_title($post->ID); ?></a>
                        </li>
                     <?php endforeach; wp_reset_postdata(); ?>
                    </ul>
                </div>
            </article> <!-- .sidebar__section -->
        </aside>
<?php endif; ?>
