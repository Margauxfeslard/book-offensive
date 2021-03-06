<?php

namespace App\Factory;

use App\Entity\Review;
use App\Repository\ReviewRepository;
use Zenstruck\Foundry\ModelFactory;
use Zenstruck\Foundry\Proxy;
use Zenstruck\Foundry\RepositoryProxy;

/**
 * @extends ModelFactory<Review>
 *
 * @method static       Review|Proxy createOne(array $attributes = [])
 * @method static       Review[]|Proxy[] createMany(int $number, array|callable $attributes = [])
 * @method static       Review|Proxy find(object|array|mixed $criteria)
 * @method static       Review|Proxy findOrCreate(array $attributes)
 * @method static       Review|Proxy first(string $sortedField = 'id')
 * @method static       Review|Proxy last(string $sortedField = 'id')
 * @method static       Review|Proxy random(array $attributes = [])
 * @method static       Review|Proxy randomOrCreate(array $attributes = [])
 * @method static       Review[]|Proxy[] all()
 * @method static       Review[]|Proxy[] findBy(array $attributes)
 * @method static       Review[]|Proxy[] randomSet(int $number, array $attributes = [])
 * @method static       Review[]|Proxy[] randomRange(int $min, int $max, array $attributes = [])
 * @method static       ReviewRepository|RepositoryProxy repository()
 * @method Review|Proxy create(array|callable $attributes = [])
 */
final class ReviewFactory extends ModelFactory
{
    protected function getDefaults(): array
    {
        return [
            'note' => self::faker()->numberBetween(0, 5),
            'title' => self::faker()->realText(40),
            'body' => self::faker()->text(),
            'author' => UserFactory::random(),
            'book' => BookFactory::random(),
        ];
    }

    protected function initialize(): self
    {
        return $this;
    }

    protected static function getClass(): string
    {
        return Review::class;
    }
}
