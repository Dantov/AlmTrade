let iter = 0;
document.getElementById('add_img').addEventListener('click',function (){

    let newImgrow = document.querySelector('.protorow').cloneNode(true);
    let uploadInput = newImgrow.children[0];

    uploadInput.click();

    uploadInput.onchange = function() { // запускаем по событию change
        preview(this.files[0]);
    };

    function preview(file) {
        //console.log('dsfg = ',file);
        //вставляем новые
        let reader = new FileReader();

        reader.addEventListener("load", function(event) {

            newImgrow.classList.remove('protorow');
            newImgrow.classList.remove('hidden');
            newImgrow.children[0].name = "images[]";

            let imgPrewiev = newImgrow.children[1].children[0];
            let srcPrew = event.target.result;
            imgPrewiev.setAttribute('src', srcPrew);

            // вставляем картинку только после всех изменений
            let add_bef_this = document.getElementById('add_bef_this');

            document.getElementById('picts').insertBefore(newImgrow, add_bef_this);
        });

        reader.readAsDataURL(file);
    }

} );

function dellImgPrew(self)
{
    let dell = confirm('Удалить картинку из этой позиции?');

    if ( dell ) self.parentElement.parentElement.remove();
}

function removeImgFromPos(self, id)
{
    let dell = confirm('Убрать картинку из этой позиции?');

    if ( dell )
    {
        $.ajax({
            url: _ROOT_ + '/almadmin/stock',
            data: {
                removeImgId: id,
            },
            type: 'POST',
            dataType: 'json',
            success: function(res)
            {
                if ( res.ok ) self.parentElement.parentElement.remove();
            },
            error: function()
            {
                alert('Ошибка! Попробуйте снова.');
            }
        });
    }

}

function dellPosition(id)
{
    let dell = confirm('Удалить позицию целиком?');
    
    if (!dell) return;
    
    location.href = _ROOT_ + '/almadmin/stock/remove/' + id;
}