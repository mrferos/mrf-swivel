<?php
return array(
    'service_manager' => array(
        'invokables' => array(
            'MrfSwivel\Route\RouteEvent' => 'MrfSwivel\Route\RouteEvent',
        ),
        'factories' => array(
            'MrfSwivel\Swivel'       => 'MrfSwivel\Service\SwivelFactory',
            'MrfSwivel\SwivelConfig' => 'MrfSwivel\Service\SwivelConfigFactory'
        ),
        'initializers' => array(
            'MrfSwivel\Service\SwivelAwareInitializer' => 'MrfSwivel\Service\SwivelAwareInitializer'
        )
    )
);