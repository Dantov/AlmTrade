<?php
    use dtw\HtmlHelper;
?>
<!DOCTYPE HTML>
<html>
<head>
<title><?= $this->title ?></title>
<meta name="viewport" content="width=device-width, initial-scale=1">
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<meta name="keywords" content="" />
<script type="application/x-javascript"> addEventListener("load", function() { setTimeout(hideURLbar, 0); }, false); function hideURLbar(){ window.scrollTo(0,1); } </script>
<!-- Bootstrap Core CSS -->
<link href="<?= HtmlHelper::URL('modules/almadmin/views/css/bootstrap.min.css')?>" rel='stylesheet' type='text/css' />
<!-- Custom CSS -->
<link rel='stylesheet' href="<?= HtmlHelper::URL('modules/almadmin/views/css/style.css?v='.time())?>" type='text/css' />
<link rel="stylesheet" href="<?= HtmlHelper::URL('modules/almadmin/views/css/morris.css')?>" type="text/css"/>
<!-- Graph CSS -->
<link href="<?= HtmlHelper::URL('modules/almadmin/views/css/font-awesome.css')?>" rel="stylesheet"> 
<script src="<?= HtmlHelper::URL('modules/almadmin/views/js/jquery-2.1.4.min.js')?>"></script>
<link href='//fonts.googleapis.com/css?family=Roboto:700,500,300,100italic,100,400' rel='stylesheet' type='text/css'/>
<link href='//fonts.googleapis.com/css?family=Montserrat:400,700' rel='stylesheet' type='text/css'>
<link rel="stylesheet" href="<?= HtmlHelper::URL('modules/almadmin/views/css/icon-font.min.css')?>" type='text/css' />
<?php $this->head() ?>
</head> 

<body>
<?php $this->beginBody() ?>
<div class="page-container">
<!--/content-inner-->
<div class="left-content">
<div class="mother-grid-inner">
    <!--header start here-->
    <div class="header-main">
        
    <div class="logo-w3-agile">
        <h1><a><?=$this->varBlock->headtext?> Admin mode</a></h1>
    </div>

    <div class="profile_details w3l pull-right">		
        <ul>
            <li class="dropdown profile_details_drop">
                <a href="<?= HtmlHelper::URL('/')?>" class="dropdown-toggle" data-toggle="dropdown" aria-expanded="false">
                    <div class="profile_img">	
                        <span class="prfil-img"><img src="<?= HtmlHelper::URL('/admin/views/images/admLogo.gif', true)?>" alt=""> </span> 
                        <div class="user-name">
                            <p>TestName</p>
                            <span>Administrator</span>
                        </div>
                        <i class="fa fa-angle-down"></i>
                        <i class="fa fa-angle-up"></i>
                        <div class="clearfix"></div>	
                    </div>	
                </a>
                <ul class="dropdown-menu drp-mnu">
                    <li> <a href="#"><i class="fa fa-cog"></i> Settings</a> </li> 
                    <li> <a href="#"><i class="fa fa-user"></i> Profile</a> </li> 
                    <li> <a href="<?=HtmlHelper::URL('almadmin/admin/exit/1')?>"><i class="fa fa-sign-out"></i> Logout</a> </li>
                </ul>
            </li>
        </ul>
    </div>
    <div class="clearfix"> </div>	
</div>
<!--heder end here-->

<?= $content; ?>

<!-- script-for sticky-nav -->
<script>
$(document).ready(function() {
    var navoffeset=$(".header-main").offset().top;
    $(window).scroll(function(){
           var scrollpos=$(window).scrollTop(); 
           if(scrollpos >=navoffeset){
                $(".header-main").addClass("fixed");
           }else{
                $(".header-main").removeClass("fixed");
           }
    });
});
</script>
<!-- /script-for sticky-nav -->
    <!--inner block start here-->
    <div class="inner-block">
    </div>
    <!--inner block end here-->
    <!--copy rights start here-->
    <div class="copyrights">
        <p>© <?=getdate()['year']?> AlmTrade s.r.o. | <a href="#" target="_blank">Powered by Dantov's framework</a></p>
    </div>	
    <!--COPY rights end here-->
