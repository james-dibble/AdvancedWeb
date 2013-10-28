<?php
abstract class LandVehicle {
    private $manufacturer;
    private $country;
    private $type;
    private $model;
    private $launchYear;
    
    protected function __construct($manufacturer, $country, $type, $model, $launchYear){
        $this->manufacturer = $manufacturer;
        $this->country = $country;
        $this->model = $model;
        $this->launchYear = $launchYear;
        $this->SetType($type);
    }
    
    protected abstract function ValidateType($type);
    
    protected function SetType($type){
        if($this->ValidateType($type)){
            $this->type = $type;
        }
    }
    
    public function __get($property){
        return $this-$property;
    }
    
    public function __set($property, $value){
        $this->$property = $value;
    }
}
?>
