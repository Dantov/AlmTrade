<!--testimonial start here-->
<div class="testimo w3ls">
    <div class="container">
        <div class="testimo-main wow bann-para2 fadeInUp animated" data-wow-delay=".5s" style="visibility: visible; animation-delay: 0.5s; animation-name: fadeInUp;">
            <h3>We are looking for following</h3>
            <?php for ($i = 0; $i < count($this->webuy); $i++): ?>
            <p style="text-align: justify;"><?= html_entity_decode($this->webuy[$i]->name) ?></p>
            <?php endfor; ?>
        </div>
    </div>
</div>
<!--testimonial end here-->

