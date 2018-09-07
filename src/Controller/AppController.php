<?php

namespace MenuManager\Controller;

use App\Controller\AppController as BaseController;
use Cake\Core\Configure;

class AppController extends BaseController
{
    /**
     * Read translation locales from Configuration.
     * 
     * @return array Array with locales or empty array. 
     */
    protected function _getTranslationLocales()
    {
        $translationLocales = Configure::read('Translation.locales', []);
        
        return $translationLocales;
    }
}
