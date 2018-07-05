# MenuManager plugin for CakePHP

## Note

This plugin is under construction. Even though you can try it and if cover your needs use it.

## Requirements

```
 - php >= 5.6.x (recomended >= 7.1)
 - cakephp  ^3.5
```

For testing:

```
 - phpunit >= 6.5.x
```
## Features

 - Create Menu
 - Create Menu Links associated to Menu
 - Menu Links have Tree structure. It's make easy to create dropdowns, accordeon or other specific kind of Menu.

## Installation

You can install this plugin into your CakePHP application using [composer](http://getcomposer.org).

The recommended way to install plugin is:

```
composer require radotch/cakephp-menu-manager
```

To make the plugin available in the application execute on your command-line:

```
$ path/to/project> bin/cake plugin load MenuManager --routes --autoload
```

The command line alternative is to add next line:
```
$this->addPlugin('MenuManager', ['autoload' => true, 'routes' => true]);
```

at bootstrap method in Application.php file which will looks like:

```
public function bootstrap()
{
    $this->addPlugin('MenuManager', ['autoload' => true, 'routes' => true]);

    // Call parent to load bootstrap from files.
    parent::bootstrap();
}
```

And you are ready to use MenuManager.

## Migrations

Once the plug-in is available execute Migrations to create required tables:

```
$ path/to/project> bin/cake migrations migrate --plugin MenuManager
```

There is available initial seed which can be used if cover application needs on start or just for test purposes:

```
$ path/to/project> bin/cake migrations seed --plugin MenuManager
```

## Usage

Plugin's Control panel is available on '/admin/menu-manager/'. ***Do not forget to restrict access***

Now you can create Menus and add Menu Links.

### Get Menu

To get Menu Links in hierarchical structure use 'threaded' finder:
```
// In controller
$menu = $this->Menus->find()
        ->contain(['MenuLinks' => ['finder' => 'threaded']])
        ->where([$whereConditions]);
```

Or

```
// In controller
$menuLinks = $this->MenuLinks->find('threaded')
        // Some query requirements
        ->where(['menu_id' => $menuId]);
```

At this stage to display menu you have to write your own code.

Good luck!
