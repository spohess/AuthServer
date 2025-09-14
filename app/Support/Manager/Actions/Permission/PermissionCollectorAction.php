<?php

declare(strict_types=1);

namespace App\Support\Manager\Actions\Permission;

use App\Base\Interfaces\Actions\CollectorActionInterface;
use App\Support\Manager\Models\User;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Collection;

class PermissionCollectorAction implements CollectorActionInterface
{
    public function __construct(
        private User $model,
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
            if (is_bool($value)) {
                $this->applyBoolFilter($query, $field, $value);
                continue;
            }
            $query->where($field, '=', $value);
        }
    }

    private function applyBoolFilter(Builder $query, string $field, bool $value): void
    {
        $query->whereNull($field, 'and', $value);
    }
}
