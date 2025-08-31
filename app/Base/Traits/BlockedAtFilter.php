<?php

namespace App\Base\Traits;

use Illuminate\Database\Eloquent\Builder;

trait BlockedAtFilter
{
    protected function applyBlockedAtFilter(Builder &$query, array &$filters): void
    {
        if (array_key_exists('blocked_at', $filters)) {
            $query->whereNull('blocked_at');
            unset($filters['blocked_at']);
        }
    }
}
