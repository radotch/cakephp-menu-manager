# MenuManager plugin for CakePHP

## Requirements

```
 - php >= 5.6.x (recomended >= 7.1)
 - cakephp  ^3.5
```

For testing:

```
 - phpunit ^5.7.14|^6.x
```
## Features

 - Create Menu
 - Create Menu Links associated to Menu
 - Menu Links have Tree structure. It's make easy to create dropdowns, accordeon or other specific kind of Menu.
 - Menu Links positions
 - Translations

## Installation

You can install this plugin into your CakePHP application using [composer](http://getcomposer.org).

The recommended way to install plugin is:

```
composer require radotch/cakephp-menu-manager
```

## Load plugin

To load plugin add next line in bootstrap() method in Application.php file:
```
$this->addPlugin('MenuManager', ['autoload' => true, 'routes' => true]);
```
or you can use object way
```
$plugin = new \MenuManager\Plugin(array $config = [])
            ->disable('bootstrap')
            ->enable('routes');
$this->addPlugin($plugin)
```

Prior 3.6.0 use next:

```
Plugin::load('MenuManager', ['autoload' => true, 'routes' => true]);
```

And you are ready to use MenuManager plugin.

## Migrations

Once the plug-in is available execute Migrations to create required tables:

```
$ path/to/project> bin/cake migrations migrate --plugin MenuManager
```

***Note:*** If table i18n already exists migration will not try to create it.

There is available initial seed which can be used if cover application needs on start or just for test purposes:

```
$ path/to/project> bin/cake migrations seed --plugin MenuManager
```

## Usage

### Control panel

Plugin's Control panel is available on '/admin/menu-manager/'. ***Do not forget to restrict access***

Now you can create Menus and add Menu Links.

### Get Data

To get Menu Links in hierarchical structure use 'threaded' finder:
```
// In controller
$menu = $this->TableRegistry::getTableLocator()
        ->get('MenuManager.Menus')
        ->find()
        ->contain(['MenuLinks' => ['finder' => 'threaded']])
        ->where([$whereConditions]);
```

Or

```
// In controller
$menuLinks = $this->TableRegistry::getTableLocator()
        ->get('MenuManager.MenuLinks')
        ->find('threaded')
        // Some query requirements
        ->where(['menu_id' => $menuId]);
```

#### Menu Links positions

When create or update menu Link you can set link's position. If is changed at this point
the change will not affect other links. All other Menu Link positions must be changed by hand.

Sorry about that and later when I have little more time I'll automate it.
Also support will be accepted and appreciated.

### Translation
To be able to add translations about Menu and Menu Links set next Configuration
as associative array or list:

```
$language = [
    'bg_BG' => 'Bulgarian',
    'en' => 'English',
    'en_US' => 'English (United States)'
];
Configure::write('MenuManager.Translation.Languages', $languages);
```

or 

```
$plugin = new \MenuManager\Plugin($config = []);
$plugin->setTranslations($languages);
```

The best place is bootstrap() method at Application.php I think. 

### Display Menu

At this stage to display menu you have to write your own code.

Good luck!
