<?php

// Класс аэропорта
class Airport
{
    private $parkingSpaces = [];
    private $takeOffPermission = [];
    private $landingPermission = [];

    public function acceptAirplane(Airplanes $airplane)
    {
        $this->parkingSpaces[] = $airplane;

        $index = array_search($airplane, $this->landingPermission);

        if ($index !== false) {
            unset($this->landingPermission[$index]);

            return "{$airplane->name} прибыл на аэропорт";
        } else {
            return "{$airplane->name} не имеет разрешения на посадку";
        }
    }

    public function releaseAirplane(Airplanes $airplane)
    {
        $indexParking = array_search($airplane, $this->parkingSpaces);
        if ($indexParking !== false) {

            $indexTakeOff = array_search($airplane, $this->takeOffPermission);

            if ($indexTakeOff !== false) {
                unset($this->parkingSpaces[$indexParking]);

                unset($this->takeOffPermission[$indexTakeOff]);

                return "{$airplane->name} освободил место и улетел";
            } else {
                return "{$airplane->name} не имеет разрешения на посадку";
            }
        } else {
            return "{$airplane->name} не найден на аэропорте";
        }
    }

    public function parkAirplane(Airplanes $airplane)
    {
        return "{$airplane->name} ушел на стоянку";
    }

    public function prepareForTakeOff(Airplanes $airplane)
    {
        return "{$airplane->name} готов взлетать";
    }

    public function giveLandingPermission(Airplanes $airplane)
    {
        $this->landingPermission = $airplane;
    }

    public function giveTakeOffPermission(Airplanes $airplane)
    {
        $this->takeOffPermission = $airplane;
    }
}