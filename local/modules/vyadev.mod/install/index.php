<?php

use Bitrix\Main\Localization\Loc;
use Vyadev\Mod\Orm\CarTable;
use Vyadev\Mod\Orm\ColorTable;

Loc::loadMessages(__FILE__);
class vyadev_mod extends CModule
{
  public $MODULE_ID = 'vyadev.mod';

  public function __construct()
  {
    $this->MODULE_NAME = Loc::getMessage('VYADEV_MOD_MODULE_NAME');
    $this->MODULE_DESCRIPTION = Loc::getMessage('VYADEV_MOD_MODULE_DESCRIPTION');
    $this->PARTNER_NAME = Loc::getMessage('VYADEV_MOD_PARTNER_NAME');
    $this->PARTNER_URI = Loc::getMessage('VYADEV_MOD_PARTNER_URI');

    include(dirname(__FILE__) . "/version.php");
    $arModuleVersion = [];
    $this->MODULE_VERSION = $arModuleVersion["VERSION"];
    $this->MODULE_VERSION_DATE = $arModuleVersion["VERSION_DATE"];
  }

  public function DoInstall()
  {
    try {
      $this->InstallFiles();
//      $this->InstallDB();
      $this->InstallEvents();

      RegisterModule($this->MODULE_ID);
    } catch (Exception $e) {
      echo $e->getMessage();
    }
  }

  public function InstallFiles()
  {
    CopyDirFiles(__DIR__ . '/bitrix/components/', getenv("DOCUMENT_ROOT") . '/bitrix/components/', true, true);
  }

  public function InstallEvents()
  {
    $evenManager = Bitrix\Main\EventManager::getInstance();
    $evenManager->registerEventHandler('main', 'OnBeforeProlog', $this->MODULE_ID);
  }

  public function InstallDB()
  {
    $connection = \Bitrix\Main\Application::getConnection();
    if (!$connection->isTableExists(ColorTable::getTableName())) {
      ColorTable::getEntity()->createDbTable();
    }
    if (!$connection->isTableExists(CarTable::getTableName())) {
      CarTable::getEntity()->createDbTable();
    }
  }

  public function DoUninstall()
  {
    $this->UnInstallFiles();
//    $this->UnInstallDB();
    $this->UnInstallEvents();

    UnRegisterModule($this->MODULE_ID);
  }

  public function UnInstallFiles()
  {
    DeleteDirFilesEx('/bitrix/components/vyadev');
  }

  public function UnInstallDB()
  {
    $connection = \Bitrix\Main\Application::getConnection();
    if ($connection->isTableExists(ColorTable::getTableName())) {
      $connection->dropTable(ColorTable::getTableName());
    }
    if ($connection->isTableExists(CarTable::getTableName())) {
      $connection->dropTable(CarTable::getTableName());
    }
  }

  public function UnInstallEvents()
  {
    $evenManager = Bitrix\Main\EventManager::getInstance();
    $evenManager->unRegisterEventHandler('main', 'OnBeforeProlog', $this->MODULE_ID);
  }
}