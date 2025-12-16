<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Dashboard\DashboardController;
use App\Models\TemporaryUpload;
use Illuminate\Http\Request;
use Spatie\MediaLibrary\MediaCollections\Models\Media;

class FileController extends DashboardController
{
    protected string $routeName = 'dashboard.general.files';

    protected string $model = TemporaryUpload::class;

    public function uploadFile(Request $request)
    {
        $request->validate([
            'file' => 'required|file|max:2048',
        ]);
        $collection = uniqid('collection_hz_'.rand(1111, 9999).'_');

        $model = $this->model::create();
        $file = uploadMedia($collection, $request->file('file'), $model);
        self::apiCode(200)->apiMessage(t_('successfully uploaded file'))
            ->apiBody([
                'file' => [
                    'id' => $file->id,
                    'uuid' => $file->uuid,
                    'name' => $file->name,
                    'collection_name' => $file->collection_name,
                    'extension' => $file->extension,
                    'size' => $file->size,
                    'mime_type' => $file->mime_type,
                    'url' => $file->getUrl(),
                ],
                'url' => $model->getFirstMediaUrl($collection),
                'collection' => "{$model->id}|{$collection}",
            ]);

        return self::apiResponse();
    }

    public function deleteFile(Request $request)
    {
        $file = TemporaryUpload::findOrFail($request->file_id);

        $file->delete();
        $path = storage_path('app/public/').$file->file_path;
        if (file_exists($path)) {
            unlink($path);
        }

        self::apiCode(200)->apiMessage(t_('successfully delete file'))->apiBody(['file' => $file]);

        return self::apiResponse();
    }

    public function deleteFileByUUID(Request $request)
    {
        $file = Media::where('uuid', request('uuid'))->firstOrFail();

        $path = storage_path('app/public/').$file->file_path;
        if (file_exists($path)) {
            unlink($path);
        }
        $file->delete();

        self::apiCode(200)->apiMessage(t_('successfully delete file'))->apiBody(['file' => $file]);

        return self::apiResponse();
    }
}
