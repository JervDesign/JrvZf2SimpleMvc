<?php

/**
 * ZF2 Module Config file for Rcm
 *
 * This file contains all the configuration for the Module as defined by ZF2.
 * See the docs for ZF2 for more information.
 */
return array(

    'view_manager' => array(
        'template_path_stack' => array(
            '/',
        ),
    ),
    'controllers' => array(
        'invokables' => array(
            'JrvZf2SimpleMvc\Controller\SimpleController' =>
                'JrvZf2SimpleMvc\Controller\SimpleController',
        ),
    ),
    'router' => array(
        'routes' => array(
            'simpleControllerExample' => array(
                'may_terminate' => true,
                'type' => 'segment',
                'options' => array(
                    'route' => '/simple-mvc/example',
                    'defaults' => array(
                        'controller' => 'JrvZf2SimpleMvc\Controller\SimpleController',
                        'action' => 'index',
                    ),
                ),
                'viewConfig' => array(
                    'template' => __DIR__ . '/../view/example.html',
                    'terminate' => true,
                    'options' => array('some' => 'options'),
                    'variables' => array('some' => 'vars'),
                )
            ),
        ),
    ),
);