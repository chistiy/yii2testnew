<?php if(!empty($vids)): ?>
    <ul>
        <?php foreach($vids as $vid): ?>
            <li><a href="<?= yii\helpers\Url::to(['/admin/clients/view'])?>"><?=$vid['name']?></a></li>
        <?php endforeach; ?>
    </ul>
<?php endif; ?>