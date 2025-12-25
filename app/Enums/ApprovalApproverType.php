<?php

namespace App\Enums;

enum ApprovalApproverType: string
{
    case Employee = 'employee';         // Specific employee by ID
    case Role = 'role';                 // Employee with a specific role
    case DepartmentHead = 'department_head'; // Head of the relevant department
    case Manager = 'manager';           // Direct manager of the employee who initiated the request
    case Custom = 'custom';             // For more complex, dynamic logic (e.g., based on amount)
}
