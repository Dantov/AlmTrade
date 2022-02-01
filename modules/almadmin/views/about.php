<?php
    use dtw\HtmlHelper;
?>
<ol class="breadcrumb">
    <li class="breadcrumb-item"><a href="/almadmin">Admin</a><i class="fa fa-angle-right"></i>AboutUs</li>
</ol>

<div class="validation-system" id="aboutus">
    <div class="validation-form">
        <p id="topName" class="text-warning" align="center">Редактировать: <strong>About Us</strong></p>
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
        <?php if ( $this->session->hasFlash('success_img') ): ?>
            <div class="alert alert-success alert-dismissible" role="alert">
                <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                <strong> <?=$this->session->getFlash('success_img');?> </strong>
            </div>
        <?php endif; ?>
        <?php $textForm = HtmlHelper::beginForm( HtmlHelper::URL('/almadmin/about/edit/1'), ['method'=>'POST','enctype'=>'multipart/form-data'] ); ?>
            <div class="vali-form">
                <div class="col-md-12 form-group1">
                    <?= $textForm->field($aboutusForm, 'text_en')->textarea(['rows'=>5,'name'=>'aboutus[text_en][0]','placeholder'=>'Заполнить текстом здесь','value'=>html_entity_decode($aboutus[0]->text_en),])->label("Top Text",['class'=>"control-label"])?>
                    <?= $textForm->field($aboutusForm, 'id','aboutus')->input('hidden',['name'=>'aboutus[id][]','value'=>$aboutus[0]->id,]) ?>
                </div>
                <div class="col-md-12 form-group1 form-last">
                    <?= $textForm->field($aboutusForm, 'text_en')->textarea(['rows'=>5,'name'=>'aboutus[text_en][1]','placeholder'=>'Заполнить текстом здесь','value'=>html_entity_decode($aboutus[1]->text_en),])->label('Description of company',['class'=>"control-label"])?>
                    <?= $textForm->field($aboutusForm, 'id','aboutus')->input('hidden',['name'=>'aboutus[id][]','value'=>$aboutus[1]->id,]) ?>
                </div>
            </div>
            <div class="clearfix"></div>
            <div class="col-md-12 form-group1 form-last">
                <label>Pictures</label>
                <div class="row" id="picts">
                    <?php if ($img->img_name): ?>
                    <div class="col-md-6">
                        <img src="<?=HtmlHelper::URL('/views/images/about/'.$img->img_name)?>" width="200px" class="image">
                        <a class="btn btn-danger btn-rem" role="button" title="Убрать" onclick="removeImgFromPos(this,<?=$img->id?>)">
                            <span class="glyphicon glyphicon-remove"></span>
                        </a>
                    </div>
                    <?php endif; ?>
                    <div class="col-md-6 <?php if ( $img->img_name ) echo "hidden"; ?>" id="add_bef_this">
                        <a class="btn" role="button" title="Add Image" id="add_img" style="margin-top:20px;">
                            <img src="<?=HtmlHelper::URL('/views/images/uploadImg.png')?>" width="50px">
                        </a>
                    </div>
                </div>
            </div>
            <div class="clearfix"></div>
            <br/>
            <div class="col-md-12 form-group">
                <?= $textForm->field($aboutusForm)->submitButton(['value'=>'Save','class'=>'btn btn-primary']) ?>
            </div>
            <div class="clearfix"></div>
        <?php HtmlHelper::endForm(); ?>
        <!---->
    </div>
</div>

<div class="col-md-6 protorow hidden">
    <input type="file" class="hidden" name="" accept="image/jpeg,image/png,image/gif">
    <img src="" width="200px" class="img-responsive image">
    <a class="btn btn-danger btn-rem" role="button" title="Убрать" onclick="dellImgPrew(this)">
        <span class="glyphicon glyphicon-remove"></span>
    </a>
</div>
<script src="<?=_rootDIR_HTTP_?>/modules/almadmin/views/js/about.js?ver=<?=time()?>"></script>

