<!DOCTYPE HTML>
<html>
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title></title>

    <link href="<?= _rootDIR_HTTP_ ?>\vendor\libraries\Bootstrap\v3.3.7\bootstrap.min.css" rel="stylesheet">
    <link href="<?= _rootDIR_HTTP_ ?>\vendor\libraries\Bootstrap\v3.3.7\bootstrap-theme.min.css" rel="stylesheet">
</head>

<body style="">
<div class="container">

    <div class="jumbotron" style="margin-top: 15px">
        <?php if ( $this->err_lvl ) { ?>
            <h1>Type:   <b><?= $this->errorCodes[$errno]; ?></b> code: <i><?= $code ?></i></h1>
            <p>Message: <b><?= $message; ?></b> </p>
            <p>Path: <?= $errfile; ?> </p>
            <p>Line: <?= $errline; ?> </p>
            <p>File: <b><?= $info->getFilename(); ?></b></p>
            <p><?php //debug($trace); ?></p>

            <div style="background: #f7f7f7; padding: 10px;">
            <table class="table table-condensed table-hover">
                <thead>
                    <tr>
                        <th align="center">№</th>
                        <th align="center">code:</th>
                    </tr>
                </thead>
                <tbody>
                <?php
                    $active = '';
                    $bold = [];
                    $bold['open'] = "";
                    $bold['close'] = "";
                    for ( $i = $startLine; $i < $endLine; $i++ ) {
                        if ( $i == $errline-1 ) {
                            $active = 'class="success"';
                            $bold['open'] = "<b>";
                            $bold['close'] = "</b>";
                        }
                ?>
                    <tr <?= $active ?> >
                        <td style=" border-top: 0px"><?= $i+1 ?></td>
                        <td style=" border-top: 0px"><?= $bold['open'] . htmlspecialchars($lines[$i]) . $bold['close'] ?></td>
                    </tr>
                <?php
                        $active = '';
                        $bold['open'] = "";
                        $bold['close'] = "";
                    }
                ?>
                </tbody>
            </table>
            </div>
            <p></p>
            <p> <?=  "PHP ver. " . PHP_VERSION . " (" . PHP_OS . ")" ?> </p>
        <?php } else { ?>
            <h2>internal server error! <b><?= $code ?></b></h2>
            <p>Try again later.</p>
        <?php } ?>
    </div>

</div>
<script src="<?= _rootDIR_HTTP_ ?>\vendor\libraries\JQuery\jquery-3.2.1.min.js"></script>
<script src="<?= _rootDIR_HTTP_ ?>\vendor\libraries\Bootstrap\v3.3.7\bootstrap.min.js"></script>
</body>

</html>