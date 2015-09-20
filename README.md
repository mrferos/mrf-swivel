MrfSwivel
====

Was in need of a feature library that would work easily enough with ZF2, thankfully the guys over at Zumba made 
[Swivel](https://github.com/zumba/swivel) and all that left me to do was whip up a ZF2 module!

## Installation

1. Grab it via composer:
```bash
composer require mrferos/MrfSwivel
```
2. Copy the configuration file: 
```bash
cp vendor/mrferos/MrfSwivel/config/swivel.config.php.dist config/autoload/swivel.config.php
```
3. Add your features!

## Getting the Swivel Manager



## Setting your user to a specific bucket

If you want to set the user to a specific bucket, in your module bootstrap do the following:
```php
$swivelConfig = $serviceLocator->get('MrfSwivel\SwivelConfig');
$swivelConfig->setBucketIndex(3); // Can be from session/cookie/etc!
```

Just be sure to place this _before_ anything that might call Swivel, once the Manager has been pulled 
the user's bucket will be set (in lieu or a set bucket, one shall be randomly assigned).