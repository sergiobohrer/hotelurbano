<div class="page">
    <?php
    foreach ( $resultHotels[0]['Hotel'] as $hotel )
    {
    ?>
    <div class="rb-hoteis-info">
        <div class="row">
            <div class="rb-hoteis-info-nome">
                <h2><?php echo $hotel['Name']; ?></h2>
                <div class="rb-hoteis-info-reserva">
                    <span class="oferta-nhu-icon-relogio"></span> 
                    <span>RESERVA IMEDIATA PARA ESTE HOTEL<br>NÃO PERCA TEMPO!</span>
                </div>
            </div>
            <div class="rb-hoteis-info-preco">
                <p>DIÁRIAS A PARTIR DE</p>
                <p class="preco">R$ <?php echo number_format( $hotel['HotelsCity']['DailyPrice'], 2, ',', ''); ?></p>
                <p>EM ATÉ 3X SEM JUROS</p>
            </div>
        </div>
    </div>
    <?php
    }
    ?>
</div>