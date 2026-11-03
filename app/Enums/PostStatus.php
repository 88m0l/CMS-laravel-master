<?php

namespace App\Enums;

enum PostStatus: string
{
    case Pending = "pending";
    case Published = "published";
}
