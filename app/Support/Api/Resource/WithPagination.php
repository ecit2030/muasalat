<?php

namespace App\Support\Api\Resource;

use Illuminate\Http\Resources\Json\ResourceCollection;
use Illuminate\Pagination\AbstractPaginator;

trait WithPagination
{
    /*    public static function collection($resource)
        {
            return tap(new AnonymousResourceCollection($resource, static::class), function ($collection) {
                if (property_exists(static::class, 'preserveKeys')) {
                    $collection->preserveKeys = (new static([]))->preserveKeys === true;
                }
            })->response()
              ->getData(true);
        }*/

    public static function paginate($resource, $wrapper = 'data'): ResourceCollection
    {
        if (! ($resource instanceof AbstractPaginator)) {
            return self::collection($resource);
        }

        return new class($resource, self::class, $wrapper) extends ResourceCollection {
            public string $wrapper;

            public function __construct($resource, string $collects, $wrapper = 'data')
            {
                $this->collects = $collects;
                parent::__construct($resource);
                $this->wrapper = $wrapper;
            }

            public function toArray($request): array
            {
                return [
                    $this->wrapper => $this->collection,
                    'paginate' => [
                        'total' => $this->total(),
                        'count' => $this->count(),
                        'per_page' => $this->perPage(),
                        'next_page_url' => $this->nextPageUrl() ?? '',
                        'prev_page_url' => $this->previousPageUrl() ?? '',
                        'current_page' => $this->currentPage(),
                        'total_pages' => $this->lastPage(),
                    ],
                ];
            }
        };
    }
}
