<?php

namespace Sprint\Migration;

class M20140827100630_create_agent extends Version
{
  protected $author = "admin";

  protected $description = "";

  protected $moduleVersion = "4.12.6";

  public function up()
  {
    $helper = $this->getHelperManager();
    $helper->Agent()->saveAgent(array(
      'MODULE_ID'      => 'vyadev.mod',
      'USER_ID'        => null,
      'SORT'           => '0',
      'NAME'           => 'Vyadev\Mod\ClearElementsAgent::clearNotActualElements();',
      'ACTIVE'         => 'Y',
      'NEXT_EXEC'      => '14.09.2024 14:41:00',
      'AGENT_INTERVAL' => '86400',
      'IS_PERIOD'      => 'Y',
      'RETRY_COUNT'    => '0',
    ));
  }

  public function down()
  {
    $helper = $this->getHelperManager();
    $helper->Agent()->deleteAgentIfExists('vyadev.mod', 'Vyadev\Mod\ClearElementsAgent::clearNotActualElements();');
  }
}
