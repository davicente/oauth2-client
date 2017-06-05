<?php
/**
 * This file is part of the league/oauth2-client library
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 *
 * @copyright Copyright (c) Alex Bilbie <hello@alexbilbie.com>
 * @license http://opensource.org/licenses/MIT MIT
 * @link http://thephpleague.com/oauth2-client/ Documentation
 * @link https://packagist.org/packages/league/oauth2-client Packagist
 * @link https://github.com/thephpleague/oauth2-client GitHub
 */

namespace League\OAuth2\Client\Tool;

use GuzzleHttp\Stream\Stream;

/**
 * Provides a standard way to generate query strings.
 */
trait QueryBuilderTrait
{
    /**
     * Build a query string from an array.
     *
     * @param array $params
     *
     * @return string
     */
    protected function buildQueryString(array $params)
    {
        return http_build_query($params, null, '&', \PHP_QUERY_RFC3986);
    }


    /**
     * Build a query stream from an array
     *
     * @param array $params
     *
     * @return Stream
     */
    public function buildQueryAsStream(array $params)
    {
        $queryString = http_build_query($params, null, '&', \PHP_QUERY_RFC3986);
        return Stream::factory($queryString);
    }



    /**
     * Build a query stream from a string
     *
     * @param string $queryString
     *
     * @return Stream
     */
    public function buildQueryStringAsStream(string $queryString)
    {
        return Stream::factory($queryString);
    }
}
