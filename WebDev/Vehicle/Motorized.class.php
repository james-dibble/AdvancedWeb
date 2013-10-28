<?php
class Motorized extends LandVehicle {
    private $engine;
    private $fuel;
    private $topSpeed;
    private $economy;
    private $power;
    private $torque;
    
    public function __construct($manufacturer, $country, $type, $model, $launchYear, $engine, $fuel, $topSpeed, $economy, $power, $torque){
        parent::__construct($manufacturer, $country, $type, $model, $launchYear);
        
        $this->engine = $engine;
        $this->fuel = $fuel;
        $this->topSpeed = $topSpeed;
        $this->economy = $economy;
        $this->power = $power;
        $this->torque = $torque;
    }

    protected function ValidateType($type) {
        return true;
    }
}
?>
