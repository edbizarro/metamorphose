<p align="center">
    <img width="200" src="https://i.pinimg.com/originals/e0/77/ec/e077ec8846b6cebb114bac4eb63d374e.png">
</p>
<p align="center">
    <a href='https://semaphoreci.com/edbizarro/metamorphose'> <img src='https://semaphoreci.com/api/v1/edbizarro/metamorphose/branches/master/badge.svg' alt='Build Status'></a>
    <a href="https://codeclimate.com/github/edbizarro/metamorphose/test_coverage"><img src="https://api.codeclimate.com/v1/badges/25524f733a23fb514c5c/test_coverage" /></a>
  <a href="https://styleci.io/repos/129276226"><img src="https://styleci.io/repos/129276226/shield?branch=master" alt="StyleCI"></a>  
  <a href="https://codeclimate.com/github/edbizarro/metamorphose/maintainability"><img src="https://api.codeclimate.com/v1/badges/25524f733a23fb514c5c/maintainability" /></a>
  <a href="https://packagist.org/packages/power-data-hub/metamorphose"><img src="https://poser.pugx.org/power-data-hub/metamorphose/v/stable.svg" alt="Latest Stable Version"></a>
  <a href="https://packagist.org/packages/power-data-hub/metamorphose"><img src="https://poser.pugx.org/power-data-hub/metamorphose/license.svg" alt="License"></a>
</p>
<p align="center">
  <h2>Metamorphose</h2>
</p>

Here are a few examples on how you can use the package:

```php
$result = app(Metamorphose::class)
    ->from(['Name' => ' John Doe ')
    ->through(\PowerDataHub\Metamorphose\Transformers\TrimTransformer) // TrimTransformer is loaded by default, you can safely omit this line
    ->transform();
```

`$result`

```php
['name' => 'John Doe']
```
