<?php

namespace Mintellity\UploadDocument\Traits;

use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Relations\MorphMany;
use Mintellity\UploadDocument\Models\Document;

/**
 * @method morphMany(mixed $config, string $string)
 */
trait InteractsWithDocuments
{
    /**
     * @return MorphMany
     */
    public function documents(): MorphMany
    {
        return $this->morphMany(Document::class, 'model');
    }

    /**
     * @param string $collectionName
     * @return Collection
     */
    public function getDocuments(string $collectionName = 'default'): Collection
    {
        $documentsQuery = $this->documents();

        if ($collectionName !== 'default') {
            $documentsQuery->where('collection_name', $collectionName);
        }

        $documents = $documentsQuery->get();

        $sortedDocuments = $documents->sortBy('name');

        return $sortedDocuments->groupBy('collection_name');
    }
}
