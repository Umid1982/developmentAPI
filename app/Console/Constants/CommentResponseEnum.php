<?php

namespace App\Console\Constants;

enum CommentResponseEnum: string
{
    case COMMENTS_LIST = 'Comments list';
    case COMMENT_UPDATED = 'Comment updated';
    case COMMENT_CREATE = 'Comment created';
    case COMMENT_SHOW = 'Comment show';
    case COMMENT_DELETED = 'Comment deleted';
    case ERROR = "Something went wrong, check Logs!";
}
