<?php

namespace MenuManager;

use Cake\Core\BasePlugin;
use Cake\Core\Configure;

/**
 * Plugin for MenuManager
 */
class Plugin extends BasePlugin
{
    /**
     * Set Translation Languages. 
     * For better results it's have to be associative array / list as next:
     * ```
     * [
     *      'bg_BG' => 'Bulgarian',
     *      'it_IT' => 'Italiano',
     *      'fr_FR' => 'Francias',
     * ]
     * ```
     * 
     * @param array $languages Language list
     * @return $this 
     */
    public function setTranslations(array $languages = [])
    {
        Configure::write('MenuManager.Translation.Languages', $languages);
        
        return $this;
    }
}
