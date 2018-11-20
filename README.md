DivanteClassLocker
====================
Divante Class Locker bundle was created to block modifications on attributes in classes.
1
## Compatibility
This module is compatible with Pimcore >= 5.2
 
## Dependencies
pitpit/php-diff
 
## Events
- pimcore.class.preUpdate
    - Blocking any changes in class' attributes defined in config.
 
## Module goal
The goal of this module is:
- blocking modifications in class' attributes defined in config.
 
## Installing/Getting started
```bash
composer require divanteltd/pimcore-class-locker
```
In Pimcore panel select Extensions and click Enable/Install.

Define which attributes cannot be changed in which class in app/config/pimcore/classlocker/config.php:
```php
return [
    'class_name1' => [
        'attribute11',
        'attribute12',
    ],
    'class_name2' => [
        'attribute21',
        'attribute22',    
    ],    
];
```

## Contributing

If you'd like to contribute, please fork the repository and use a feature branch. Pull requests are warmly welcome.

## Licensing

GPL-3.0-or-later

## Standards & Code Quality

This module respects all Pimcore 5 code quality rules and our own PHPCS and PHPMD rulesets.

## About Authors

![Divante-logo](http://divante.co/logo-HG.png "Divante")

We are a Software House from Europe, existing from 2008 and employing about 150 people. Our core competencies are built around Magento, Pimcore and bespoke software projects (we love Symfony3, Node.js, Angular, React, Vue.js). We specialize in sophisticated integration projects trying to connect hardcore IT with good product design and UX.

We work for Clients like INTERSPORT, ING, Odlo, Onderdelenwinkel and CDP, the company that produced The Witcher game. We develop two projects: [Open Loyalty](http://www.openloyalty.io/ "Open Loyalty") - an open source loyalty program and [Vue.js Storefront](https://github.com/DivanteLtd/vue-storefront "Vue.js Storefront").

We are part of the OEX Group which is listed on the Warsaw Stock Exchange. Our annual revenue has been growing at a minimum of about 30% year on year.

Visit our website [Divante.co](https://divante.co/ "Divante.co") for more information.
