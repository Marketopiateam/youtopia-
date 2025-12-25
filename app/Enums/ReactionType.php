<?php

namespace App\Enums;

enum ReactionType: string
{
    case Like = 'like';
    case Heart = 'heart';
    case Laugh = 'laugh';
    case Sad = 'sad';
    case Angry = 'angry';
    case Celebrate = 'celebrate';
    case Idea = 'idea';
    case Question = 'question';
}
