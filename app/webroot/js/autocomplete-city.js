function autocomplete() {
    var word = $('#country_id').val();
    if ( word.length >= 3 ) {
        $.ajax({
            url: '/autocomplete/city.php',
            type: 'POST',
            data: {city: word},
            success:function( data ) {
                if ( data != "" ) {
                    $('#city_list_id').show();
                    $('#city_list_id').html(data);
                }
                else
                {
                    $('#city_list_id').hide();
                }
            }
        });
    } else {
        $( '#city_list_id' ).hide();
    }
}

function set_item(item) {
    // change input value
    $('#city').val( item );
    // hide proposition list
    $('#city_list_id').hide();
}