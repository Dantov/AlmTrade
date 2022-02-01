"use strict";

let gallery_grid = document.querySelector('.gallery-bott');
// элемент TD, внутри которого сейчас курсор
var currentElem = null;
gallery_grid.onmouseover = function(event) {
    if (currentElem) {
        // перед тем, как зайти в новый элемент, курсор всегда выходит из предыдущего
        //
        // если мы еще не вышли, значит это переход внутри элемента, отфильтруем его
        return;
    }
    // посмотрим, куда пришёл курсор
    var target = event.target;
    // уж не на TD ли?
    while (target != this) {
        if (target.classList.contains('hov111') ) break;
        target = target.parentNode;
    }
    if (target == this) return;
    currentElem = target;
    let soldPos = currentElem.querySelector('.soldPosition');
    if ( soldPos ) soldPos.style.display = "none";
};

gallery_grid.onmouseout = function(event) {
    // если курсор и так снаружи - игнорируем это событие
    if (!currentElem) return;

    // произошёл уход с элемента - проверим, куда, может быть на потомка?
    var relatedTarget = event.relatedTarget;
    if (relatedTarget) { // может быть relatedTarget = null
        while (relatedTarget) {
            // идём по цепочке родителей и проверяем,
            // если переход внутрь currentElem - игнорируем это событие
            if (relatedTarget == currentElem) return;
            relatedTarget = relatedTarget.parentNode;
        }
    }

    // произошло событие mouseout, курсор ушёл
    let soldPos = currentElem.querySelector('.soldPosition');
    if ( soldPos ) soldPos.style.display = "";
    currentElem = null;
};