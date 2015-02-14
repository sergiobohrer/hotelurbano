<?php

class AutocompleteController extends AppController
{
    public $uses = array( 'City' );

    public function city()
    {
        $this->autoRender = false;

        if ( isset( $this->request->data['city'] ) && ! empty( $this->request->data['city'] ) )
        {
            $city = $this->request->data['city'];
            $resultCities = $this->City->find( 'all', array( 'conditions' => array( 'City.Name LIKE' => "$city%" ) ) );
            if ( isset( $resultCities ) )
            {
                foreach ( $resultCities as $City )
                {
                    echo '<li name=\'city_option\'>' . $City['City']['Name'] . '</li>';
                }
            }
        }
    }
}