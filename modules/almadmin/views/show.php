<?php
use dtw\HtmlHelper;

?>
<ol class="breadcrumb">
    <li class="breadcrumb-item"><a href="/almadmin">Admin</a><i class="fa fa-angle-right"></i><a href="/almadmin/stock">Stock</a><i class="fa fa-angle-right"></i><?=$machine->name?></li>
</ol>
<!--grid-->
<div class="validation-system">
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
    <?php if ( $this->session->hasFlash('success_add') ): ?>
        <div class="alert alert-success alert-dismissible" role="alert">
            <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
            <strong> <?=$this->session->getFlash('success_add');?> </strong>
        </div>
    <?php endif; ?>
    <div class="validation-form">
        <p id="topName" class="text-warning" align="center">Редактировать: <strong><?= $machine->short_name ?></strong></p>
        <!---->
        <?php $textForm = HtmlHelper::beginForm( HtmlHelper::URL('/almadmin/stock/edit/'.$machine->id), ['method'=>'POST', 'enctype'=>'multipart/form-data'] ); ?>
            <div class="vali-form">
                <div class="col-md-6 form-group1">
                    <?= $textForm->field($position, 'name')->input('text',['required'=>'1','value'=>html_entity_decode($machine->name)])->label("Manufacturer",['class'=>"control-label"]) ?>
                </div>
                <div class="col-md-6 form-group1 form-last">
                    <?= $textForm->field($position, 'short_name')->input('text',['required'=>'1','value'=>html_entity_decode($machine->short_name)])->label("Type/Model",['class'=>"control-label"]) ?>
                </div>
                <div class="clearfix"> </div>
            </div>
            <div class="clearfix"> </div>
            <div class="col-md-12 form-group1 ">
                <?= $textForm->field($position, 'description')->textarea(['rows'=>12,'placeholder'=>'Заполнить текстом здесь','value'=>html_entity_decode($machine->description),])->label("Description",['class'=>"control-label"]) ?>
            </div>
            <div class="clearfix"> </div>

            <div class="col-md-12 form-group1 " id="picts">
                <div class="col-md-12 gallery-grids-left">
                    <label class="control-label">Pictures</label>
                </div>
                <?php if ( empty($machine->images) )
                {
                    $countImages = 0; 
                } else {
                    $countImages = count($machine->images);
                }
                ?>
                <?php for ($i = 0; $i < $countImages; $i++ ) {?>
                    <div class="col-md-3 gallery-grids-left">
                        <div class="gallery-grid shippments_grid">
                            <?php
                                $imgsrc = $machine->images[$i]->img_name;
                                if(!file_exists( _rootDIR_ . '/views/images/stock/'.$imgsrc) ) 
                                {
                                    $imgsrc = "default.png";
                                }
                            ?>
                            <img src="<?=HtmlHelper::URL('/views/images/stock/'.$imgsrc)?>">
                            <a class="btn btn-danger btn-rem" role="button" title="Delete" onclick="removeImgFromPos(this,<?=$machine->images[$i]->id?>)">
                                <span class="glyphicon glyphicon-remove"></span>
                            </a>
                        </div>
                        <label for="mainImg_<?=$i?>" style="cursor:pointer;">First Pict
                            <?php if( $machine->images[$i]->main ) $cheched = "checked"; ?>
                            <input type="radio" <?=$cheched?> id="mainImg_<?=$i?>" name="mainImg" value="<?=$machine->images[$i]->id?>">
                            <?php $cheched = ""; ?>
                        </label>
                    </div>
                <?php }?>

                <div class="col-md-3 gallery-grids-left" id="add_bef_this">
                    <a class="btn" role="button" title="Add Image" id="add_img" style="margin-top:20px;">
                        <img src="<?=HtmlHelper::URL('/views/images/uploadImg.png')?>" width="50px">
                    </a>
                </div>

            </div>
            <div class="clearfix"> </div>

            <div class="col-md-12 form-group2 group-mail">
                <label class="control-label">Status</label>
                <select name="stock[status]">
                    <option <?php if(empty($machine->status)) echo "selected"; ?> value="null">No</option>
                    <option <?php if($machine->status == 1) echo "selected"; ?> value="1">Hot</option>
                    <option <?php if($machine->status == -1) echo "selected"; ?> value="-1">Sold</option>
                </select>
            </div>
            <div class="clearfix"> </div>
            <div class="col-md-12 form-group1 group-mail">
                <?= $textForm->field($position, 'view')->input('text',['value'=>$machine->view])->label('Views',['class'=>"control-label"]) ?>
                <p class=" hint-block">Numeric values from 0-***</p>
            </div>
            <div class="clearfix"> </div>
            <div class="col-md-12 form-group">
                <?= $textForm->field($position)->submitButton(['value'=>'Save','class'=>'btn btn-primary']) ?>
                <?= $textForm->field($position)->button(['value'=>'Reset','type'=>'reset','class'=>'btn btn-default']) ?>
                
                <a class="btn btn-danger pull-right" style="background-color: #EB3E28;" role="button" onclick="dellPosition(<?=$machine->id ?>)">
                    <span class="glyphicon glyphicon-remove"></span>
                    Delete Position
                </a>
            </div>
            <div class="clearfix"> </div>

        <?php HtmlHelper::endForm(); ?>

        <!---->
    </div>

</div>
<!--//grid-->

<div class="col-md-3 gallery-grids-left protorow hidden">
    <input type="file" class="hidden" name="" accept="image/jpeg,image/png">
    <div class="gallery-grid shippments_grid">
        <img src="" alt="">
        <a class="btn btn-danger btn-rem" role="button" title="Delete" onclick="dellImgPrew(this)">
            <span class="glyphicon glyphicon-remove"></span>
        </a>
    </div>
    <label for="">
    </label>
</div>

<script src="<?=_rootDIR_HTTP_?>/modules/almadmin/views/js/uploadFile.js?ver=<?=time()?>"></script>






