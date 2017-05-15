<?php
    $open_hours = get_field('open_hours', 'options');
?>
<div class="open-hours">
    <?php if($open_hours): ?>
        <div class="container">
            <h3 class="u-display-inline gamma">
                <span class="icon | icon--clock icon--large"></span>
                Open hours:
            </h3>
            <div class="u-display-inline delta u-push-left/2">
                <?php foreach($open_hours as $k => $i): ?>
                    <?php if($c_openh == ($k + 1) ): ?>
                        <?php echo $i['line']; ?>
                    <?php else: ?>
                        <?php echo $i['line']; ?>
                    <?php endif; ?>
                <?php endforeach; ?>
            </div>
        </div>
    <?php endif; ?>
</div>
