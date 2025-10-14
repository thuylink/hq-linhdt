<?php

namespace App;

enum OrderStatus: int
{
    case PENDING = 0; //ordered but not confirmed
    case CONFIRM = 1;
    case PREPARING = 2;
    case DELIVERING = 3;
    case SHIPPED = 4;
}
