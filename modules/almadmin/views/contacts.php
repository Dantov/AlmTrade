<?php
    use dtw\HtmlHelper;
?>
<ol class="breadcrumb">
    <li class="breadcrumb-item"><a href="/almadmin">Admin</a><i class="fa fa-angle-right"></i>Contacts</li>
</ol>

<div class="validation-system">
    <div class="validation-form">
        <p id="topName" class="text-warning" align="center">Редактировать: <strong>Contacts</strong></p>
        <!---->
        <?php if ( $this->session->hasFlash('no_upd') ): ?>
            <div class="alert alert-danger alert-dismissible" role="alert">
                <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                <strong> <?=$this->session->getFlash('no_upd');?> </strong>
            </div>
        <?php endif; ?>
        <?php if ( $this->session->hasFlash('success_upd') ): ?>
            <div class="alert alert-success alert-dismissible" role="alert">
                <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                <strong> <?=$this->session->getFlash('success_upd');?> </strong>
            </div>
        <?php endif; ?>
        
        <?php $textForm = HtmlHelper::beginForm( HtmlHelper::URL('/almadmin/contacts/edit/1'), ['method'=>'POST'] ); ?>
            <div class="vali-form" id="vali_form">
                <?php for ($i = 0; $i < count($contacts); $i++): ?>
                <div class="col-md-6 form-group1">
                    <fieldset>
                    <legend>
                        <?php echo "Frame " . ($i+1) ?>
                        <?= $textForm->field($contactsForm)->input('button',['class'=>'btn btn-default','onclick'=>"removePosfromServ(this,{$contacts[$i]->id});",'value'=>'Delete',]) ?>
                    </legend>
                    <?= $textForm->field($contactsForm, 'name')->input('text',['required'=>'1','name'=>'contacts_en[name][]','value'=>html_entity_decode($contacts[$i]->name)])->label("",['class'=>"control-label"]) ?>
                    <?= $textForm->field($contactsForm, 'descr')->textarea(['rows'=>2,'name'=>'contacts_en[descr][]','placeholder'=>'Заполнить текстом здесь','value'=>html_entity_decode($contacts[$i]->descr),])->label("",['class'=>"control-label"])?>
                    <?= $textForm->field($contactsForm, 'id','webuy_en')->input('hidden',['name'=>'contacts_en[id][]','id'=>'webuy-id_'.$contacts[$i]->id,'value'=>$contacts[$i]->id,]) ?>
                    </fieldset>
                    <label class="control-label">Block Image</label>
                    <div class="col-md-12 form-group2 group-mail">
                        <select name="contacts_en[img][]">
                            <option <?php if( $contacts[$i]->img == "Addres" ) echo "selected"; ?> value="Addres">Addres</option>
                            <option <?php if( $contacts[$i]->img == "Email" ) echo "selected"; ?> value="Email">Email</option>
                            <option <?php if( $contacts[$i]->img == "Phone" ) echo "selected"; ?> value="Phone">Phone</option>
                        </select>
                    </div>
                </div>
                <?php endfor; ?>
            </div>
            <div class="clearfix"></div>
            <br/>
            <div class="col-md-12 form-group">
                <?= $textForm->field($contactsForm)->submitButton(['value'=>'Save','class'=>'btn btn-primary']) ?>
                <?= $textForm->field($contactsForm)->button(['value'=>'Add','id'=>'addContact','title'=>'Добавить','class'=>'btn btn-success']) ?>
            </div>
            <div class="clearfix"></div>
        <?php HtmlHelper::endForm(); ?>
        <!---->
    </div>
</div>

<div class="col-md-6 form-group1 hidden protorow">
    <fieldset>
        <legend>
            Новый Блок
            <input type="button" class="btn btn-default" onclick='removePos(this);' value="Удалить">
        </legend>
        <label for="" class="control-label">Название блока</label>
        <input name="" type="text" value="" placeholder="Имя блока">   
        <label for="" class="control-label">Текст в блоке</label>
        <textarea name="" id="" rows="2" placeholder="Заполнить текстом здесь"></textarea>
    </fieldset>
    <label class="control-label">Картинка для блока</label>
    <div class="col-md-12 form-group2 group-mail">
        <select name="contacts_en_new[img][]">
            <option selected value="Addres">Addres</option>
            <option  value="Email">Email</option>
            <option  value="Phone">Phone</option>
        </select>
    </div>
</div>


<script src="<?=_rootDIR_HTTP_?>/modules/almadmin/views/js/contacts.js?ver=<?=time()?>"></script>