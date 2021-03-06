<?php

namespace Calchen\LaravelDingtalkRobot\Test;

use Calchen\LaravelDingtalkRobot\DingtalkRobotNoticeServiceProvider;
use Calchen\LaravelDingtalkRobot\Facade;
use Orchestra\Testbench\TestCase as TestbenchTestCase;

class TestCase extends TestbenchTestCase
{
    protected function getPackageProviders($app)
    {
        return [GuzzleProvider::class, DingtalkRobotNoticeServiceProvider::class];
    }

    protected function getPackageAliases($app)
    {
        return [
            'DingtalkRobot' => Facade::class,
        ];
    }

    protected function getEnvironmentSetUp($app)
    {
        $app['config']->set('dingtalk_robot', [
            'http_client_name' => null,
            // 因为没有旧的机器人故无法测试
            //            'default' => [
            //                'access_token' => env('DINGTALK_ROBOT_DEFAULT_ACCESS_TOKEN'),
            //                'timeout' => 2.0,
            //                'security_type' => null,
            //            ],
            'keywords'         => [
                'access_token'   => env('DINGTALK_ROBOT_KEYWORDS_ACCESS_TOKEN'),
                'timeout'        => 5.0,
                'security_types' => [
                    'keywords',
                ],
            ],
            'signature'        => [
                'access_token'       => env('DINGTALK_ROBOT_SIGNATURE_ACCESS_TOKEN'),
                'timeout'            => 5.0,
                'security_types'     => [
                    'signature',
                ],
                'security_signature' => env('DINGTALK_ROBOT_SIGNATURE_SECURITY_VALUES'),
            ],
            // 无法控制 travis ip，故这个测试跳过
            //            'ip' => [
            //                'access_token' => env('DINGTALK_ROBOT_ACCESS_TOKEN'),
            //                'timeout' => 2.0,
            //                'security_type' => 'ip',
            //            ],
        ]);
    }
}
