<?php
    use dtw\HtmlHelper;
?>
<ol class="breadcrumb">
    <li class="breadcrumb-item"><a href="/almadmin">Admin</a><i class="fa fa-angle-right"></i>We Buy</li>
</ol>

<div class="validation-system" id="aboutus">
    <div class="validation-form">
        <p id="topName" class="text-warning" align="center">Редактировать: <strong>We Buy</strong></p>
        <!---->
        <?php if ( $this->session->hasFlash('success_upd') ): ?>
            <div class="alert alert-success alert-dismissible" role="alert">
                <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                <strong> <?=$this->session->getFlash('success_upd');?> </strong>
            </div>
        <?php endif; ?>
        <?php if ( $this->session->hasFlash('success_add') ): ?>
            <div class="alert alert-success alert-dismissible" role="alert">
                <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                <strong> <?=$this->session->getFlash('success_add');?> </strong>
            </div>
        <?php endif; ?>
        
        
        <?php $form = HtmlHelper::beginForm( HtmlHelper::URL('/almadmin/webuy/edit/1'), ['method'=>'POST'] ); ?>
            <div class="vali-form" id="vali_form">
                <?php for( $i = 0; $i < count($webuy); $i++ ): ?>
                <?php //debug($webuy); ?>
                <div class="col-md-12 form-group1 row" style="margin-bottom:10px;border-bottom: 1px solid #E9E9E9">
                    <?= $form->field($webuyForm, 'name')->textarea(['rows'=>2,'name'=>'webuy_en[name][]','id'=>"webuy-name_".$webuy[$i]->id,'placeholder'=>'Заполнить текстом здесь','value'=>html_entity_decode($webuy[$i]->name),])->label($i+1,['class'=>"control-label"])?>
                    <?= $form->field($webuyForm, 'id','webuy_en')->input('hidden',['name'=>'webuy_en[id][]','id'=>'webuy-id_'.$webuy[$i]->id,'value'=>$webuy[$i]->id,]) ?>
                    
                    <?= $form->field($webuyForm)->input('button',['class'=>'btn btn-default','onclick'=>"removePosfromServ(this,{$webuy[$i]->id});",'value'=>'Delete',]) ?>
                </div>
                <?php endfor; ?>
            </div>
            <div class="clearfix"></div>
            <br/>
            <div class="col-md-12 form-group">
                <?= $form->field($webuyForm)->submitButton(['value'=>'Save','class'=>'btn btn-primary']) ?>
                <?= $form->field($webuyForm)->button(['value'=>'Add','id'=>'addWebuy','title'=>'Add','class'=>'btn btn-success']) ?>
            </div>
            <div class="clearfix"></div>
        <?php HtmlHelper::endForm(); ?>
        <!---->
    </div>
</div>

<div class="col-md-12 form-group1 hidden protorow" style="margin-bottom:10px;border-bottom: 1px solid #E9E9E9">
    <label for="" class="control-label">№</label>
    <textarea name="" id="" rows="2" placeholder="Заполнить текстом здесь"></textarea>
    <input type="button" class="btn btn-default" onclick='removePos(this);' value="Delete">
</div>

<script src="<?=_rootDIR_HTTP_?>/modules/almadmin/views/js/webuy.js?ver=<?=time()?>"></script>
