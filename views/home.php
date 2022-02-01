<?php
    use widget\WeBuy;
    
    $this->setVar([
    'activeHome' => 'active'
    ]);
    
?>

<?php $this->startBlock('homeHello'); ?>
<div class="container">
    <div class="banner-bottom wow fadeInLeft animated animated" data-wow-delay=".5s" style="visibility: visible; animation-delay: 0.5s; animation-name: fadeInLeft;">
        <div class="bann-para">
            <h2><?=html_entity_decode($homeLogos->maintext)?></h2>
            <p><?=html_entity_decode($homeLogos->offtext)?></p>
        </div>
    </div>
</div>
<?php $this->endBlock(); ?>

<!--welcome start here-->
<div class="welcome w3l">
    <div class="container">
        <div class="wel-main">
            <div class="wel-top">
                <h3>Our Hot Offers</h3>
            </div>
            <div class="wel-bottom">
                <?php for ($i = 0; $i < count($machines); $i++): ?>
                <div class="col-md-4 wel-left wow fadeInLeft animated animated" data-wow-delay=".5s" style="visibility: visible; animation-delay: 0.5s; animation-name: fadeInLeft;">
                    <a href="<?=\dtw\HtmlHelper::URL('/stock/show/'.$machines[$i]->id)?>">
                    <div class="wel-block">
                        <div class="wel-text">
                            <h4><?= $machines[$i]->short_name ?></h4>
                            <p><?= $machines[$i]->name ?></p>
                        </div>
                        <div class="wel-img">
                            <img src="<?=\dtw\HtmlHelper::URL('/views/images/hot_sale1.png')?>" width="60px" class="img-responsive hotPosition">
                            <img src="<?=\dtw\HtmlHelper::URL('/views/images/stock/' . $machines[$i]->images[0]->img_name )?>" alt="" class="img-responsive">
                        </div>
                        <div class="clearfix"> </div>
                    </div>
                    </a>
                </div>
                <?php endfor; ?>
                <div class="clearfix"> </div>
            </div>
        </div>
    </div>
</div>
<!--welcome end here-->

<?= WeBuy::widget(); ?>

<!--our admissions start here-->
<div class="admission wthree">
    <div class="container">
        <div class="admissions-main">
            <div class="admission-top">
                <h3>The Brands we deal with</h3>
            </div>
            <div class="admission-bottom">
                    <div class="morelogos">
                        <img src="<?=\dtw\HtmlHelper::URL('/views/images/brand_logos/WMW_logo.JPG')?>">
                        <img src="<?=\dtw\HtmlHelper::URL('/views/images/brand_logos/Sedin.JPG')?>">
                        <img src="<?=\dtw\HtmlHelper::URL('/views/images/brand_logos/studer_logo.png')?>">
                        <img src="<?=\dtw\HtmlHelper::URL('/views/images/brand_logos/Churchill_logo.JPG')?>">
                        <img src="<?=\dtw\HtmlHelper::URL('/views/images/brand_logos/hause-bienne_logo.jpg')?>">
                        <img src="<?=\dtw\HtmlHelper::URL('/views/images/brand_logos/kellenberger-studer_logo.jpg')?>">
                        <img src="<?=\dtw\HtmlHelper::URL('/views/images/brand_logos/jones-shipman_logo.jpg')?>">
                        <img src="<?=\dtw\HtmlHelper::URL('/views/images/brand_logos/sip_logo.png')?>">
                        <img src="<?=\dtw\HtmlHelper::URL('/views/images/brand_logos/WMW_Schriftzug_logo.jpg')?>">
                        <img src="<?=\dtw\HtmlHelper::URL('/views/images/brand_logos/bwf-logo.jpg')?>">
                        <img src="<?=\dtw\HtmlHelper::URL('/views/images/brand_logos/microsa_logo.gif')?>">
                        <img src="<?=\dtw\HtmlHelper::URL('/views/images/brand_logos/TOS_logo.JPG')?>">
                        <img src="<?=\dtw\HtmlHelper::URL('/views/images/brand_logos/schaudt_logo.jpg')?>">
                        <img src="<?=\dtw\HtmlHelper::URL('/views/images/brand_logos/voumard_logo.jpg')?>">
                        <img src="<?=\dtw\HtmlHelper::URL('/views/images/brand_logos/elb_logo.gif')?>">
                        <img src="<?=\dtw\HtmlHelper::URL('/views/images/brand_logos/blohm_logo.jpg')?>">
                        <img src="<?=\dtw\HtmlHelper::URL('/views/images/brand_logos/dixi_logo.jpg')?>">
                        <img src="<?=\dtw\HtmlHelper::URL('/views/images/brand_logos/MIKRON-Logo.jpg')?>">
                        <img src="<?=\dtw\HtmlHelper::URL('/views/images/brand_logos/htg_logo.jpg')?>">
                        <img src="<?=\dtw\HtmlHelper::URL('/views/images/brand_logos/sip_logo-1.jpg')?>">
                        <img src="<?=\dtw\HtmlHelper::URL('/views/images/brand_logos/tripet-machines_logo.jpg')?>">
                    </div>
                <div class="clearfix"> </div>
            </div>
        </div>
    </div>
</div>
<!--our admissions end here-->