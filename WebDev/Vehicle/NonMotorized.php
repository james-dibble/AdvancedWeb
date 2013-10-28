<?php
class NonMotorized extends LandVehicle {
    public function __construct($manufacturer, $country, $type, $model, $launchYear){
        parent::__construct($manufacturer, $country, $type, $model, $launchYear);
    }

    protected function ValidateType($type) {
        return true;
    }
}
?>
