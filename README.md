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

an run the Install from not development packages like PHPunit  

```
# composer update --no-dev 



```

### Usage

load package
```

require_once ('vendor/autoload.php');

use \monaid\AsciiArt as Ascii;

```


Create the Objects
```
$c = new Ascii\AsciiArt();

 ```
register shape generators

```
$c->registerGenerator('ct', new Ascii\ShapeGenerators\ChristmasTree());  
$c->registerGenerator('rs', new Ascii\ShapeGenerators\ResponsiveChristmasStar()); 
$c->registerGenerator('cs', new Ascii\ShapeGenerators\ChristmasStar());

```

define output formats

```

$out = new Ascii\Output\OutputLikeDebug();
$html = new Ascii\Output\OutputRawHTML();
$raw = new Ascii\Output\OutputConsole();


```
render them  raw
  
``` 
print $out->render($c->gen["rs"](null, 5));
print $out->render($c->gen["cs"](null, 11));
print $out->render($c->gen["rs"](null, 11));
print $out->render($c->gen["ct"](null, 11));

```

use the human readeble translator with randowm fallback

for normal use:

```

list ($x, $y ) = $c->translateSizes('Large');
print $out->render($c->gen["ct"]($x, $y));


```

for random use:

```
list ($x, $y ) = $c->translateSizes();
print $out->render($c->gen["ct"]($x, $y));

// or

print $out->render($c->gen["ct"](NULL,$c->translateSizes()[1]); 

```

