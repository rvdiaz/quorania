const SelectFilter=(event)=>{
    event.target.classList.toggle('select');
    doFilters();
}
if(document.getElementById('surface-range-data')){
document.getElementById('surface-range-data').addEventListener('input',(event)=>{
    jQuery('#surface-range-data-out').html(event.target.value);
    jQuery('#surface-range-data-out').css('display','block');
    doFilters();
})
}
if(document.getElementById('price-range-data')){
document.getElementById('price-range-data').addEventListener('input',(event)=>{
    jQuery('#price-range-data-out').html(event.target.value);
    jQuery('#price-range-data-out').css('display','block');
    doFilters();
})
}
if(document.getElementById('surface-range-data')){
document.getElementById('surface-range-data').addEventListener('mouseup',(event)=>{
    jQuery('#surface-range-data-out').css('display','none');
})
}
if(document.getElementById('price-range-data')){
document.getElementById('price-range-data').addEventListener('mouseup',(event)=>{
    jQuery('#price-range-data-out').css('display','none');
})
}

jQuery('.restore-filters-button-pisos').click(()=>{
    jQuery('.pisos--filters--container--items--item--content-buildings .select').removeClass('select');
    jQuery('.pisos--filters--container--items--item--content-bedrooms .select').removeClass('select');
    jQuery('#surface-range-data').val(jQuery('#surface-range-data').attr('min'));
    jQuery('#price-range-data').val(jQuery('#price-range-data').attr('min'));
    doFilters();
})

jQuery('body').delegate('.prev-button','click',()=>{
    if(jQuery('.floor-pagination-wrapper .active').html()!=1){
        let $aux=jQuery('.floor-pagination-wrapper .active');
        $aux[0].classList.toggle('active');
        jQuery(`.pagination-button-${parseInt($aux.html())-1}`).click();
        updatePaginationButtons();
    }
});

jQuery('body').delegate('.next-button','click',()=>{
    if(jQuery('.floor-pagination-wrapper .active').html()!=jQuery('.floor-pagination-wrapper .pagination-button').size()){
        let $aux=jQuery('.floor-pagination-wrapper .active');
        $aux[0].classList.toggle('active');
        jQuery(`.pagination-button-${parseInt($aux.html())+1}`).click();
        updatePaginationButtons();
    }
})

const updatePaginationButtons=()=>{
    if(jQuery('.floor-pagination-wrapper .active').html()==1){
        jQuery('.prev-button').prop('disabled',true);
    } else 
    jQuery('.prev-button').prop('disabled',false);
    if(jQuery('.floor-pagination-wrapper .active').html()==jQuery('.floor-pagination-wrapper .pagination-button').size()){
        jQuery('.next-button').prop('disabled',true);
    } else 
    jQuery('.next-button').prop('disabled',false);
}

const doPagination=()=>{
    let buttonsPagination='';
    let rowsPagination='';
    if(jQuery('.pagination-button').length!=0){
    buttonsPagination=jQuery('.pagination-button');
    buttonsPagination[0].classList.toggle('active');
    }       
    if(jQuery('.floor-pagination').length!=0){
    rowsPagination=jQuery('.floor-pagination');
    jQuery(`.floor-pagination-1`).addClass('pagination-active');
    }  
    if(jQuery('.floor-pagination').length!=0 && jQuery('.pagination-button').length!=0) {
    for(let i=1;i<=buttonsPagination.length;i++)
        jQuery(`.pagination-button-${i}`).click(()=>{
            const btn=jQuery(`.pagination-button-${i}`);
            const paginationView=jQuery(`.floor-pagination-${i}`);
            if(!btn.hasClass('active')){
                jQuery('.pagination-button').removeClass('active');
                rowsPagination.removeClass('pagination-active');
                btn.toggleClass('active');
                paginationView.toggleClass('pagination-active');
            }
            updatePaginationButtons();
        })
    }
}

jQuery('document').ready(()=>{
    doPagination();
    updatePaginationButtons();
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
            doPagination();
            updatePaginationButtons();
        }								        
      });
}