<?php

App::uses('Sanitize', 'Utility');

class MainController extends AppController
{
    public $uses = array( 'City' );

    public function index()
    {
    }

    private function search()
    {
    }

    public function searchHotels()
    {
        if ( isset( $this->request->data['q'] ) && isset( $this->request->data['checkin'] ) && isset( $this->request->data['checkout'] ) )
        {
            if ( ! empty( $this->request->data['q'] ) && ! empty( $this->request->data['checkin'] ) && ! empty( $this->request->data['checkout'] ) )
            {
                $city = $this->request->data['q'];
                $resultHotels = $this->City->find( 'all', array( 'conditions' => array( 'City.Name' => $city ) ) );
                $this->set( 'city', $city );
                $this->set( 'resultHotels', $resultHotels );
                return;
            }
        }
        $this->Session->setFlash( 'Todos os campos precisam ser preenchidos', 'default', array(), 'errorResultSearchHotel' );
        return $this->redirect( array( 'controller' => 'Main', 'action' => 'index' ) );
    }

    public function searchPackages()
    {
        if ( isset( $this->request->data['q'] ) && ! empty( $this->request->data['q'] ) )
        {
            $city = $this->request->data['q'];
            $resultHotels = $this->City->find( 'all', array( 'conditions' => array( 'City.Name' => $city ) ) );
            $this->set( 'city', $city );
            $this->set( 'resultHotels', $resultHotels );
            return;
        }
        $this->Session->setFlash( 'Todos os campos precisam ser preenchidos', 'default', array(), 'errorResultSearchHotel' );
        return $this->redirect( array( 'controller' => 'Main', 'action' => 'index' ) );
    }

    //$this->Hotels->find( "all" );
}
