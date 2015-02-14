<?php
echo $this->element( 'search' );

if ( isset( $resultHotels ) )
{
    if ( ! empty( $resultHotels ) )
    {
        $hotelCount = count( $resultHotels[0]['Hotel'] );
        echo $this->element( 'resultSearch', array( 'city' => $city, 'hotelCount' => $hotelCount ) );
        echo $this->element( 'showHotels', array( 'resultHotels' => $resultHotels ) );
    }
    else
    {
        echo 'Nenhum hotel encontrado em', $city;
    }
}