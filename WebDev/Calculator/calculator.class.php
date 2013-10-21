<?php
class Calculator {
    private $functions = ['+', '-', 'x', '/'];
    private $x;
    private $y;
    private $operation;

    public function __construct($x, $y, $operation) {
        $this->GuardNumberInput($x);
        $this->x = $x;
        $this->GuardNumberInput($y);
        $this->y = $y;
        $this->GaurdOperator($operation);
        $this->operation = $operation;
    }

    public function Calculate() {
        switch (strtolower($this->operation)) {
            case '+':
                return $this->Add();
            case '-':
                return $this->Subtract();
            case 'x':
                return $this->Multiply();
            case '/':
                return $this->Divide();
            default:
                throw new InvalidArgumentException('Undefined operator used.');
        }
    }

    private function Add() {
        return $this->x + $this->y;
    }

    private function Subtract() {
        return $this->x - $this->y;
    }

    private function Multiply() {
        return $this->x * $this->y;
    }

    private function Divide() {
        if ($this->y == 0) {
            return 0;
        }

        return $this->x / $this->y;
    }

    private function GuardNumberInput($input) {
        try {
            (int) $input;
        } catch (Exception $ex) {
            throw $ex;
        }
    }
    
    private function GaurdOperator($input){
        if(!in_array($input, $this->functions)){
            throw new InvalidArgumentException('Undefined operator used.');
        }
    }
}

?>
