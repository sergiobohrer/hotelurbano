<?php

class Hotel extends AppModel
{
    public $name = "Hotels";
    //public $useDbConfig = "Hoteis";

    public $useTable = "Hotels";
    public $tableName = "Hotels";
    public $primaryKey = "HotelId";

    public $hasAndBelongsToMany = array(
        'City' => array(
            'className' => 'City',
            'joinTable' => 'HotelsCities',
            'foreignKey' => 'HotelId',
            'associationForeignKey' => 'CityId'
        )
    );
}