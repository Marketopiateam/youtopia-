<?php

namespace App\Enums;

enum EmployeeStatus: string
{
    case Active = 'active';
    case Terminated = 'terminated';
}
