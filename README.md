# CoreBundle for BTC frontend and backend

[![Build Status](http://drone.datajob.lt/deathstar.datajob.lt/php/core-bundle/status.svg?branch=master)](http://drone.datajob.lt/deathstar.datajob.lt/php/core-bundle)

Contains domain model definitions, validators..

## Repositories

In order to have an entity repository, define a repository class map in
parameters of your sf2 service configuration:

``` yaml
# custom repository class map
parameters:
  entity_repositories:
    Btc\CoreBundle\Entity\BuyDeal: Btc\AdminBundle\Repository\BuyDealRepository
    Btc\CoreBundle\Entity\Market: Btc\TradeBundle\Repository\MarketRepository
```

## Load into kernel

``` php
<?php
// app/AppKernel.php

public function registerBundles()
{
    $bundles = array(
        // ...
        new Btc\CoreBundle\BtcCoreBundle(),
    );
    // ...
}
```
