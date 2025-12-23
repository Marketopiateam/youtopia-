<?php

namespace App\Enums;

enum QuestionType: string
{
    case Text = 'text';
    case MultipleChoice = 'multiple_choice';
    case Rating = 'rating';
    // Potentially add other types like 'checkbox', 'dropdown', 'date', 'number', etc.
}
