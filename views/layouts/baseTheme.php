<?php
use dtw\HtmlHelper;
?>
<!DOCTYPE HTML>
<html>
<head>
    <!-- Тег meta для указания кодировки -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?= $this->title ?></title>

    <?php $this->head() ?>
</head>

<body style="background: #2bd5a3">
<?php $this->beginBody() ?>
<div id="container">
    <div id="main">
<nav class="navbar navbar-default">
    <div class="container-fluid">
        <!-- Brand and toggle get grouped for better mobile display -->
        <div class="navbar-header">
            <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1" aria-expanded="false">
                <span class="sr-only">Toggle navigation</span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
            </button>
            <a class="navbar-brand" href="#">DTW framefork</a>
        </div>

        <!-- Collect the nav links, forms, and other content for toggling -->
        <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
            <ul class="nav navbar-nav">
                <li class="<?= $this->varBlock->activeBase ?>"><a href="<?= HtmlHelper::URL('/base') ?>">Base<span class="sr-only">(current)</span></a></li>
                <li class="<?= $this->varBlock->activeMain ?>"><a href="<?= HtmlHelper::URL('/main/otototo') ?>">Main</a></li>
                <li class="<?= $this->varBlock->activeFiles ?>"><a href="<?= HtmlHelper::URL('/files') ?>">Files</a></li>
                <li class="<?= $this->varBlock->activeForm ?>"><a href="<?= HtmlHelper::URL('/form') ?>">Forms</a></li>
                <li class="dropdown">
                    <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">Dropdown <span class="caret"></span></a>
                    <ul class="dropdown-menu">
                        <li><a href="#">Action</a></li>
                        <li><a href="#">Another action</a></li>
                        <li><a href="#">Something else here</a></li>
                        <li role="separator" class="divider"></li>
                        <li><a href="#">Separated link</a></li>
                        <li role="separator" class="divider"></li>
                        <li><a href="#">One more separated link</a></li>
                    </ul>
                </li>
            </ul>
            <form class="navbar-form navbar-left">
                <div class="form-group">
                    <input type="text" class="form-control" placeholder="Search">
                </div>
                <button type="submit" class="btn btn-default">Submit</button>
            </form>
            <ul class="nav navbar-nav navbar-right">
                <li>
                    <?php if ( isset($this->session->getKey('user')['authorized']) ) { ?>
                        <a href="<?=HtmlHelper::URL('/admin/')?>">Hello Uzver</a>
                    <?php } else { ?>
                        <a href="<?=HtmlHelper::URL('/admin/loginForm/')?>">Login</a>
                    <?php } ?>
                </li>
                <li class="dropdown">
                    <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">Dropdown <span class="caret"></span></a>
                    <ul class="dropdown-menu">
                        <li><a href="#">Action</a></li>
                        <li><a href="#">Another action</a></li>
                        <li><a href="#">Something else here</a></li>
                        <li role="separator" class="divider"></li>
                        <li><a href="#">Separated link</a></li>
                    </ul>
                </li>
            </ul>
        </div><!-- /.navbar-collapse -->
    </div><!-- /.container-fluid -->
</nav>
<div class="container">
<?= $content; ?>
</div>
    </div>
</div>
<footer id="footer">
    <img style="margin-top: 25px;" height="50px" src="<?=HtmlHelper::URL('/vendor/assets/logoDTW.png', true)?>"/>
</footer>

<?php $this->endBody() ?>
</body>

</html>