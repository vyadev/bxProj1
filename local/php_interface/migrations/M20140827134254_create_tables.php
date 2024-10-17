<?php

namespace Sprint\Migration;

use Vyadev\Mod\Orm\CarTable;
use Vyadev\Mod\Orm\ColorTable;

class M20140827134254_create_tables extends Version
{
  protected $author = "admin";

  protected $description = "";

  protected $moduleVersion = "4.12.6";

  public function up()
  {
    $connection = \Bitrix\Main\Application::getConnection();
    if (!$connection->isTableExists(ColorTable::getTableName())) {
      ColorTable::getEntity()->createDbTable();
    }
    if (!$connection->isTableExists(CarTable::getTableName())) {
      CarTable::getEntity()->createDbTable();
    }
  }

  public function down()
  {
    $connection = \Bitrix\Main\Application::getConnection();
    if ($connection->isTableExists(ColorTable::getTableName())) {
      $connection->dropTable(ColorTable::getTableName());
    }
    if ($connection->isTableExists(CarTable::getTableName())) {
      $connection->dropTable(CarTable::getTableName());
    }
  }
}
