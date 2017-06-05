<?php

namespace League\OAuth2\Client\Test\Tool;

use League\OAuth2\Client\Tool\RequestFactory;
use League\OAuth2\Client\Tool\QueryBuilderTrait;
use PHPUnit_Framework_TestCase as TestCase;
use GuzzleHttp\Message\RequestInterface;

class RequestFactoryTest extends TestCase
{
    use QueryBuilderTrait;

    public function setUp()
    {
        $this->factory = new RequestFactory;
    }

    public function testGetRequest()
    {
        $method  = 'get';
        $uri     = '/test';

        $request = $this->factory->getRequest($method, $uri);

        $this->assertInstanceOf(RequestInterface::class, $request);
        $this->assertSame(strtoupper($method), $request->getMethod());
        $this->assertSame($uri, (string) $request->getUrl());

        $headers         = ['X-Test' => 'Foo'];
        $body            = $this->buildQueryStringAsStream(
                                $params = [
                                    'test'     => 'body'
                                ]);
        $protocolVersion = '1.0';

        $request = $this->factory->getRequest($method, $uri, $headers, $body, $protocolVersion);
        $this->assertTrue($request->hasHeader('X-Test'));
        $this->assertSame((string) $body, (string) $request->getBody());
        $this->assertSame($protocolVersion, $request->getProtocolVersion());
    }

    public function testGetRequestWithOptions()
    {
        $method  = 'head';
        $uri     = '/test/options';

        $request = $this->factory->getRequestWithOptions($method, $uri);

        $this->assertInstanceOf(RequestInterface::class, $request);
        $this->assertSame(strtoupper($method), $request->getMethod());
        $this->assertSame($uri, (string) $request->getUrl());

        $options = [
            'body'    =>    $this->buildQueryStringAsStream(
                                $params = [
                                    'another'  => 'test',
                                    'form'  => 'body'
                                ]),
            'headers' => ['Content-Type' => 'application/x-www-form-urlencoded'],
        ];

        $request = $this->factory->getRequestWithOptions($method, $uri, $options);

        $this->assertContains($options['headers']['Content-Type'], $request->getHeader('Content-Type'));
        $this->assertSame((string) $options['body'], (string) $request->getBody());
    }
}
