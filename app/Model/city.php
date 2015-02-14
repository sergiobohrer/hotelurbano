<?php

class City extends AppModel
{
    public $name = "City";
    //public $useDbConfig = "Hoteis";

    public $useTable = "Cities";
    public $tableName = "Cities";
    public $primaryKey = "CityId";

    public $hasAndBelongsToMany = array (
        'Hotel' => array (
            'className' => 'Hotel',
            'joinTable' => 'HotelsCities',
            'foreignKey' => 'CityId',
            'associationForeignKey' => 'HotelId'
        )
    );
}