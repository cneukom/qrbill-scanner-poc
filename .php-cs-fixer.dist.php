<?php

$finder = PhpCsFixer\Finder::create()
    ->in('app')
    ->in('config')
    ->in('database')
    ->in('routes')
    ->in('resources/lang')
    ->in('tests')
;

$config = new PhpCsFixer\Config();
return $config->setRules([
        '@Symfony' => true,
        'binary_operator_spaces' => [
            'default' => 'align',
        ],
        'blank_line_before_statement' => [],
    ])
    ->setFinder($finder)
;
