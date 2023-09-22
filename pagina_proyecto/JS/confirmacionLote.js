function confirmacion(event){
    if (confirm("¿Esta seguro que decea eliminar este lote?")){
        return true;
    }else{
        event.preventDefault();
    }
}

let linkDelete = document.querySelectorAll(".item_delete");

for (var i = 0 ; i < linkDelete.length; i++){
    linkDelete[i].addEventListener('click', confirmacion);
}