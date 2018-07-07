<?php

namespace Btc\CoreBundle\DataFixtures;

use Doctrine\Common\DataFixtures\FixtureInterface;
use Doctrine\ORM\EntityManager;
use Doctrine\DBAL\Schema\Column;
use Doctrine\DBAL\Schema\Table;
use Doctrine\DBAL\Types\Type;
use Symfony\Bridge\Doctrine\DataFixtures\ContainerAwareLoader;
use Symfony\Component\DependencyInjection\ContainerInterface;

class Loader extends ContainerAwareLoader
{
    private $em;
    private $loaded;

    /**
     * {@inheritdoc}
     */
    public function __construct(ContainerInterface $container, EntityManager $em)
    {
        $this->em = $em;
        parent::__construct($container); // its private
    }

    /**
     * {@inheritdoc}
     */
    public function addFixture(FixtureInterface $fixture)
    {
        if (!in_array(get_class($fixture), $this->getLoadedFixtures())) {
            parent::addFixture($fixture);
        }
    }

    /**
     * Fetch all already loaded fixtures. creates table if not present
     *
     * return array
     */
    private function getLoadedFixtures()
    {
        if (null === $this->loaded) {
            $conn = $this->em->getConnection();

            if (!$conn->getSchemaManager()->tablesExist(['fixtures'])) {
                $columns = [
                    'name' => new Column('name', Type::getType('string'), [
                        'length' => 255
                    ]),
                ];

                $table = new Table('fixtures', $columns);
                $table->setPrimaryKey(['name']);

                $conn->getSchemaManager()->createTable($table);
            }

            $this->loaded = array_map(function ($r) {
                return $r['name'];
            }, $conn->fetchAll('SELECT name FROM fixtures'));
        }

        return $this->loaded;
    }
}
