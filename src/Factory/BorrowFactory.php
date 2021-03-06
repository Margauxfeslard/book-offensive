<?php

namespace App\Factory;

use App\Entity\Borrow;
use App\Repository\BorrowRepository;
use Zenstruck\Foundry\ModelFactory;
use Zenstruck\Foundry\Proxy;
use Zenstruck\Foundry\RepositoryProxy;

/**
 * @extends ModelFactory<Borrow>
 *
 * @method static       Borrow|Proxy createOne(array $attributes = [])
 * @method static       Borrow[]|Proxy[] createMany(int $number, array|callable $attributes = [])
 * @method static       Borrow|Proxy find(object|array|mixed $criteria)
 * @method static       Borrow|Proxy findOrCreate(array $attributes)
 * @method static       Borrow|Proxy first(string $sortedField = 'id')
 * @method static       Borrow|Proxy last(string $sortedField = 'id')
 * @method static       Borrow|Proxy random(array $attributes = [])
 * @method static       Borrow|Proxy randomOrCreate(array $attributes = [])
 * @method static       Borrow[]|Proxy[] all()
 * @method static       Borrow[]|Proxy[] findBy(array $attributes)
 * @method static       Borrow[]|Proxy[] randomSet(int $number, array $attributes = [])
 * @method static       Borrow[]|Proxy[] randomRange(int $min, int $max, array $attributes = [])
 * @method static       BorrowRepository|RepositoryProxy repository()
 * @method Borrow|Proxy create(array|callable $attributes = [])
 */
final class BorrowFactory extends ModelFactory
{
    protected function getDefaults(): array
    {
        return [
            'startDate' => \DateTimeImmutable::createFromMutable(self::faker()->dateTimeBetween('-40 days', '-5 days')),
            'restitutionDate' => \DateTimeImmutable::createFromMutable(self::faker()->dateTimeBetween('5 days', '30 days')),
            'provisionalEndDate' => \DateTimeImmutable::createFromMutable(self::faker()->dateTimeBetween('2 days', '20 days')),
            'physicalBook' => PhysicalBookFactory::random(),
            'borrower' => UserFactory::random(),
        ];
    }

    protected function initialize(): self
    {
        return $this;
    }

    protected static function getClass(): string
    {
        return Borrow::class;
    }
}
