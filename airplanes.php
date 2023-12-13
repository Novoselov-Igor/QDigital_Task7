<?php

//Абстрактный класс самолетов
abstract class Airplanes
{
    public $name;
    public $maxSpeed;
    protected $isFlying = false;

    public function __construct($name, $maxSpeed)
    {
        $this->name = $name;
        $this->maxSpeed = $maxSpeed;
    }

    public function takeOff(): string
    {
        $this->isFlying = true;
        return "{$this->name} взлетел";
    }

    public function land(): string
    {
        $this->isFlying = false;
        return "{$this->name} приземлился";
    }

    public function getStatus(): string
    {
        return $this->isFlying ? "В воздухе" : "На земле";
    }
}

// Класс для самолетов типа МИГ
class MigAirplane extends Airplanes
{
    public function attack(): string
    {
        return "{$this->name} выполняет атаку!\n";
    }
}

// Класс для самолетов типа ТУ-154
class Tu154Airplane extends Airplanes
{
}
