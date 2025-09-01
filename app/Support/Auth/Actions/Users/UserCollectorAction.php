<?php

declare(strict_types=1);

namespace App\Support\Auth\Actions\Users;

use App\Base\Interfaces\Actions\CollectorActionInterface;
use App\Base\Traits\BlockedAtFilter;
use App\Support\Auth\Models\User;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Collection;

class UserCollectorAction implements CollectorActionInterface
{
    use BlockedAtFilter;

    public function __construct(
        private User $model,
    ) {}

    public function collect(?array $filters = null): ?Collection
    {
        $query = $this->model->query();

        if ($filters) {
            $query = $this->applyFilters($query, $filters);
        }

        return $query->get();
    }

    private function applyFilters(Builder $query, array $filters): Builder
    {
        $this->applyBlockedAtFilter($query, $filters);

        foreach ($filters as $field => $value) {
            $query->where($field, '=', $value);
        }

        return $query;
    }
}
