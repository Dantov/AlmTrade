<?php
use dtw\HtmlHelper;
use widget\WeBuy;

$this->setVar([
    'activeStock' => 'active'
]);
?>

<!--gallery start here-->
<div class="gallery w3" id="gallery">
    <div class="container">
        <div class="gallery-main">
            <div class="gallery-top">
                <h2>
                    For Sale, Always up-to-date
                </h2>
            </div>
            <?php //debug($machines,'',1)?>
            <div class="gallery-bott">
                <?php for ($i = 0; $i < count($machines); $i++): ?>
                <div class="col-md-4 col1 gallery-grid">
                    <div class="ratio">
                        <a href="<?=HtmlHelper::URL('/stock/show/'. $machines[$i]->id)?>" rel="title" class="b-link-stripe b-animate-go  thickbox">
                            <div class="ratio-inner ratio-4-3">
                                <div class="ratio-content">
                                    <?php if ( $machines[$i]->status == 1 ): ?>
                                        <img src="<?=\dtw\HtmlHelper::URL('/views/images/hot_sale1.png')?>" width="60px" class="img-responsive hotPosition">
                                    <?php endif;?>
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
                                    ?>
                                    <figure class="hov111 effect-bubba" style="background: url('<?= HtmlHelper::URL('/views/images/stock/'.$imgsrc)?>') 50% 50% no-repeat; background-size: cover; background-color: #a0431a" >
                                        <img class="img-responsive" width="500px" height="350px" src="<?= HtmlHelper::URL('/views/images/stock/stock_dummy.png')?>" alt="">
                                        <figcaption class="effect-bva">
                                            <?php if ( $machines[$i]->status == -1 ): ?>
                                                <img src="<?=\dtw\HtmlHelper::URL('/views/images/sold-big.png')?>" class="img-responsive soldPosition">
                                            <?php endif;?>
                                            <h4 class="gal"><?=$machines[$i]->short_name?></h4>
                                            <p class="gal1"><?=$machines[$i]->name?><br><i>get more</i></p>
                                        </figcaption>
                                    </figure>
                                    <div class="stockPosNameUp"><h4 class="stockPosNameUpH4"><?=$machines[$i]->short_name?></h4></div>
                                </div>
                            </div>
                        </a>
                    </div>
                </div>
                <?php endfor; ?>
                <div class="clearfix"> </div>
            </div>
        </div>
    </div>
</div>
<!--gallery end here-->

<?= WeBuy::widget(); ?>