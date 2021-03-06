<?php

namespace App\Factory;

use App\Entity\Book;
use App\Repository\BookRepository;
use Zenstruck\Foundry\ModelFactory;
use Zenstruck\Foundry\Proxy;
use Zenstruck\Foundry\RepositoryProxy;

/**
 * @extends ModelFactory<Book>
 *
 * @method static     Book|Proxy createOne(array $attributes = [])
 * @method static     Book[]|Proxy[] createMany(int $number, array|callable $attributes = [])
 * @method static     Book|Proxy find(object|array|mixed $criteria)
 * @method static     Book|Proxy findOrCreate(array $attributes)
 * @method static     Book|Proxy first(string $sortedField = 'id')
 * @method static     Book|Proxy last(string $sortedField = 'id')
 * @method static     Book|Proxy random(array $attributes = [])
 * @method static     Book|Proxy randomOrCreate(array $attributes = [])
 * @method static     Book[]|Proxy[] all()
 * @method static     Book[]|Proxy[] findBy(array $attributes)
 * @method static     Book[]|Proxy[] randomSet(int $number, array $attributes = [])
 * @method static     Book[]|Proxy[] randomRange(int $min, int $max, array $attributes = [])
 * @method static     BookRepository|RepositoryProxy repository()
 * @method Book|Proxy create(array|callable $attributes = [])
 */
final class BookFactory extends ModelFactory
{
    protected function getDefaults(): array
    {
        return [
            'isbn' => self::faker()->isbn10(),
            'title' => self::faker()->realText(40),
            'writerFirstName' => self::faker()->firstName(),
            'writerLastname' => self::faker()->lastName(),
            'summary' => self::faker()->paragraph(),
            'publisher' => self::faker()->realText(30),
            'language' => self::faker()->countryCode(),
        ];
    }

    protected function initialize(): self
    {
        return $this;
    }

    protected static function getClass(): string
    {
        return Book::class;
    }
}
