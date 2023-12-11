<?php

// Класс аэропорта
class Airport
{
    private $parkingSpaces = [];
    private $takeOffPermission = [];
    private $landingPermission = [];

    public function acceptAirplane(Airplanes $airplane)
    {
        $index = array_search($airplane, $this->landingPermission);
        $permission = array_search($airplane, $this->landingPermission);

        if ($index !== false && $permission !== false) {
            $this->parkingSpaces[] = $airplane;

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
                return "{$airplane->name} не имеет разрешения на взлет";
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
        $this->landingPermission[] = $airplane;
    }

    public function giveTakeOffPermission(Airplanes $airplane)
    {
        $this->takeOffPermission[] = $airplane;
    }

    public function sendToScrapyard(Airplanes $airplane)
    {
        $indexParking = array_search($airplane, $this->parkingSpaces);
        if ($indexParking !== false) {
            unset($this->parkingSpaces[$indexParking]);

            $indexTakeOff = array_search($airplane, $this->takeOffPermission);
            if ($indexTakeOff !== false) {
                unset($this->takeOffPermission[$indexTakeOff]);
            }

            $indexLanding = array_search($airplane, $this->landingPermission);
            if ($indexLanding !== false) {
                unset($this->landingPermission[$indexLanding]);
            }

            return "{$airplane->name} отправлен на утилизацию";
        } else {
            return "{$airplane->name} не найден на аэропорте для отправки на утилизацию.";
        }
    }

    public function buyNewMigAiplane($name, $maxSpeed)
    {
        $this->parkingSpaces[] = new MigAirplane($name, $maxSpeed);
    }
    public function buyNewTu154Aiplane($name, $maxSpeed)
    {
        $this->parkingSpaces[] = new Tu154Airplane($name, $maxSpeed);
    }
}