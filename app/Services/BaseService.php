<?php

namespace App\Services;

use App\Repositories\BaseRepository;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Pagination\LengthAwarePaginator;

abstract class BaseService
{
    public function __construct(protected BaseRepository $repository)
    {
    }

    public function paginate(int $perPage = 15): LengthAwarePaginator
    {
        return $this->repository->paginate($perPage);
    }

    public function paginateWith(array $relations, int $perPage = 15): LengthAwarePaginator
    {
        return $this->repository->query()->with($relations)->paginate($perPage);
    }

    public function findOrFail(int $id): Model
    {
        return $this->repository->findOrFail($id);
    }

    public function findOrFailWith(array $relations, int $id): Model
    {
        return $this->repository->query()->with($relations)->findOrFail($id);
    }

    public function query(): Builder
    {
        return $this->repository->query();
    }

    public function create(array $data): Model
    {
        return $this->repository->create($data);
    }

    public function update(Model $model, array $data): Model
    {
        return $this->repository->update($model, $data);
    }

    public function delete(Model $model): void
    {
        $this->repository->delete($model);
    }
}
