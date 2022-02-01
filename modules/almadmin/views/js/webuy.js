
let addwebuy = document.getElementById('addWebuy');

addwebuy.addEventListener('click',function(){
    let vali_form = document.getElementById('vali_form');
    
    let newrow = document.querySelector('.protorow').cloneNode(true);
    newrow.classList.remove('hidden');
    newrow.classList.add('row');
    newrow.children[1].name = "webuy_en_new[name][]";
    
    vali_form.appendChild(newrow);
});

function removePos(self)
{
    self.parentElement.remove();
}

function removePosfromServ(self,id)
{
    let conf = confirm('Удалить позицию');
    if ( conf )
    {
        $.ajax({
            url: _ROOT_ + '/almadmin/webuy',
            data: {
                removeposId: id,
            },
            type: 'POST',
            dataType: 'json',
            success: function(res)
            {
                if ( res.ok ) self.parentElement.remove();
            },
            error: function()
            {
                alert('Ошибка! Попробуйте снова.');
            }
        });
    }
}

