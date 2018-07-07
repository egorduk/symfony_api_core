<?php

namespace Btc\CoreBundle\DataFixtures\ORM;

use Doctrine\Common\DataFixtures\FixtureInterface;
use Doctrine\Common\DataFixtures\OrderedFixtureInterface;
use Doctrine\Common\Persistence\ObjectManager;
use Btc\CoreBundle\Entity\Article;

class LoadArticlesData implements FixtureInterface, OrderedFixtureInterface
{
    private $articles = [
        ['news01', 'My test news record 1', 'Long long long text'],
        ['news02', 'My test news record 2', 'Long long long text'],
        ['news03', 'My test news record 3', 'Long long long text'],
        ['news04', 'My test news record 4', 'Long long long text'],
        ['news05', 'My test news record 5', 'Long long long text'],
        ['news06', 'My test news record 6', 'Long long long text'],
        ['news07', 'My test news record 7', 'Long long long text'],
    ];

    /**
     * {@inheritDoc}
     */
    public function getOrder()
    {
        return 100; // low priority
    }

    /**
     * {@inheritDoc}
     */
    public function load(ObjectManager $manager)
    {
        $currencyRepo = $manager->getRepository('Btc\CoreBundle\Entity\Article');
        foreach ($this->articles as $data) {
            list($slug, $title, $content) = $data;
            $article = new Article;
            $article
                ->setTitle($title)
                ->setSlug($slug)
                ->setContent($content);

            $article->publish();

            $manager->persist($article);
        }
        $manager->flush();
    }
}
