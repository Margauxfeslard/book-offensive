<?php

namespace App\Factory;

use App\Entity\Borrow;
use App\Repository\BorrowRepository;
use Zenstruck\Foundry\RepositoryProxy;
use Zenstruck\Foundry\ModelFactory;
use Zenstruck\Foundry\Proxy;

/**
 * @extends ModelFactory<Borrow>
 *
 * @method static Borrow|Proxy createOne(array $attributes = [])
 * @method static Borrow[]|Proxy[] createMany(int $number, array|callable $attributes = [])
 * @method static Borrow|Proxy find(object|array|mixed $criteria)
 * @method static Borrow|Proxy findOrCreate(array $attributes)
 * @method static Borrow|Proxy first(string $sortedField = 'id')
 * @method static Borrow|Proxy last(string $sortedField = 'id')
 * @method static Borrow|Proxy random(array $attributes = [])
 * @method static Borrow|Proxy randomOrCreate(array $attributes = [])
 * @method static Borrow[]|Proxy[] all()
 * @method static Borrow[]|Proxy[] findBy(array $attributes)
 * @method static Borrow[]|Proxy[] randomSet(int $number, array $attributes = [])
 * @method static Borrow[]|Proxy[] randomRange(int $min, int $max, array $attributes = [])
 * @method static BorrowRepository|RepositoryProxy repository()
 * @method Borrow|Proxy create(array|callable $attributes = [])
 */
final class BorrowFactory extends ModelFactory
{
    public function __construct()
    {
        parent::__construct();

        // TODO inject services if required (https://symfony.com/bundles/ZenstruckFoundryBundle/current/index.html#factories-as-services)
    }

    protected function getDefaults(): array
    {
        return [
            'startDate' => self::faker()->dateTimeBetween('-40 days', '-5 days'),
            'restitutionDate' => self::faker()->dateTimeBetween('5 days', '30 days'),
            'provisionalEndDate' => self::faker()->dateTimeBetween('2 days', '20 days'),
        ];
    }

    protected function initialize(): self
    {
        // see https://symfony.com/bundles/ZenstruckFoundryBundle/current/index.html#initialization
        return $this
            // ->afterInstantiate(function(Borrow $borrow): void {})
        ;
    }

    protected static function getClass(): string
    {
        return Borrow::class;
    }
}
