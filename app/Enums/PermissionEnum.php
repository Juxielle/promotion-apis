<?php

namespace App\Enums;

enum PermissionEnum
{
    const CREATE_USER = "create_user";
    const UPDATE_USER = "update_user";
    const DELETE_USER = "delete_user";
    const SHOW_USER = "show_user";
    const SHOW_USERS = "show_users";
    const SET_USER_STATUS = "set_user_status";
}
