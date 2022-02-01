<?php
use dtw\HtmlHelper;
?>
<!DOCTYPE HTML>
<html>
<head>
    <title><?= $this->title ?></title>
    <link href="<?=HtmlHelper::URL('/views/css/bootstrap.css')?>" rel="stylesheet" type="text/css" media="all">
    <!-- jQuery (necessary for Bootstrap's JavaScript plugins) -->
    <script src="<?=HtmlHelper::URL('/views/js/jquery-1.11.0.min.js')?>"></script>
    <!-- Custom Theme files -->
    <link href="<?=HtmlHelper::URL('/views/css/style.css?ver='.time())?>" rel="stylesheet" type="text/css" media="all"/>
    <!-- Custom Theme files -->
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
    <meta name="keywords" content="machines, AlmTrade, stanko, COLCHESTER, DECKEL, used-machines, used machines, Sell Buy Used
Machine Tools & Accessories" />
    <script type="application/x-javascript"> addEventListener("load", function() { setTimeout(hideURLbar, 0); }, false); function hideURLbar(){ window.scrollTo(0,1); } </script>
    <!--Google Fonts-->
    <link href='//fonts.googleapis.com/css?family=Nixie+One' rel='stylesheet' type='text/css'>
    <link href='//fonts.googleapis.com/css?family=Open+Sans:400,300,300italic,400italic,600,600italic,700,700italic,800,800italic' rel='stylesheet' type='text/css'>
    <script src="<?=HtmlHelper::URL('/views/js/bootstrap.min.js')?>"></script>
    <!-- animation-effect -->
    <link href="<?=HtmlHelper::URL('/views/css/animate.min.css')?>" rel="stylesheet">
    <script src="<?=HtmlHelper::URL('/views/js/wow.min.js')?>"></script>
    <script>
        new WOW().init();
    </script>
    <!-- //animation-effect -->
    <?php $this->head() ?>
</head>
<body>
<?php $this->beginBody() ?>
<!--header start here-->
<div class="banner">
    <div class="header">
        <div class="container">
            <div class="col-md-10 logo wow fadeInLeft animated animated" data-wow-delay=".2s" style="visibility: visible; animation-delay: 0.5s; animation-name: fadeInLeft;">
                <a href="<?=HtmlHelper::URL('/')?>">
                    <h2 style="color: #fff;">
                        <img src="<?=HtmlHelper::URL('/views/images/logo.png')?>" height="70px">
                        
                        <span class="logoText"><?= html_entity_decode($this->varBlock->logotext)?></span>
                    </h2>
                </a>
            </div>
            <div class="col-md-2 details wow fadeInRight animated animated" data-wow-delay=".5s" style="visibility: visible; animation-delay: 0.5s; animation-name: fadeInRight;">
                <div class="social">
                    <ul>
                        <li><a href="http://www.facebook.com/alm-trade-sro" class="facebook"> </a></li>
                        <li>&nbsp;</li>
                        <li class="slovFlag"><img style="opacity: 0.8;" src="<?=HtmlHelper::URL('/views/images/Slovakian_flag3.png')?>" height="40px" alt="Slovakia" title="Slovakia"></li>
                    </ul>

                </div>
            </div>
            <div class="clearfix"> </div>
        </div>
    </div>
    <div class="top-nav">
        <div class="container">
            <div class="navbar-header">
                <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#navbar" aria-expanded="false" aria-controls="navbar">
                    <span class="sr-only">Toggle navigation</span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                </button>
            </div>
            <div id="navbar" class="navbar-collapse collapse">
                <ul class="nav navbar-nav wow fadeInRight animated animated" data-wow-delay=".5s" style="visibility: visible; animation-delay: 0.5s; animation-name: fadeInRight;">
                    <li><a href="<?=HtmlHelper::URL('/home')?>" class="<?=$this->varBlock->activeHome?>">Home</a></li>
                    <li><a href="<?=HtmlHelper::URL('/about')?>" class="<?=$this->varBlock->activeAbout?>">About</a></li>
                    <li><a href="<?=HtmlHelper::URL('/stock')?>" class="<?=$this->varBlock->activeStock?>">Stock</a></li>
                    <li><a href="<?=HtmlHelper::URL('/shipments')?>" class="<?=$this->varBlock->activeShipments?>">Shipments</a></li>
                    <li><a href="<?=HtmlHelper::URL('/contacts')?>" class="<?=$this->varBlock->activeContacts?>">Contact</a></li>
                </ul>
            </div>
        </div>
    </div>
    <?= $this->blocks['homeHello'] ?>
</div>
<!--header end here-->
<?= $content; ?>
<!--footer start here-->
<div class="footer agileits-f">
    <div class="container">
        <div class="col-md-6 footer-grid agileinfo-f wow fadeInUp animated animated visitedEvents" data-wow-delay=".5s" style="visibility: visible; animation-delay: 0.5s; animation-name: fadeInUp;">
            <h3>We had visited these events</h3>
            <div class="footer-grid-left agile-f">
                <a href="#"><img src="<?=HtmlHelper::URL('/views/images/brand_logos/Resale_logo_2005.JPG')?>" alt=" " class="img-responsive"></a>
            </div>
            <div class="footer-grid-left agile-f">
                <a href="#"><img src="<?=HtmlHelper::URL('/views/images/brand_logos/Resale_logo_2007.jpg')?>" alt=" " class="img-responsive"></a>
            </div>
            <div class="footer-grid-left agile-f">
                <a href="#"><img src="<?=HtmlHelper::URL('/views/images/brand_logos/Resale_logo_2008.jpg')?>" alt=" " class="img-responsive"></a>
            </div>
            <div class="footer-grid-left agile-f">
                <a href="#"><img src="<?=HtmlHelper::URL('/views/images/brand_logos/Resale_logo2010.jpg')?>" alt=" " class="img-responsive"></a>
            </div>
            <div class="footer-grid-left agile-f">
                <a href="#"><img src="<?=HtmlHelper::URL('/views/images/brand_logos/USETEC-Logo_1.jpg')?>" alt=" " class="img-responsive"></a>
            </div>
            <div class="footer-grid-left agile-f">
                <a href="#"><img src="<?=HtmlHelper::URL('/views/images/brand_logos/ReTec_2017_logo.jpg')?>" alt=" " class="img-responsive"></a>
            </div>
            <div class="clearfix"> </div>
        </div>
        <div class="col-md-6 footer-grid wthree-f wow fadeInRight animated animated" data-wow-delay=".5s" style="visibility: visible; animation-delay: 0.5s; animation-name: fadeInRight;">
            <h3>Contact Info</h3>
            <ul class="footer-address">
                <li><span class="glyphicon glyphicon-home" aria-hidden="true"></span><?= html_entity_decode($this->varBlock->address)?></li>
                <li><span class="glyphicon glyphicon-envelope" aria-hidden="true"></span><a href="mailto:almtradesro@gmail.com"><?= html_entity_decode($this->varBlock->email)?></a></li>
                <li><span class="glyphicon glyphicon-earphone" aria-hidden="true"></span><?= html_entity_decode($this->varBlock->phones)?></li>
            </ul>
        </div>
        <div class="clearfix"> </div>
    </div>
</div>
<!--footer end here-->
<!--copy right-->
<div class="footer-copy w3ls-c wow fadeInUp animated animated" data-wow-delay=".5s" style="visibility: visible; animation-delay: 0.5s; animation-name: fadeInUp;">
    <div class="container">
        <p>© 2019 AlmTrade s.r.o. All rights reserved | Powered by <a href="#">Dantov's framework</a> | Design by <a href="http://w3layouts.com/">W3layouts</a></p>
    </div>
</div>
<!--/copy rights-->
<?php $this->endBody() ?>
</body>
</html>