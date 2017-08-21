<?php

use Silex\Provider\SecurityServiceProvider;
use Symfony\Component\Security\Core\Encoder\MessageDigestPasswordEncoder;
use TechNews\Provider\AuteurProvider;
use Silex\Provider\SessionServiceProvider;

# use Silex\Provider\SessionServiceProvider;
$app->register(new SessionServiceProvider());

#use Silex\Provider\SecurityServiceProvider;
$app->register(new SecurityServiceProvider(), array(
    'security.firewalls' => array(
        'main' => array(
            'pattern'   => '^/',
            'http'      => true,
            'anonymous' => true,
            'form'      => array(
                'login_path'    =>  '/connexion',
                'check_path'    =>  '/connexion/login_check'
            ),
            'logout'    => array(
                'logout_path'   => '/deconnexion'
            ),
            'users'     => function() use($app) {
            # use TechNews\Controller\Provider\AuteurProvider;
            return new AuteurProvider($app['idiorm.db']);
            }
            )
        ),
        'security.access_rules' => array(
            array('^/admin', 'ROLE_ADMIN', 'http'),
            array('^/auteur', 'ROLE_AUTEUR', 'http')
        ),
        'security.role_hierarchy' => array(
            'ROLE_ADMIN' => array('ROLE_AUTEUR')
        )
        )
);

# use Symfony\Component\Security\Core\Encoder\MessageDigestPasswordEncoder;
$app['security.encoder.digest'] = function() use($app) {
    return new MessageDigestPasswordEncoder('sha1', false, 1);
};

$app['security.default_encoder'] = function() use($app) {
    return $app['security.encoder.digest'];
};