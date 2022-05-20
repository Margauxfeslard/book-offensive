<?php

namespace App\Factory;

use App\Entity\PhysicalBook;
use App\Repository\PhysicalBookRepository;
use Zenstruck\Foundry\ModelFactory;
use Zenstruck\Foundry\Proxy;
use Zenstruck\Foundry\RepositoryProxy;

/**
 * @extends ModelFactory<PhysicalBook>
 *
 * @method static             PhysicalBook|Proxy createOne(array $attributes = [])
 * @method static             PhysicalBook[]|Proxy[] createMany(int $number, array|callable $attributes = [])
 * @method static             PhysicalBook|Proxy find(object|array|mixed $criteria)
 * @method static             PhysicalBook|Proxy findOrCreate(array $attributes)
 * @method static             PhysicalBook|Proxy first(string $sortedField = 'id')
 * @method static             PhysicalBook|Proxy last(string $sortedField = 'id')
 * @method static             PhysicalBook|Proxy random(array $attributes = [])
 * @method static             PhysicalBook|Proxy randomOrCreate(array $attributes = [])
 * @method static             PhysicalBook[]|Proxy[] all()
 * @method static             PhysicalBook[]|Proxy[] findBy(array $attributes)
 * @method static             PhysicalBook[]|Proxy[] randomSet(int $number, array $attributes = [])
 * @method static             PhysicalBook[]|Proxy[] randomRange(int $min, int $max, array $attributes = [])
 * @method static             PhysicalBookRepository|RepositoryProxy repository()
 * @method PhysicalBook|Proxy create(array|callable $attributes = [])
 */
final class PhysicalBookFactory extends ModelFactory
{
    protected function getDefaults(): array
    {
        return [
            'book' => BookFactory::random(),
            'owner' => UserFactory::random(),
        ];
    }

    protected function initialize(): self
    {
        return $this;
    }

    protected static function getClass(): string
    {
        return PhysicalBook::class;
    }
}
