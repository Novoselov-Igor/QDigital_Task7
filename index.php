<?php

require_once 'Airplanes.php';
require_once 'Airport.php';

function show($data): void
{
    echo "<p>" . $data . "<p>";
}

$mig = new MigAirplane('МИГ-29', 2400);
$tu154 = new Tu154Airplane('ТУ-154', 950);

$airport = new Airport();

// Композицей будут методы покупки самолетов поскольку там создаются новые обьекты класса самолета
// Агрегация: аэропорт имеет самолеты на парковке (но они могут быть удалены)
// Ассоциация: когда аэропорт "подготавливает к взлету" или "даёт разрешение на посадку" - объекты знают друг о друге и взаимодействуют

// Даем разрешение на посадку самолету МИГ-29
$airport->giveLandingPermission($mig);
show($airport->acceptAirplane($mig));

// Добавим самолет на стоянку
show($airport->parkAirplane($mig));

// Даем разрешение на взлет самолету МИГ-29
$airport->giveTakeOffPermission($mig);

// Подготовка самолета к взлету
show($airport->prepareForTakeOff($mig));

// Самолет взлетает
show($mig->takeOff());

// Освобождаем место на парковке аэропорта для МИГ-29
show($airport->releaseAirplane($mig));

// Проверим статус
show($mig->getStatus());

//Атакуем
show($mig->attack());

// Даем разрешение на посадку самолету ТУ-154
$airport->giveLandingPermission($tu154);
show($airport->acceptAirplane($tu154));

// Добавим самолет на стоянку
show($airport->parkAirplane($tu154));

// Даем разрешение на взлет самолету ТУ-154
$airport->giveTakeOffPermission($tu154);

// Подготовка самолета к взлету
show($airport->prepareForTakeOff($tu154));

// Самолет взлетает
show($tu154->takeOff());

// Освобождаем место на парковке аэропорта для ТУ-154
show($airport->releaseAirplane($tu154));

// Отправляем на свалку приземлившийся самолет
$airport->giveLandingPermission($tu154);
show($airport->acceptAirplane($tu154));
show($airport->sendToScrapyard($tu154));