const SelectFilterParking=(event)=>{
    event.target.classList.toggle('select');
    doFiltersParking();
}


if(document.getElementById('price-range-data-parking')){
document.getElementById('price-range-data-parking').addEventListener('input',(event)=>{
    jQuery('#price-range-data-parking-out').html(event.target.value);
    jQuery('#price-range-data-parking-out').css('display','block');
    doFiltersParking();
})
}
if(document.getElementById('price-range-data-parking')){
document.getElementById('price-range-data-parking').addEventListener('mouseup',(event)=>{
    jQuery('#price-range-data-parking-out').css('display','none');
})
}

jQuery('.restore-filters-button-parking').click(()=>{
    jQuery('.pisos--filters--container--items--item--content--parking-buildings .select').removeClass('select');
    jQuery('#price-range-data-parking').val(jQuery('#price-range-data-parking').attr('min'));
    doFiltersParking();
})

const doFiltersParking=()=>{
    let  buildingsSelected=[];
    const buildings=jQuery('.pisos--filters--container--items--item--content--parking-buildings .select');
    for(let i=0;i<buildings.length;i++){
        buildingsSelected[i]=buildings[i].getAttribute('data-building');
    }
    const price=jQuery('#price-range-data-parking').val();
    const minPrice=jQuery('#price-range-data-parking').attr('min');
    let tipo=[];
    if(jQuery('#parqueo-check').is(':checked'))
        tipo[0]='parqueo';
    if(jQuery('#trastero-check').is(':checked') && jQuery('#parqueo-check').is(':checked')) 
        tipo[1]='trastero';
    if(jQuery('#trastero-check').is(':checked') && !jQuery('#parqueo-check').is(':checked')) 
        tipo[0]='trastero';

    jQuery.ajax({
        type : "post",
        url : ajax.url,
        data : { action: 'quorania_filter_parking', dataSend : {
        buildings:buildingsSelected,
        tipo:tipo,
        price:price,
        minPrice:minPrice,
            } },
            success: function(response){								  
            jQuery('.pisos--list--container--body--parking').html(response);
            doPagination();
            updatePaginationButtons();
        }								        
      });
}