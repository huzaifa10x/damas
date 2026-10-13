<?php

use common\components\ProductListIingWidget;
?>
<div class="itm">
    <?= ProductListIingWidget::widget(['product_id' => $model->id, 'language'=>$language]) ?>
</div>






