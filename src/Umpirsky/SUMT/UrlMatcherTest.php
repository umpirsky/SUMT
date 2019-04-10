<?php

namespace Umpirsky\SUMT;

use PHPUnit\Framework\TestCase;
use Symfony\Component\Routing\Matcher\UrlMatcher;
use Symfony\Component\Routing\RequestContext;
use Symfony\Component\Routing\RouteCollection;
use Symfony\Component\Routing\Route;
use Symfony\Component\Routing\Exception\ResourceNotFoundException;

class UrlMatcherTest extends TestCase
{
    private $urlMatcher;

    protected function setUp(): void
    {
        $routes = new RouteCollection();
        $routes->add('foo', new Route('/foo/{bar}'));

        $this->urlMatcher = new UrlMatcher($routes, new RequestContext('', 'GET'));
    }

    public function testMatch(): void
    {
        $this->assertEquals(['_route' => 'foo', 'bar' => 'sasa'], $this->urlMatcher->match('/foo/sasa'));
    }

    public function testDontMatch(): void
    {
        $this->expectException(ResourceNotFoundException::class);

        $this->urlMatcher->match('/foo/sasa/');
    }
}
