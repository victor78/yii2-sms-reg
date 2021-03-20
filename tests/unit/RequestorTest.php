<?php

use Victor78\SmsRegComponent\Requestor;

require_once __DIR__ . '/../../vendor/yiisoft/yii2/Yii.php';

class RequestorTest extends PHPUnit_Framework_TestCase
{

    static private $api_key = PHPUNIT_SMSREG_APIKEY;

    public function testGetBalance()
    {
        $requestor = new Requestor([
            'api_key' => self::$api_key,
        ]);
        $response = $requestor->getBalance();
        $this->assertInternalType("array", $response);
        $this->assertArrayHasKey('response', $response);
        $this->assertArrayHasKey('balance', $response);
    }

    public function testGetList()
    {
        $requestor = new Requestor([
            'api_key' => self::$api_key,
        ]);
        $response = $requestor->getList();
        $this->assertInternalType("array", $response);
        $this->assertArrayHasKey('services', $response);
        $this->assertGreaterThan(0, count($response));
    }
}
