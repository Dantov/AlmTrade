<?php
use dtw\HtmlHelper;

?>
<ol class="breadcrumb">
    <li class="breadcrumb-item"><a href="/almadmin">Admin</a><i class="fa fa-angle-right"></i><a href="/almadmin/stock">Stock</a><i class="fa fa-angle-right"></i>New Position</li>
</ol>
<!--grid-->
<div class="validation-system">
    <div class="validation-form">
        <p id="topName" class="text-warning" align="center">Добавление:</p>
        <!---->
        <?php $textForm = HtmlHelper::beginForm( HtmlHelper::URL('/almadmin/stock/insert/new'), ['method'=>'POST', 'enctype'=>'multipart/form-data'] ); ?>
            <div class="vali-form">
                <div class="col-md-6 form-group1">
                    <?= $textForm->field($position, 'name')->input('text',['required'=>'1'])->label("Имя",['class'=>"control-label"]) ?>
                </div>
                <div class="col-md-6 form-group1 form-last">
                    <?= $textForm->field($position, 'short_name')->input('text',['required'=>'1'])->label("Короткре Имя",['class'=>"control-label"]) ?>
                </div>
                <div class="clearfix"> </div>
            </div>
            <div class="clearfix"> </div>
            <div class="col-md-12 form-group1 ">
                <?= $textForm->field($position, 'description')->textarea(['rows'=>12,'placeholder'=>'Заполнить текстом здесь'])->label("Описание",['class'=>"control-label"]) ?>
            </div>
            <div class="clearfix"> </div>

            <div class="col-md-12 form-group1 " id="picts">
                <div class="col-md-12 gallery-grids-left">
                    <label class="control-label">Картинки</label>
                </div>
                <div class="col-md-3 gallery-grids-left" id="add_bef_this">
                    <a class="btn" role="button" title="Добавить картинку" id="add_img" style="margin-top:20px;">
                        <img src="<?=HtmlHelper::URL('/views/images/uploadImg.png')?>" width="50px">
                    </a>
                </div>

            </div>
            <div class="clearfix"> </div>
            <div class="col-md-12 form-group2 group-mail">
                <label class="control-label">Статус</label>
                <select name="stock[status]">
                    <option <?php if(empty($machine->status)) echo "selected"; ?> value="0">Нет</option>
                    <option <?php if($machine->status == 1) echo "selected"; ?> value="1">Hot</option>
                    <option <?php if($machine->status == -1) echo "selected"; ?> value="-1">Sold</option>
                </select>
            </div>
            <div class="clearfix"></div>
            <div class="col-md-12 form-group1 group-mail">
                <?= $textForm->field($position, 'view')->input('text',['value'=>0])->label('Просмотры',['class'=>"control-label"]) ?>
                <p class=" hint-block">Numeric values from 0-***</p>
            </div>
            <div class="clearfix"> </div>
            <div class="col-md-12 form-group">
                <?= $textForm->field($position)->submitButton(['value'=>'Сохранить','class'=>'btn btn-primary']) ?>
                <?= $textForm->field($position)->button(['value'=>'Сбросить','type'=>'reset','class'=>'btn btn-default']) ?>
            </div>
            <div class="clearfix"></div>
        <?php HtmlHelper::endForm(); ?>
        <!---->
    </div>

</div>
<!--//grid-->

<div class="col-md-3 gallery-grids-left protorow hidden">
    <input type="file" class="hidden" name="" accept="image/jpeg,image/png">
    <div class="gallery-grid shippments_grid">
        <img src="" alt="">
        <a class="btn btn-danger btn-rem" role="button" title="Убрать" onclick="dellImgPrew(this)">
            <span class="glyphicon glyphicon-remove"></span>
        </a>
    </div>
</div>

<script src="<?=_rootDIR_HTTP_?>/modules/almadmin/views/js/uploadFile.js?ver=<?=time()?>"></script>


