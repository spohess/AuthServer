<?php

declare(strict_types=1);

namespace App\Support\Auth\Actions\Permission;

use App\Base\Interfaces\Actions\CollectorActionInterface;
use App\Support\Auth\Models\Permission;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Collection;

class PermissionCollectorAction implements CollectorActionInterface
{
    public function __construct(
        private Permission $model,
    ) {}

    public function collect(?array $filters = null): ?Collection
    {
        $query = $this->model->query();

        if ($filters) {
            $this->applyFilters($query, $filters);
        }

        return $query->get();
    }

    private function applyFilters(Builder $query, array $filters): void
    {
        foreach ($filters as $field => $value) {
            $query->where($field, '=', $value);
        }
    }
}
