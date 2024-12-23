<?php

    namespace App\Bundle\UserBundle\Utils;

    class RolesUtil
    {
        const ROLE_FREE_MEMBER = 'ROLE_FREE_MEMBER';
        const ROLE_CUSTOMER = 'ROLE_CUSTOMER';
        const ROLE_AGENCY_STAFF = 'ROLE_AGENCY_STAFF';
        const ROLE_AGENCY_ADMIN = 'ROLE_AGENCY_ADMIN';
        const ROLE_WEBAPP_STAFF = 'ROLE_WEBAPP_STAFF';
        const ROLE_WEBAPP_ADMIN = 'ROLE_WEBAPP_ADMIN';

        const ROLE_FREE_MEMBER_ID = 1;
        const ROLE_CUSTOMER_ID = 2;
        const ROLE_AGENCY_STAFF_ID = 3;
        const ROLE_AGENCY_ADMIN_ID = 4;
        const ROLE_WEBAPP_STAFF_ID = 5;
        const ROLE_WEBAPP_ADMIN_ID = 6;

        const ADMIN_DEFAULT_ROUTE = 'admin_dashboard_route';


        //role title
        const ROLE_FREE_MEMBER_TITLE = 'Free Member';
        const ROLE_CUSTOMER_TITLE = 'Customer';
        const ROLE_AGENCY_STAFF_TITLE = 'Agency Staff';
        const ROLE_AGENCY_ADMIN_TITLE = 'Agency Admin';
        const ROLE_WEBAPP_STAFF_TITLE = 'Staff';
        const ROLE_WEBAPP_ADMIN_TITLE = 'Admin';

        const ROLE_MAPPING = [
          self::ROLE_FREE_MEMBER_ID => self::ROLE_FREE_MEMBER_TITLE,
          self::ROLE_CUSTOMER_ID => self::ROLE_CUSTOMER_TITLE,
          self::ROLE_AGENCY_STAFF_ID => self::ROLE_AGENCY_STAFF_TITLE,
          self::ROLE_AGENCY_ADMIN_ID => self::ROLE_AGENCY_ADMIN_TITLE,
          self::ROLE_WEBAPP_STAFF_ID => self::ROLE_WEBAPP_STAFF_TITLE,
          self::ROLE_WEBAPP_ADMIN_ID => self::ROLE_WEBAPP_ADMIN_TITLE
        ];


    }
