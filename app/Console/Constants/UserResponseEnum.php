<?php

namespace App\Console\Constants;

enum UserResponseEnum: string
{
    case USERS_LIST = 'Users list';
    case USER_UPDATED = 'User updated';
    case USER_CREATE = 'User created';
    case USER_SHOW = 'User show';
    case USER_DELETED = 'User deleted';
    case ERROR = "Something went wrong, check Logs!";
}
