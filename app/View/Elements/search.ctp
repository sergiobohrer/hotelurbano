<div class="page">
    <div class="container">
        <div class="row">
            <!-- Busca por Hotéis-->
            <div class="col-xs-6 homepanel">
                <?php
                    echo $this->Form->create('HotelSearch', array( 'id' => 'HotelSearch', 'type' => 'POST', 'url' => array( 'controller' => 'Main', 'action' => 'searchHotels') ) );
                ?>
                    <div class="row search-header search-header--hotel">
                        <div class="col-xs-3 search-header__title">Hotéis</div>
                        <div class="col-xs-9">
                            <div class="row row--principals-field">
                                <div class="col-xs-5">
                                    <div class="form-group">
                                      <div id="hoteis">
                                        <span class="twitter-typeahead" style="position: relative; display: inline-block; direction: ltr;">
                                            <input type="text" autocomplete="off" placeholder="Cidade" class="form-control typeahead tt-input" id="CidadeHotelDestino" name="q" spellcheck="false" style="background-color: #fff; position: relative; vertical-align: top;" dir="auto">
                                            <ul name="city_list"></ul>
                                            </span>
                                      </div>
                                    </div>
                                </div>
                                <div class="col-xs-7">
                                    <div class="row">
                                        <div class="col-xs-6">
                                            <div class="form-group">
                                              <input type="text" readonly="readonly" name="checkin" placeholder="Ida" class="form-control daterange" id="hotelDataIda">
                                            </div>
                                          </div>
                                          <div class="col-xs-6">
                                            <div class="form-group">
                                              <input type="text" readonly="readonly" name="checkout" placeholder="Volta" class="form-control daterange" id="hotelDataVolta">
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-xs-12 search-header-sender"><button id="btn-search-hotel" class="btn btn-orange" type="submit">Buscar</button></div>
                    </div>
                <?php echo $this->Form->end(); ?>
            </div>
            <!-- FIM - Busca por Hotéis-->

            <!-- Busca por Pacotes -->
            <div class="col-xs-6 homepanel homepanel--pacotes">
                <?php
                echo $this->Form->create('PackageSearch', array( 'id' => 'PackageSearch', 'type' => 'POST', 'url' => array( 'controller' => 'Main', 'action' => 'searchPackages') ) );
                ?>
                    <div class="row search-header search-header--pacote">
                        <div class="col-xs-3 search-header__title">Pacotes</div>
                        <div class="col-xs-9">
                            <div class="form-group">
                                <div id="pacotes">
                                    <span class="twitter-typeahead" style="position: relative; display: inline-block; direction: ltr;">
                                        <input type="text" autocomplete="off" placeholder="Cidade" class="form-control typeahead tt-input" id="CidadePacoteDestino" name="q" spellcheck="false" style="position: relative; vertical-align: top; background-color: #fff;">
                                        <ul name="city_list"></ul>
                                    </span>
                                </div>
                            </div>
                        </div>
                        <div class="col-xs-12 search-header-sender"><button id="btn-search-pacote" class="btn btn-orange" type="submit">Buscar</button></div>
                    </div>
                <?php echo $this->Form->end(); ?>
            </div>
            <!-- Fim Busca por Pacotes-->
        </div>
        <?php
        if ( $this->Session->check( 'Message.errorResultSearchHotel' ) || $this->Session->check( 'Message.errorResultSearchPackage' ) )
        {
        ?>
            <div>
                <div style="width: 50%">
                    <?php echo $this->Session->flash( 'errorResultSearchHotel' ); ?>
                </div>
                <div style="width: 50%">
                    <?php echo $this->Session->flash( 'errorResultSearchPackage' ); ?>
                </div>
            </div>
        <?php
        }
        ?>
    </div>
</div>
<?php
    echo $this->Html->css('jquery-ui.min.css');
    echo $this->Html->script(array('jquery-2.1.3.min', 'jquery-ui', 'jquery.validate.min'));
?>
<script>
$(function() {
    var today = new Date();
    var dates = $( "#hotelDataIda, #hotelDataVolta").datepicker({
        minDate: "0",
        maxDate: "+2Y",
        defaultDate: "+1w",
        dateFormat: 'dd/mm/yy',
        numberOfMonths: 1,
        dayNamesMin: ['D','S','T','Q','Q','S','S','D'],
        dayNamesShort: ['Dom','Seg','Ter','Qua','Qui','Sex','Sáb','Dom'],
        monthNames: ['Janeiro','Fevereiro','Março','Abril','Maio','Junho','Julho','Agosto','Setembro','Outubro','Novembro','Dezembro'],
        monthNamesShort: ['Jan','Fev','Mar','Abr','Mai','Jun','Jul','Ago','Set','Out','Nov','Dez'],
        nextText: 'Próximo',
        prevText: 'Anterior',
        onSelect: function(date) {
            for( var i = 0; i < dates.length; ++i) {
                if(dates[i].id < this.id)
                    $(dates[i]).datepicker('option', 'maxDate', date);
                else if(dates[i].id > this.id)
                    $(dates[i]).datepicker('option', 'minDate', date);
            }
        }
    });

    $( "#CidadeHotelDestino, #CidadePacoteDestino" ).keyup( function() {
        var word = $(this).val();
        var parent = $(this).parent( "span" );
        if ( word.length >= 3 ) {
            $.ajax({
                url: "<?php echo $this->Html->url( array( 'controller' => 'Autocomplete', 'action' => 'city' ) ); ?>",
                type: 'POST',
                data: {city: word},
                success:function( data ) {
                    if ( data != '' ) {
                        parent.find( "ul" ).show();
                        parent.find( "ul" ).html(data);
                    } else {
                        $('ul[name=city_list]').hide();
                    }
                }
            });
        } else {
            $( 'ul[name=city_list]' ).hide();
        }
    });

    $( document ).on( 'click', 'li[name=city_option]', function() {
        var parent = $( this ).parent().parent();
        parent.find( "input" ).val( this.innerHTML );
        $('ul[name=city_list]').hide();
    });

    $('#HotelSearch').validate({
        rules: {
            q: { required: true, minlength: 3 },
            checkin: { required: true },
            checkout: { required: true }
        },
        messages: {
            q: { required: 'A Cidade precisa ser preenchida', minlength: 'No mínimo 3 letras' },
            checkin: { required: 'Informe a data de Ida' },
            checkout: { required: 'Informe a data de Volta' }
        },
    });
});
</script>