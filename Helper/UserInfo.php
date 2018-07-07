<?php

namespace Btc\CoreBundle\Helper;

class UserInfo
{
    const STATUS_UNSUBMITTED = 0;
    const STATUS_DECLINED = 1;
    const STATUS_PENDING = 2;
    const STATUS_APPROVED = 3;

    const STATUS_UNSUBMITTED_STR = 'unsubmitted';
    const STATUS_PENDING_STR = 'pending';
    const STATUS_APPROVED_STR = 'approved';
    const STATUS_DECLINE_STR = 'declined';
    const STATUS_ANY_STR = 'any';

    const TYPE_PERSONAL = 'personal';
    const TYPE_BUSINESS = 'business';
}