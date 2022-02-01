<?php
use dtw\HtmlHelper;
use widget\WeBuy;
$this->setVar([
    'activeStock' => 'active'
]);
$this->title = "AlmTrade s.r.o :: " . $machine->short_name;
?>
<!--welcome start here-->
<div class="welcome w3l">
    <div class="container">
        <div class="wel-main">
            <ol class="breadcrumb">
                <li><a href="<?=HtmlHelper::URL('/stock')?>">Stock</a></li>
                <li class="active" id="name"><?=$machine->name?></li>
            </ol>
            <?php //echo debug(count($machine->images),'',1)?>
            <div class="wel-top" style="position: relative;">
                <a class="" style="position: absolute; left: 0; bottom: 0;" href="<?= HtmlHelper::URL('/stock/show/'.$prev['id']) ?>" id="topprev" title="<?= $prev['short_name'] ?>"><h4>&#8592;Prev</h4></a>
                <h3><?=$machine->name?></h3>
                <a class="" style="position: absolute; right: 0; bottom: 0;" href="<?= HtmlHelper::URL('/stock/show/'.$next['id']) ?>" id="topnext" title="<?= $next['short_name'] ?>"><h4>Next&#8594;</h4></a>
            </div>
            <div class="clearfix"></div>

            <div class="col-xs-6 col-sm-6" id="images_block">
                <div class="row">

                    <div class="col-xs-12 mainImg wow fadeInLeft animated animated" data-wow-delay=".2s" style="visibility: visible; animation-delay: 0.2s; animation-name: fadeInLeft;">
                        <div class="image-zoom responsive">
                            <?php 
                            $images = $machine->images;
                            $imgsrc = "";
                            foreach ($images as $image) 
                            {
                                if ( $image->main == 1 )
                                {
                                    $imgsrc = $image->img_name;
                                    break;
                                }
                            }
                            if( empty($imgsrc) ) $imgsrc = $machine->images[0]->img_name;
                            if(!file_exists( _rootDIR_ . '/views/images/stock/'.$imgsrc) ) 
                            {
                                $imgsrc = "default.png";
                            }
                            
                            ?>
                            <img src="<?=HtmlHelper::URL('/views/images/stock/'.$imgsrc)?>" class="img-responsive image" num="<?php echo $num++; ?>">
                        </div>
                    </div>
                    <?php for ($i = 1; $i < count($machine->images); $i++): ?>
                    <div class="col-xs-12 col-sm-6 col-md-4 image wow fadeInLeft animated animated" data-wow-delay=".3s" style="visibility: visible; animation-delay: 0.3s; animation-name: fadeInLeft;">
                        <div class="ratio">
                            <div class="ratio-inner ratio-4-3">
                                <div class="ratio-content">
                                    <div class="image-zoom responsive">
                                        <img src="<?=HtmlHelper::URL('/views/images/stock/'.$machine->images[$i]->img_name)?>" class="img-responsive image" num="<?php ?>">
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div><!-- small img end -->
                    <?php endfor; ?>
                </div>
            </div><!-- images block -->

            <div class="col-xs-6 col-sm-5 col-sm-offset-1 descr">
                <p><strong>Description:</strong></p>
                <?= html_entity_decode($machine->description)?>
            </div>

        </div><!--row-->
        <div class="clearfix"></div>
            <small class="glyphicon glyphicon-calendar pull-left" title="">&#160;<?= date_create( $machine->date )->Format('d.m.Y'); ?></small>
            <small class="glyphicon glyphicon-eye-open pull-right" title="">&#160;<?="";//$machine->view;?></small>
            <div class="clearfix"></div>
    </div>
</div>
<!--welcome end here-->

<?= WeBuy::widget(); ?>

<div id="popup" class="popup hidden_popup">
  <div id="blackCover"></div>
  <div class="toper_popup" id="toper_popup">
	<div class="row">
            <div class="col-xs-2">
                    <span id="img_count" class="img_count pull-left"></span>
            </div>
            <div class="col-xs-8" style="text-align: center;">
                    <span id="model_name" class=""></span>
            </div>
            <div class="col-xs-2">
                    <span id="close_popup" class="close_popup pull-right"></span>
            </div>
	</div>
  </div>
  
  <div class="arrows" id="arrows">
    <div class="brackets pull-left" id="left-bracket" onclick="prev_next_Img(this);"><span class="glyphicon glyphicon-menu-left" aria-hidden="true"></span></div>
    <div class="brackets pull-right" id="right-bracket" onclick="prev_next_Img(this);"><span class="glyphicon glyphicon-menu-right" aria-hidden="true"></span></div>
  </div>
  
  <div class="popup_img" id="wrapper_img">
    <img src="" class="img-responsive">
  </div>
</div>
<span class="gallery-bott"></span><!-- для сток скрипкта -->