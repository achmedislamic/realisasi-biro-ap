<?php

namespace App\Providers;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\Relation;
use Illuminate\Database\Query\Builder;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    public function register(): void
    {
        //
    }

    public function boot(): void
    {
        Relation::enforceMorphMap([
            'opd' => 'App\Models\Opd',
            'sub_opd' => 'App\Models\SubOpd',
        ]);

        Model::preventSilentlyDiscardingAttributes(! $this->app->isProduction());
        Model::preventAccessingMissingAttributes(! $this->app->isProduction());

        Builder::macro('search', fn ($field, $string) => $string ?
                $this->orWhere($field, 'like', '%'.$string.'%')
                : $this
        );

        Builder::macro(
            'whenSort',
            fn ($sortField, $sort) => $this->when($sortField, fn ($query) => $query->orderBy($sortField, $sort))
        );

        Builder::macro(
            'whenFilter',
            fn ($column, $filter) => $this->when($filter !== null && $filter != '', fn ($query) => $query->where($column, $filter))
        );
    }
}
