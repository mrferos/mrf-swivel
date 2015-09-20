<?php
return array(
    'service_manager' => array(
        'factories' => array(
            'MrfSwivel\Swivel'       => 'MrfSwivel\Service\SwivelFactory',
            'MrfSwivel\SwivelConfig' => 'MrfSwivel\Service\SwivelConfigFactory'
        ),
        'initializers' => array(
            'MrfSwivel\Service\SwivelAwareInitializer' => 'MrfSwivel\Service\SwivelAwareInitializer'
        )
    )
);