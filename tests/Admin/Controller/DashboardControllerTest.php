<?php

namespace App\Tests\Admin\Controller;

use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;

class DashboardControllerTest extends WebTestCase
{
    /**
     * @dataProvider provideUrls
     */
    public function testPageIsSuccessful(string $url): void
    {
        $client = self::createClient();
        $client->catchExceptions(false);
        $client->request('GET', $url);

        self::assertResponseIsSuccessful();
    }

    public function provideUrls(): iterable
    {
        yield 'admin' => ['/admin'];
        /*yield 'user' => ['/admin/users'];
        yield 'book' => ['/admin/books'];
        yield 'physicalBook' => ['/admin/physical_books'];
        yield  'review' => ['/admin/reviews'];
        yield  'borrow' => ['/admin/borrows'];*/
    }
}
