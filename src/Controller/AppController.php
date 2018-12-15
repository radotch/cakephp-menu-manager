<?php

namespace MenuManager\Controller;

use App\Controller\AppController as BaseController;
use Cake\Core\Configure;

class AppController extends BaseController
{
    /**
     * Read translation Languages from Configuration.
     * 
     * $param none
     * @return array Array with languages or empty array. 
     */
    protected function _getTranslationLanguages()
    {
        $languages = Configure::read('MenuManager.Translation.Languages', []);
        
        return $languages;
    }
}
