<div class="page">
    <div id="rb-resultado">
        <p class="rb-resultado-texto">Resultado de busca encontrado para</p>
        <h1 class="rb-resultado-cidade"><?php echo $city; ?></h1>
        <div id="rb-qtdade-opcoes" class="rb-qtd-options">
            <p class="font24"><?php echo $hotelCount; ?></p>
            <p class="upper font9"><?php echo ( $hotelCount > 1 ? 'opções' : 'opção' ); ?></p>
        </div>
    </div>
</div>