<?php
use dtw\HtmlHelper;

$this->setVar([
    'activeContacts' => 'active'
]);
?>
<!--contact start here-->
<div class="contact w3agile">
    <div class="container">
        <div class="contact-main w3l-co">
            <div class="col-md-6 contact-left">
                <div class="contact-top">
                    <h2>Head Office</h2>
                </div>
                <?php for ($i = 0; $i < count($contacts); $i++): ?>
                <div class="conta-2 agile-co">
                    <div class="con-address">
                        <?= $img[$contacts[$i]->img] ?>
                        <div class="con-para">
                            <h6><?= html_entity_decode($contacts[$i]->name) ?></h6>
                            <p><?= html_entity_decode($contacts[$i]->descr) ?></p>
                        </div>
                        <div class="clearfix"></div>
                    </div>
                </div>
                <?php endfor; ?>
            </div>
            <div class="col-md-6 contact-right w3agile-co">
                <div class="contact-top">
                    <h3>Send a Message</h3>
                    <p>If You have any questions about our products please send mail to us.</p>
                </div>
                <?php if ( $this->session->hasFlash('success_sended') ): ?>
                    <div class="alert alert-success alert-dismissible" role="alert">
                        <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                        <strong> <?=$this->session->getFlash('success_sended');?> </strong>
                    </div>
                <?php endif; ?>
                <?php if ( $this->session->hasFlash('error_sended') ): ?>
                    <div class="alert alert-danger alert-dismissible" role="alert">
                        <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                        <strong> <?=$this->session->getFlash('error_sended');?> </strong>
                    </div>
                <?php endif; ?>
                <form action="/newAlmTrade/contacts/sendmail/1" method="post" id="mailform">
                    <input type="text" class="shart" name="name" id="name" placeholder="NAME">
                    <input type="text" class="shart" name="email" id="email" placeholder="EMAIL">
                    <input type="text" class="long" name="subject" id="subject" placeholder="SUBJECT">
                    <textarea name="message" id="message" placeholder="MESSAGE"></textarea>
                    <input type="submit" value="Submit">
                </form>
            </div>
            <div class="clearfix"></div>
        </div>
        <div class="map agileits-mp">
            <iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d5324.087339893496!2d17.113553538944057!3d48.148031161880596!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x476c8945eee93911%3A0x50fabbc9731c8bdc!2zxaBwaXTDoWxza2EgNTUtNDcsIDgxMSAwOCBCcmF0aXNsYXZhLCDQodC70L7QstCw0LrQuNGP!5e0!3m2!1sru!2sua!4v1550151896667" style="border:0" allowfullscreen></iframe>
        </div>
    </div>
</div>
<!--contact end here-->
