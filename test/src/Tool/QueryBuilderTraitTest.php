<?php

namespace League\OAuth2\Client\Test\Tool;

use League\OAuth2\Client\Tool\QueryBuilderTrait;
use PHPUnit_Framework_TestCase;

class QueryBuilderTraitTest extends PHPUnit_Framework_TestCase
{
    use QueryBuilderTrait;

    public function setUp()
    {
        ini_set('arg_separator.output', '&amp;');
    }

    public function testBuildQueryString()
    {
        $params = [
            'a' => 'foo',
            'b' => 'bar',
            'c' => '+',
        ];

        $query = $this->buildQueryString($params);

        $this->assertSame('a=foo&b=bar&c=%2B', $query);
    }


    public function testBuildQueryStreamFromArray()
    {
        $params = [
            'a' => 'foo',
            'b' => 'bar',
            'c' => '+',
        ];

        $query = $this->buildQueryAsStream($params);

        $this->assertSame('a=foo&b=bar&c=%2B', (string) $query);
    }


    public function testBuildQueryStringAsStream()
    {
        $queryString = "a=foo&b=bar";

        $query = $this->buildQueryStringAsStream($queryString);

        $this->assertSame($queryString, (string) $query);
    }
}
