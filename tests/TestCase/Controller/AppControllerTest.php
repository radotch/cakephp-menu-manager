<?php
namespace MenuManager\Test\TestCase\Controller;

use Cake\TestSuite\IntegrationTestCase;
use MenuManager\Controller\AppController;
use Cake\Core\Configure;

/**
 * MenuManager\Controller\AppController Test Case
 */
class AppControllerTest extends IntegrationTestCase
{
    /**
     * Fixtures
     *
     * @var array
     */
    public $fixtures = [
//        'plugin.menu_manager.app'
    ];

    /**
     * Test initial setup
     *
     * @return void
     */
    public function testInitialization()
    {
        $this->markTestIncomplete('Not implemented yet.');
    }
    
    /**
     * 
     */
    public function testMenuManagerTranslationConfigurationIsDefined()
    {
        $this->get('/admin/menu-manager');
        
        $this->assertTrue(Configure::check('MenuManager.Translation.Languages'), __('Configuration MenuManager.Translation.Languages is missing.'));
    }
    
    /**
     * Test protected method when Translation Configuration does not exists.
     * Expect method to return empty array.
     * 
     * @param none
     * @return void
     */
    public function test_getTransaltionLanguagesMethodReturnEmptyArrayWhenConfigDoesNotExists()
    {
        $method = new \ReflectionMethod(AppController::class, '_getTranslationLanguages');
        $method->setAccessible(TRUE);
        
        $this->get('/admin/menu-manager');
        // Ensure that configuration does not exists
        Configure::delete('MenuManager.Translation.Languages');
        $this->assertFalse(Configure::check('MenuManager.Translation.Languages'), __('Config variable must not exists for this test.'));
        
        $appController = new AppController();
        $languages = $method->invoke($appController);
        
        $this->assertTrue(empty($languages), __('Expect empty array.'));
    }
    
    /**
     * Test will method remove default locale from language list when present in 
     * associative array/list.
     * 
     * @param none
     * @return void
     */
    public function test_getTransaltionLanguagesMethodClearDefaultLocaleWhenPresentAsKey()
    {
        $method = new \ReflectionMethod(AppController::class, '_getTranslationLanguages');
        $method->setAccessible(TRUE);
        
        $this->get('/admin/menu-manager');
        
        $default = \Cake\I18n\I18n::getDefaultLocale();
        $configLanguages = [
            $default => 'Default',
            'aa_AA' => 'A-Language',
            'bb_BB' => 'B-Language',
        ];
        
        Configure::write('MenuManager.Translation.Languages', $configLanguages);
        
        $appController = new AppController();
        $languages = $method->invoke($appController);
        
        $this->assertArrayNotHasKey($default, $languages);
        $this->assertArrayHasKey('aa_AA', $languages);
        $this->assertArrayHasKey('bb_BB', $languages);
    }
    
    /**
     * /**
     * Test will method remove default locale from language array when present
     * as value.
     * 
     * @param none
     * @return void
     */
    public function test_getTransaltionLanguagesMethodClearDefaultLocaleWhenPresentAsValue()
    {
        $method = new \ReflectionMethod(AppController::class, '_getTranslationLanguages');
        $method->setAccessible(TRUE);
        
        $this->get('/admin/menu-manager');
        
        $default = \Cake\I18n\I18n::getDefaultLocale();
        $configLanguages = [
            $default,
            'aa_AA',
            'bb_BB',
        ];
        
        Configure::write('MenuManager.Translation.Languages', $configLanguages);
        
        $appController = new AppController();
        $languages = $method->invoke($appController);
        
        $this->assertFalse(in_array($default, $languages));
        $this->assertTrue(in_array('aa_AA', $languages));
        $this->assertTrue(in_array('bb_BB', $languages));
    }
}
