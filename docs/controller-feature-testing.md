Controller Feature Testing 
=====

the `controller_features` key allows to specify an override for controllers in routes. Given a route like below:

```php
return array(
    'router' => array(
        'routes' => array(
            'home' => array(
                'type' => 'Zend\Mvc\Router\Http\Literal',
                'options' => array(
                    'route'    => '/',
                    'defaults' => array(
                        'controller' => 'Application\Controller\Index',
                        'action'     => 'index',
                    ),
                ),
            ),
        )
    )
);
```

The below swivel configuration would map 'Application\Controller\Index' to any of the controllers below
depending on the user's bucket:
- Application\Controller\IndexController
- Application\Controller\IndexAController
- Application\Controller\IndexBController

```php
<?php
return array(
    'swivel' => array(
        'features' => array(
            'Application\Controller\Index.versionA' => array(1,2,3),
            'Application\Controller\Index.versionB' => array(4),
        ),
        'controller_features' => array(
            'Application\Controller\Index' => array(
                'default' => 'Application\Controller\IndexController',
                'buckets' => array(5,6),
                'behaviors' => array(
                    'versionA' => 'Application\Controller\IndexAController',
                    'versionB' => 'Application\Controller\IndexBController'
                )
            )
        )
    )
);
```
Nothing special needs to be done besides mapping the controller to an index in `controller_features`, controllers
are defined as they normally as in the Service Manager and they behave as you would expect normal control to behave.