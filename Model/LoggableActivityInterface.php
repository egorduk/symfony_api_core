<?php namespace Btc\CoreBundle\Model;

use Btc\CoreBundle\Entity\Activity;

interface LoggableActivityInterface
{
    public function addActivity(Activity $activity);
    public function getActivities();
}
