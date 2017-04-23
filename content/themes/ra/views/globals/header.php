<?php

/**
 ***************************************************************************
 * Partial: Header
 ***************************************************************************
 *
 * This partial is used to define the markup for the site's global header
 * and navigation.
 *
 */



?>

<a href="#navigation" class="is-hidden">Skip to Navigation</a>

<header class="header">
    <div class="container cf">
        <a href="/" class="logo | header__logo">
            <span class="is-hidden"><?php bloginfo( 'name' ); ?></span>
            <h1 class="alpha u-weight-semi-bold | u-zero-bottom">R.A BLACKFORD</h1>
            <p class="epsilon u-weight-medium | u-zero-bottom">Text goes here</p>
        </a>

        <button class="toggle | js-toggle-nav | header__toggle header__toggle--nav" role="button" aria-label="Toggle navigation">
            <span class="toggle__label | is-hidden">Toggle navigation</span>
            <span class="toggle__icon toggle__icon--nav | icon icon--medium icon--menu-open"></span>
        </button>

        <nav class="nav-container | header__nav" id="navigation" role="navigation">
            <ul class="nav nav--primary">
                <?php wp_nav_menu( array('theme_location' => 'primary', 'items_wrap' => '%3$s') ); ?>
            </ul>

            <ul class="nav nav--secondary">
                <?php wp_nav_menu( array('theme_location' => 'secondary', 'items_wrap' => '%3$s') ); ?>
            </ul>
        </nav>
    </div>
</header>

<div class="main">
