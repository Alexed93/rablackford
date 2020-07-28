<?php
    $open_hours = get_field('open_hours', 'options');
?>
<div class="open-hours">
    <?php if($open_hours): ?>
        <div class="container cf">
            <span class="icon | icon--clock icon--xlarge"></span>
            <ul class="list--unset list--inline--bp3 | u-display-inline delta | open-hours__list">
                <?php foreach($open_hours as $i): ?>
                    <?php if ($i['line']) : ?>
                        <li><?php echo $i['line']; ?></li>
                    <?php endif; ?>
                <?php endforeach; ?>
            </ul>
        </div>
    <?php endif; ?>
</div>
