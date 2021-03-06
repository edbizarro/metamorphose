<p align="center">
    <img width="200" src="https://i.pinimg.com/originals/e0/77/ec/e077ec8846b6cebb114bac4eb63d374e.png">
</p>
<p align="center" style="margin: 30px 0 35px;">Metamorphose - Transform your data</p>
<p align="center">
  <a href='https://semaphoreci.com/edbizarro/metamorphose'> <img src='https://semaphoreci.com/api/v1/edbizarro/metamorphose/branches/master/badge.svg' alt='Build Status'></a>  
  <a href="https://styleci.io/repos/129276226"><img src="https://styleci.io/repos/129276226/shield?branch=master" alt="StyleCI"></a>  
  <a href="https://codeclimate.com/github/edbizarro/metamorphose/maintainability"><img src="https://api.codeclimate.com/v1/badges/25524f733a23fb514c5c/maintainability" /></a>
  <a href="https://packagist.org/packages/power-data-hub/metamorphose"><img src="https://poser.pugx.org/power-data-hub/metamorphose/v/stable.svg" alt="Latest Stable Version"></a>
  <a href="https://packagist.org/packages/power-data-hub/metamorphose"><img src="https://poser.pugx.org/power-data-hub/metamorphose/license.svg" alt="License"></a>
    <a href="https://app.fossa.io/projects/git%2Bgithub.com%2Fedbizarro%2Fmetamorphose?ref=badge_shield" alt="FOSSA Status"><img src="https://app.fossa.io/api/projects/git%2Bgithub.com%2Fedbizarro%2Fmetamorphose.svg?type=small"/></a>
</p>

---

Here are a few examples on how you can use the package:

```php
use \PowerDataHub\Metamorphose\Transformers\TrimTransformer;
use \PowerDataHub\Metamorphose\Metamorphose;

$result = app(Metamorphose::class)
    ->from(['name' => ' John Doe ')
    ->through(TrimTransformer::class)
    ->transform();

// Output

['name' => 'John Doe']
```

You can pass as many transformers as you want:


```php
use \PowerDataHub\Metamorphose\Transformers\TrimTransformer;
use \PowerDataHub\Metamorphose\Transformers\PercentTransformer;
use \PowerDataHub\Metamorphose\Transformers\NumericTransformer;
use \PowerDataHub\Metamorphose\Metamorphose;

app(Metamorphose::class)
    ->from(['name' => ' John Doe ', 'age' => '33', 'score' => '33.987'])
    ->through([
        TrimTransformer::class,
        PercentTransformer::class,        
        NumericTransformer::class,
    ])
    ->transform();
    
//Output

['name' => 'John Doe', 'age' => 33, 'score' => 33.99]
```



## Installation

You can install the package via composer:

``` bash
composer require power-data-hub/metamorphose
```

---

## Transformers

Metamorphose come with some useful transformers

#### Trim

```php
use \PowerDataHub\Metamorphose\Transformers\TrimTransformer;

app(Metamorphose::class)
    ->from(['name' => ' John', 'last_name' => ' Doe '])
    ->through(TrimTransformer::class)
    ->transform();

// Output

['name' => 'John', 'last_name' => 'Doe']
```

[![forthebadge](http://forthebadge.com/images/badges/contains-cat-gifs.svg)](http://forthebadge.com)
