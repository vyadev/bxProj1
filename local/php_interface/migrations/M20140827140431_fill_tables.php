<?php

namespace Sprint\Migration;


use Bitrix\Main\Type\Date;
use Vyadev\Mod\Orm\CarTable;
use Vyadev\Mod\Orm\ColorTable;

class M20140827140431_fill_tables extends Version
{
  protected $author = "admin";

  protected $description = "";

  protected $moduleVersion = "4.12.6";

  protected function getIdByCode($class, $code)
  {
    $item = $class::query()
      ->setFilter(['CODE' => $code])
      ->setSelect(['ID', 'CODE'])
      ->fetch();
    return $item['ID'];
  }

  protected function clearTables($className)
  {
    $items = $className::query()
      ->fetchCollection();
    foreach ($items as $item) {
      $item->delete();
    }
  }

  public function up()
  {
    $colorsData = [
      [
        'NAME' => 'Белый',
        'CODE' => 'white',
      ],
      [
        'NAME' => 'Чёрный',
        'CODE' => 'black',
      ],
      [
        'NAME' => 'Серый',
        'CODE' => 'grey',
      ],
      [
        'NAME' => 'Красный',
        'CODE' => 'red',
      ],
    ];

    foreach ($colorsData as $colorData) {
      $saveResult = ColorTable::add($colorData);

      if (!$saveResult->isSuccess()) {
        throw new \Exception(implode(', ', $saveResult->getErrorMessages()));
      }
    }

    $carsData = [
      [
        'BRAND'         => 'Kia',
        'MODEL'         => 'Rio',
        'DATE'          => new Date('03.04.2015'),
        'CAPACITY'      => '400',
        'COLOR_ID'      => $this->getIdByCode(ColorTable::class, 'red'),
        'IS_COMMERCIAL' => 'Y',
      ],
      [
        'BRAND'         => 'Kia',
        'MODEL'         => 'Sorento',
        'DATE'          => new Date('06.09.2005'),
        'CAPACITY'      => '500',
        'COLOR_ID'      => $this->getIdByCode(ColorTable::class, 'white'),
        'IS_COMMERCIAL' => 'Y',
      ],
      [
        'BRAND'         => 'Hyundai',
        'MODEL'         => 'Solaris',
        'DATE'          => new Date('03.03.2023'),
        'CAPACITY'      => '450',
        'COLOR_ID'      => $this->getIdByCode(ColorTable::class, 'black'),
        'IS_COMMERCIAL' => 'Y',
      ],
      [
        'BRAND'         => 'Hyundai',
        'MODEL'         => 'Sonata',
        'DATE'          => new Date('12.12.2021'),
        'CAPACITY'      => '500',
        'COLOR_ID'      => $this->getIdByCode(ColorTable::class, 'red'),
        'IS_COMMERCIAL' => 'Y',
      ],
      [
        'BRAND'         => 'Ford',
        'MODEL'         => 'Focus',
        'DATE'          => new Date('16.08.1999'),
        'CAPACITY'      => '450',
        'COLOR_ID'      => $this->getIdByCode(ColorTable::class, 'white'),
        'IS_COMMERCIAL' => 'Y',
      ],
      [
        'BRAND'         => 'Ford',
        'MODEL'         => 'Transit',
        'DATE'          => new Date('30.01.1980'),
        'CAPACITY'      => '2000',
        'COLOR_ID'      => $this->getIdByCode(ColorTable::class, 'white'),
        'IS_COMMERCIAL' => 'N',
      ],
      [
        'BRAND'         => 'Toyota',
        'MODEL'         => 'Corolla',
        'DATE'          => new Date('07.09.2021'),
        'CAPACITY'      => '400',
        'COLOR_ID'      => $this->getIdByCode(ColorTable::class, 'red'),
        'IS_COMMERCIAL' => 'Y',
      ],
      [
        'BRAND'         => 'Toyota',
        'MODEL'         => 'Camry',
        'DATE'          => new Date('25.03.2023'),
        'CAPACITY'      => '500',
        'COLOR_ID'      => $this->getIdByCode(ColorTable::class, 'black'),
        'IS_COMMERCIAL' => 'Y',
      ],
      [
        'BRAND'         => 'Opel',
        'MODEL'         => 'Combo',
        'DATE'          => new Date('10.06.2020'),
        'CAPACITY'      => '700',
        'COLOR_ID'      => $this->getIdByCode(ColorTable::class, 'white'),
        'IS_COMMERCIAL' => 'N',
      ],
      [
        'BRAND'         => 'Peugeot',
        'MODEL'         => 'Boxer',
        'DATE'          => new Date('05.03.2000'),
        'CAPACITY'      => '1000',
        'COLOR_ID'      => $this->getIdByCode(ColorTable::class, 'black'),
        'IS_COMMERCIAL' => 'N',
      ],
    ];

    foreach ($carsData as $carData) {
      $saveResult = CarTable::add($carData);
      if (!$saveResult->isSuccess()) {
        throw new \Exception(implode(', ', $saveResult->getErrorMessages()));
      }
    }
  }

  public function down()
  {
    $this->clearTables(ColorTable::class);
    $this->clearTables(CarTable::class);
  }
}