</div>
<!--//mother-grid-inner-->
</div>
<!--//left-content-->
			
<!--/sidebar-menu-->
<div class="sidebar-menu">
    <header class="logo1">
        <a href="#" class="sidebar-icon"> <span class="fa fa-bars"></span> </a> 
    </header>
    <div style="border-top:1px ridge rgba(255, 255, 255, 0.15)"></div>
    <div class="menu">
        <ul id="menu" >
            <li><a href="<?= HtmlHelper::URL('/')?>"><i class="fa fa-tachometer"></i> <span>Statistic</span><div class="clearfix"></div></a></li>
            <li><a href="<?=HtmlHelper::URL('almadmin/gallery')?>"><i class="fa fa-picture-o" aria-hidden="true"></i><span>Gallery</span><div class="clearfix"></div></a></li>
            <li id="menu-academico" ><a href="#"><i class="fa fa-file-text-o"></i>  <span>Web Pages</span> <span class="fa fa-angle-right" style="float: right"></span><div class="clearfix"></div></a>
                <ul id="menu-academico-sub" >
                    <li id="menu-academico-boletim" ><a href="<?=HtmlHelper::URL('almadmin/home')?>">Home</a></li>
                    <li id="menu-academico-avaliacoes" ><a href="<?=HtmlHelper::URL('almadmin/about')?>">About</a></li>
                    <li id="menu-academico-avaliacoes" ><a href="<?=HtmlHelper::URL('almadmin/stock')?>">Stock</a></li>
                    <li id="menu-academico-avaliacoes" ><a href="<?=HtmlHelper::URL('almadmin/shipments')?>">Shipments</a></li>
                    <li id="menu-academico-avaliacoes" ><a href="<?=HtmlHelper::URL('almadmin/contacts')?>">Contacts</a></li>
                </ul>
            </li>
            <li id="menu-academico" ><a href="<?=HtmlHelper::URL('almadmin/webuy')?>"><i class="fa fa-list-ul"></i><span>We Buy</span><div class="clearfix"></div></a></li>
            <li id="menu-academico" ><a href="<?=HtmlHelper::URL('almadmin/mailbox')?>"><i class="fa fa-envelope nav_icon"></i><span>Mail Box</span><div class="clearfix"></div></a></li>
        </ul>
    </div>
</div>
<div class="clearfix"></div>		
</div>

<script>
var toggle = true;
$(".sidebar-icon").click(function() {                
  if (toggle)
  {
    $(".page-container").addClass("sidebar-collapsed").removeClass("sidebar-collapsed-back");
    $("#menu span").css({"position":"absolute"});
  }
  else
  {
    $(".page-container").removeClass("sidebar-collapsed").addClass("sidebar-collapsed-back");
    setTimeout(function() {
      $("#menu span").css({"position":"relative"});
    }, 400);
  }

    toggle = !toggle;
});
</script>
<!--js -->
<script src="<?= HtmlHelper::URL('modules/almadmin/views/js/jquery.nicescroll.js') ?>"></script>
<script src="<?= HtmlHelper::URL('modules/almadmin/views/js/scripts.js') ?>"></script>
<!-- Bootstrap Core JavaScript -->
<script src="<?= HtmlHelper::URL('modules/almadmin/views/js/bootstrap.min.js') ?>"></script>
<!-- /Bootstrap Core JavaScript -->	   
<!-- morris JavaScript -->	
<script src="<?= HtmlHelper::URL('modules/almadmin/views/js/raphael-min.js') ?>"></script>
<script src="<?= HtmlHelper::URL('modules/almadmin/views/js/morris.js') ?>"></script>
<?php $this->endBody() ?>
</body>
</html>