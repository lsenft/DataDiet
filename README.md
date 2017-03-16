# DataDiet plugin for CakePHP

CakePHP 3.x Plugin to restrict access to model data by group.

## Installation

You can install this plugin into your CakePHP application using [composer](http://getcomposer.org).

Add repository and package to local composer.json.

```JSON
{
    "require" : {
        "lsenft/DataDiet": "*"
    },
    "repositories": [
        {
            "url": "https://github.com/lsenft/DataDiet.git",
            "type": "vcs"
        }
    ]
}
```

Update composer libraries.

```BASH
$ composer update
```

Add plugin to cake project


```
$ bin/cake plugin load lsenft/DataDiet
```
