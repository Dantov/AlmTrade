<?php
    use dtw\HtmlHelper;
?>
<ol class="breadcrumb">
    <li class="breadcrumb-item"><a href="/almadmin">Admin</a><i class="fa fa-angle-right"></i>Home</li>
</ol>

<div class="validation-system">
    <div class="validation-form">
        <p id="topName" class="text-warning" align="center">Редактировать: <strong>Home</strong></p>
        <!---->
        <?php if ( $this->session->hasFlash('no_upd') ): ?>
            <div class="alert alert-danger alert-dismissible" role="alert">
                <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                <strong> <?=$this->session->getFlash('no_upd');?> </strong>
            </div>
        <?php endif; ?>
        <?php if ( $this->session->hasFlash('success_upd') ): ?>
            <div class="alert alert-success alert-dismissible" role="alert">
                <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                <strong> <?=$this->session->getFlash('success_upd');?> </strong>
            </div>
        <?php endif; ?>
        <?php $textForm = HtmlHelper::beginForm( HtmlHelper::URL('/almadmin/home/edit/1'), ['method'=>'POST'] ); ?>
            <div class="vali-form">
                <div class="col-md-12 form-group1">
                    <?= $textForm->field($homeForm, 'logotext')->textarea(['rows'=>5,'placeholder'=>'Заполнить текстом здесь','value'=>html_entity_decode($hometext->logotext),])->label("",['class'=>"control-label"])?>
                </div>
                <div class="col-md-12 form-group1 form-last">
                    <?= $textForm->field($homeForm, 'maintext')->textarea(['rows'=>5,'placeholder'=>'Заполнить текстом здесь','value'=>html_entity_decode($hometext->maintext),])->label('',['class'=>"control-label"])?>
                </div>
                <div class="clearfix"> </div>
                <div class="col-md-12 form-group1 ">
                    <?= $textForm->field($homeForm, 'offtext')->textarea(['rows'=>5,'placeholder'=>'Заполнить текстом здесь','value'=>html_entity_decode($hometext->offtext),])->label("",['class'=>"control-label"]) ?>
                </div>
            </div>
            <div class="clearfix"> </div>
            <div class="col-md-12 form-group">
                <?= $textForm->field($homeForm)->submitButton(['value'=>'Save','class'=>'btn btn-primary']) ?>
            </div>
            <div class="clearfix"> </div>
        <?php HtmlHelper::endForm(); ?>

        <!---->
    </div>
</div>