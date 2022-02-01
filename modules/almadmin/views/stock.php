<?php
use dtw\HtmlHelper;

$this->setVar([
    'headtext' => 'Stock'
]);
?>
<ol class="breadcrumb">
    <li class="breadcrumb-item"><a href="/almadmin">Admin</a><i class="fa fa-angle-right"></i>Stock</li>
</ol>
<?php if ( $this->session->hasFlash('error_dellPosition') ): ?>
    <div class="alert alert-danger alert-dismissible" role="alert">
        <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        <strong> <?=$this->session->getFlash('error_dellPosition');?> </strong>
    </div>
<?php endif; ?>
<?php if ( $this->session->hasFlash('success_dellPosition') ): ?>
    <div class="alert alert-success alert-dismissible" role="alert">
        <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        <strong> <?=$this->session->getFlash('success_dellPosition');?> </strong>
    </div>
<?php endif; ?>
<?php if ( $this->session->hasFlash('success_add') ): ?>
    <div class="alert alert-success alert-dismissible" role="alert">
        <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        <strong> <?=$this->session->getFlash('success_add');?> </strong>
    </div>
<?php endif; ?>
<?php if ( $this->session->hasFlash('error_add') ): ?>
    <div class="alert alert-success alert-dismissible" role="alert">
        <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        <strong> <?=$this->session->getFlash('error_add');?> </strong>
    </div>
<?php endif; ?>

<div class="row" style="margin: 1em 0 1em 0">
    <?php for ($i = 0; $i < count($machines); $i++): ?>
    <div class="col-md-3 col-sm-6">
        <div class="ratio">
            <div class="ratio-inner ratio-4-3">
                <div class="ratio-content">
                    <?php if ( $machines[$i]->status == 1 ): ?>
                        <img src="<?=\dtw\HtmlHelper::URL('/views/images/hot_sale1.png')?>" width="60px" class="img-responsive hotPosition">
                    <?php endif;?>
                    <?php if ( $machines[$i]->status == -1 ): ?>
                        <img src="<?=\dtw\HtmlHelper::URL('/views/images/sold-big.png')?>" class="img-responsive soldPosition">
                    <?php endif;?>
                    <div class="text-primary">
                        <strong><?= $machines[$i]->short_name ?></strong>
                    </div>
                    <?php 
                        $images = $machines[$i]->images;
                        $imgsrc = "";
                        foreach ($images as $image) 
                        {
                            if ( $image->main == 1 )
                            {
                                $imgsrc = $image->img_name;
                                break;
                            }
                        }
                        if( empty($imgsrc) ) $imgsrc = $machines[$i]->images[0]->img_name;
                        if(!file_exists( _rootDIR_ . '/views/images/stock/'.$imgsrc) ) 
                        {
                            $imgsrc = "default.png";
                        }
                        if( empty($imgsrc) ) $imgsrc = "default.png";
                    ?>
                    <img src="<?=HtmlHelper::URL('views/images/stock/'.$imgsrc)?>" class="img-responsive">
                </div>
            </div>
            <div class="text-muted margtop">
                <small class="glyphicon glyphicon-calendar pull-left"> <?= date_create( $machines[$i]->date )->Format('d.m.Y') ?></small>
                <small class="glyphicon glyphicon-eye-open pull-right"> <?= $machines[$i]->view ?></small>
            </div>
            <div class="clearfix"></div>
            <br/>
            <a href="<?=HtmlHelper::URL('almadmin/stock/show/'.$machines[$i]->id)?>" class="btn btn-default">
                <span class="glyphicon glyphicon-pencil"></span>
                Edit
            </a>
        </div>
    </div><!--item-->
    <?php endfor; ?>
    <div class="col-md-3 col-sm-6">
        <div class="ratio">
            <div class="ratio-inner ratio-4-3">
                <div class="ratio-content">
                    <div class="text-primary">&nbsp;</div>
                    <a href="<?=HtmlHelper::URL('almadmin/stock/add/new')?>" class="btn btn-default">
                        <span class="glyphicon glyphicon-file"></span>
                        Add new position
                    </a>
                </div>
            </div>
        </div>
    </div><!--item-->
</div>
