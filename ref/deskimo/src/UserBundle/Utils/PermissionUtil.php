<?php

namespace UserBundle\Utils;


class PermissionUtil
{
  const LIST_USER_ADMIN = 'list.user.admin';
  const CREATE_USER_ADMIN = 'create.user.admin';
  const EDIT_USER_ADMIN = 'edit.user.admin';

  const MANAGE_PROPERTY = 'manage.property.per';
  const VIEW_PROPERTY = 'view.property.per';
  const EDIT_PROPERTY = 'edit.property.per';
  const ADD_PROPERTY = 'add.property.per';
  const MANAGE_PROPERTY_PICTURE = 'manage.property.picture.per';

  const MANAGE_COMPANY = 'manage.company.per';
  const VIEW_COMPANY_PROPERTY = 'view.company.property.per';
  const EDIT_COMPANY_PROPERTY  = 'edit.company.property.per';
  const ADD_COMPANY_PROPERTY  = 'add.company.property.per';
  const DELETE_COMPANY_PROPERTY  = 'delete.company.property.per';


  const PERMISSION_MAP = [
    self::LIST_USER_ADMIN => 'View users',
    self::CREATE_USER_ADMIN => 'Create user',
    self::EDIT_USER_ADMIN => 'Edit user',
    self::MANAGE_PROPERTY => 'Manage property',
    self::VIEW_PROPERTY => '- View property',
    self::EDIT_PROPERTY => '- Edit property',
    self::ADD_PROPERTY => '- Add property',
    self::MANAGE_PROPERTY_PICTURE => '- Manage property pictures',

    self::MANAGE_COMPANY => 'Manage Company',
    self::VIEW_COMPANY_PROPERTY => '- View company property',
    self::EDIT_COMPANY_PROPERTY => '- Edit company property',
    self::ADD_COMPANY_PROPERTY => '- Add company property',
    self::DELETE_COMPANY_PROPERTY => '- Delete company property',
  ];
}
