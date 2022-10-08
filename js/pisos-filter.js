const SelectFilter=(event)=>{
    event.target.classList.toggle('select');
    doFilters();
}

document.getElementById('surface-range-data').addEventListener('input',(event)=>{
    jQuery('#surface-range-data-out').html(event.target.value);
    jQuery('#surface-range-data-out').css('display','block');
    doFilters();
})

document.getElementById('price-range-data').addEventListener('input',(event)=>{
    jQuery('#price-range-data-out').html(event.target.value);
    jQuery('#price-range-data-out').css('display','block');
    doFilters();
})

document.getElementById('surface-range-data').addEventListener('mouseup',(event)=>{
    jQuery('#surface-range-data-out').css('display','none');
})
document.getElementById('price-range-data').addEventListener('mouseup',(event)=>{
    jQuery('#price-range-data-out').css('display','none');
})

jQuery('.restore-filters-button').click(()=>{
    jQuery('.pisos--filters--container--items--item--content-buildings .select').removeClass('select');
    jQuery('.pisos--filters--container--items--item--content-bedrooms .select').removeClass('select');
    jQuery('#surface-range-data').val(jQuery('#surface-range-data').attr('min'));
    jQuery('#price-range-data').val(jQuery('#price-range-data').attr('min'));
    doFilters();
})


const doFilters=()=>{
    let  buildingsSelected=[];
    const buildings=jQuery('.pisos--filters--container--items--item--content-buildings .select');
    for(let i=0;i<buildings.length;i++){
        buildingsSelected[i]=buildings[i].getAttribute('data-building');
    }
    let  bedroomsSelected=[];
    const bedrooms=jQuery('.pisos--filters--container--items--item--content-bedrooms .select');
    for(let i=0;i<bedrooms.length;i++){
        bedroomsSelected[i]=bedrooms[i].getAttribute('data-bedroom');
    }
    const price=jQuery('#price-range-data').val();
    const minPrice=jQuery('#price-range-data').attr('min');
    const surface=jQuery('#surface-range-data').val();
    const minSurface=jQuery('#surface-range-data').attr('min');
    console.log(price);
    console.log(minPrice);
    jQuery.ajax({
                  type : "post",
                   url : ajax.url,
                    data : { action: 'quorania_filter', dataSend : {
                    buildings:buildingsSelected,
                    bedrooms:bedroomsSelected,
                    price:price,
                    surface:surface,
                    minPrice:minPrice,
                    minSurface:minSurface
                  } },
                  success: function(response){								  
                    jQuery('.pisos--list--container--body').html(response);
                  }								        
      });
}