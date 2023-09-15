<?php

namespace App\Console\Constants;

enum CompanyResponseEnum: string
{
    case COMPANY_LIST = 'Companies list';
    case COMPANY_UPDATED = 'Company updated';
    case COMPANY_CREATE = 'Company created';
    case COMPANY_SHOW = 'Company show';
    case COMPANY_COMMENT = 'Company comments';
    case COMPANY_RATING = 'Company rating';
    case COMPANY_TOP = 'Companies top rating';
    case COMPANY_DELETED = 'Company deleted';
    case ERROR = "Something went wrong, check Logs!";
}
