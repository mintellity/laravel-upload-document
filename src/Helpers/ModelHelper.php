<?php

namespace Mintellity\UploadDocument\Helpers;

class ModelHelper
{
    /**
     * @return array
     */
    public static function getAllModels(): array
    {
        $modelNames = collect(glob(app_path('Models') . '/*.php'))
            ->map(fn ($file) => basename($file, '.php'))
            ->toArray();

        $models = [];

        foreach ($modelNames as $modelName) {
            $modelClass = "App\\Models\\{$modelName}";
            $models[$modelName] = $modelClass;
        }

        return $models;
    }
}
