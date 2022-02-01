<?php
use dtw\HtmlHelper;
use widget\WeBuy;

$this->setVar([
    'activeShipments' => 'active'
]);

?>

<!--about start here-->
<div class="service agileits">
    <div class="container">
        <div class="ser-top">
            <h2>Our Shipments</h2>
            <p style="font-size: 20px">
                Here is our shipments that we did recently!
            </p>
        </div>
        <div class="service-head">
            <div class="col-md-12 footer-grid agileinfo-f wow fadeInUp animated animated" data-wow-delay=".5s" style="visibility: visible; animation-delay: 0.5s; animation-name: fadeInUp;">
                <?php for ($i = 0; $i < count($shipments); $i++): ?>
                <div class="footer-grid-left agile-f shippments">
                    <div class="ratio">
                        <a href="#">
                            <div class="ratio-inner ratio-4-3">
                                <div class="ratio-content">
                                    <img src="<?=HtmlHelper::URL('/views/images/shipments/'.$shipments[$i]->img)?>" alt=" " class="img-responsive">
                                </div>
                            </div>
                        </a>
                    </div>
                    <span class="shipment_descr"><?=$shipments[$i]->descr?></span>
                </div>
                <?php endfor; ?>
                <div class="clearfix"></div>
            </div>
        </div>
    </div>
</div>
<!--about end here-->

<?= WeBuy::widget(); ?>