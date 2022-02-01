<?php
use dtw\HtmlHelper;
use widget\WeBuy;

$this->setVar([
    'activeAbout' => 'active'
]);
?>
<!--about start here-->
<div class="about agileinfo">
    <div class="container">
        <div class="about-main w3l-a">
            <div class="about-top">
                <h2>About Us</h2>
                <div class="col-md-4 abouttop-left">
                    <a href="#"><img src="<?=HtmlHelper::URL('/views/images/about/'.$img->img_name)?>" alt="" class="img-responsive"></a>
                </div>
                <div class="col-md-8 abouttop-right">
                    <h4><a href="#"><?= html_entity_decode($aboutus[0]->text_en) ?></a></h4>
                    <p><?= html_entity_decode($aboutus[1]->text_en) ?></p>
                </div>
                <div class="clearfix"> </div>
            </div>
        </div>
        <!--<div class="team" id="team">

            <h3>Our Team</h3>
            <div class="col-md-3 bottom-grid ">
                <div class="btm-right">
                    <img src="<?=HtmlHelper::URL('/views/images/t1.jpg')?>" class="img-responsive" alt=" ">
                    <div class="captn">
                        <h4>Victoria</h4>
                        <p>Vivamus </p>
                        <ul class="captn2">
                            <li><a href="#" class="icon1"></a></li>
                            <li><a href="#" class="icon2"></a></li>
                            <li><a href="#" class="icon3"></a></li>
                        </ul>
                    </div>
                </div>
            </div>
            <div class="col-md-3 bottom-grid ">
                <div class="btm-right">
                    <img src="<?=HtmlHelper::URL('/views/images/t2.jpg')?>" class="img-responsive" alt=" ">
                    <div class="captn">

                        <h4>Adley</h4>
                        <p>Vivamus </p>
                        <ul class="captn2">
                            <li><a href="#" class="icon1"></a></li>
                            <li><a href="#" class="icon2"></a></li>
                            <li><a href="#" class="icon3"></a></li>
                        </ul>
                    </div>
                </div>
            </div>
            <div class="col-md-3 bottom-grid ">
                <div class="btm-right">
                    <img src="<?=HtmlHelper::URL('/views/images/t3.jpg')?>" class="img-responsive" alt=" ">
                    <div class="captn">

                        <h4>Immortal</h4>
                        <p>Vivamus </p>
                        <ul class="captn2">
                            <li><a href="#" class="icon1"></a></li>
                            <li><a href="#" class="icon2"></a></li>
                            <li><a href="#" class="icon3"></a></li>
                        </ul>
                    </div>
                </div>
            </div>
            <div class="col-md-3 bottom-grid ">
                <div class="btm-right">
                    <img src="<?=HtmlHelper::URL('/views/images/t4.jpg')?>" class="img-responsive" alt=" ">
                    <div class="captn">

                        <h4>Warlike</h4>
                        <p>Vivamus </p>
                        <ul class="captn2">
                            <li><a href="#" class="icon1"></a></li>
                            <li><a href="#" class="icon2"></a></li>
                            <li><a href="#" class="icon3"></a></li>
                        </ul>
                    </div>
                </div>
            </div>
            <div class="clearfix"></div>
        </div>-->

        <!--<div class="history">
            <div class="history-top">
                <h3>Our History</h3>
            </div>
            <div class="history-bottom">
                <div class="col-md-4 history-grids">
                    <h4>2016</h4>
                    <p>Integer rutrum ante eu lacuestibulum libero nisl porta vel scelerisque eget malesuada at neque Vivamus eget nibh. Etiamursus leo vel metus. Nulla facilisi.</p>
                </div>
                <div class="col-md-4 history-grids">
                    <h4>2015</h4>
                    <p>Integer rutrum ante eu lacuestibulum libero nisl porta vel scelerisque eget malesuada at neque Vivamus eget nibh. Etiamursus leo vel metus. Nulla facilisi.</p>
                </div>
                <div class="col-md-4 history-grids">
                    <h4>2014</h4>
                    <p>Integer rutrum ante eu lacuestibulum libero nisl porta vel scelerisque eget malesuada at neque Vivamus eget nibh. Etiamursus leo vel metus. Nulla facilisi.</p>
                </div>
                <div class="clearfix"> </div>
            </div>
            <div class="history-bottom">
                <div class="col-md-4 history-grids">
                    <h4>2013</h4>
                    <p>Integer rutrum ante eu lacuestibulum libero nisl porta vel scelerisque eget malesuada at neque Vivamus eget nibh. Etiamursus leo vel metus. Nulla facilisi.</p>
                </div>
                <div class="col-md-4 history-grids">
                    <h4>2012</h4>
                    <p>Integer rutrum ante eu lacuestibulum libero nisl porta vel scelerisque eget malesuada at neque Vivamus eget nibh. Etiamursus leo vel metus. Nulla facilisi.</p>
                </div>
                <div class="col-md-4 history-grids">
                    <h4>2011</h4>
                    <p>Integer rutrum ante eu lacuestibulum libero nisl porta vel scelerisque eget malesuada at neque Vivamus eget nibh. Etiamursus leo vel metus. Nulla facilisi.</p>
                </div>
                <div class="clearfix"> </div>
            </div>
        </div>-->
    </div>
</div>
<!--about end here-->

<?= WeBuy::widget(); ?>
