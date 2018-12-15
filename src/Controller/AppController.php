<?php

namespace MenuManager\Controller;

use App\Controller\AppController as BaseController;
use Cake\Core\Configure;

class AppController extends BaseController
{
    /**
     * Read translation Languages from Configuration.
     * When default locale presents in languages as key or value will be removed
     * from list
     * 
     * $param none
     * @return array Array with languages or empty array. 
     */
    protected function _getTranslationLanguages()
    {
        $languages = Configure::read('MenuManager.Translation.Languages', []);
        $default = \Cake\I18n\I18n::getDefaultLocale();
        
        if (array_key_exists($default, $languages)) {
            unset($languages[$default]);
        }
        
        if (in_array($default, $languages)) {
            $key = array_search($default, $languages);
            
            unset($languages[$key]);
        }
        
        return $languages;
    }
}
