<?php
namespace MenuManager\Test\TestCase;

use Cake\TestSuite\IntegrationTestCase;
use MenuManager\Plugin;
use Cake\Core\Configure;


/**
 * Description of PluginTest
 *
 * @author tchol
 */
class PluginTest extends IntegrationTestCase
{
    /**
     * Test if required method is present in class.
     * 
     * @param none
     * @return void
     */
    public function testPluginClassHasSetTranslationsMethod()
    {
        $this->assertTrue(method_exists(Plugin::class, 'setTranslations'), __('The method setTranslations() is missing.'));
    }
    
    /**
     * Test if Configuration variable exists and contains Languages definition
     * after Plugin's method setTranslations() is executed.
     * But first check that variable is null.
     * 
     * @param none
     * @return void
     */
    public function testSetTranslationsMethodIsWriteToConfig()
    {
        $data = [
            'bg_BG' => 'Bulgarian',
            'it_IT' => 'Italian'
        ];
        // Ensure that cinfiguration variable is empty.
        $this->assertNull(Configure::read('MenuManager.Translation.Languages'));
        
        $plugin = new Plugin(['routes' => TRUE, 'bootstrap' => FALSE]);
        $plugin->setTranslations($data);
        
        $this->assertTrue(Configure::check('MenuManager.Translation.Languages'), __('Configuration variable does not exist after method execution.'));
        
        $languages = Configure::read('MenuManager.Translation.Languages');
        
        $this->assertCount(2, $languages, __('Wrong number of languages after method execution.'));
        $this->assertArrayHasKey('bg_BG', $languages);
        $this->assertArrayHasKey('it_IT', $languages);
    }
}
