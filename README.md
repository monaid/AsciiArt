# AsciiArt


### Installing via composer

Just put something like following to your local composer.json

```
{

"repositories": [{
             "type": "vcs", "url": "https://github.com/monaid/AsciiArt" 
            }
         ],
"require": {
    "monaid/AsciiArt": "dev-master"
  }
} 

```

an run 

```
# composer update

```

### Using

load package
```

require_once ('vendor/autoload.php');

use \monaid\AsciiArt as Ascii;

```


Create your Objects
```
$christmasTree = new Ascii\ChristmasTree();
$christmasStar = new Ascii\ResponsiveChristmasStar();
 ```
and the OutputObjects

```

$outputToConsole = new Ascii\OutputConsole();
$outputAsRawHTML = new Ascii\OutputRawHTML();
$outputLikeDebug = new Ascii\OutputLikeDebug();
```

render them
 
``` 
print $christmasStar->setOutput($outputToConsole)->render();
print $christmasTree->setOutput($outputAsRawHTML)->setSize('l')->render();
print $christmasStar->setOutput($outputLikeDebug)->setSize('s')->render();
```

