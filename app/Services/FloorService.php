<?php

namespace App\Services;

use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Str;
use Intervention\Image\ImageManagerStatic as Image;

class FloorService
{
    public function uploadPlan(string $title, UploadedFile $file, object $model, int $investment_id, bool $delete = false)
    {

        if ($model->file->exists()) {
            if (File::isFile(public_path('investment/floor/' . $model->file))) {
                File::delete(public_path('investment/floor/' . $model->file));
            }
        }

        $name = date('His') . '_' . Str::slug($title) . '.' . $file->getClientOriginalExtension();
        $file->storeAs('floor', $name, 'investment_uploads');

        $filepath = public_path('investment/floor/' . $name);

        Image::make($filepath)
            ->resize(
                config('images.floor_plan.width'),
                config('images.floor_plan.height'),
                function ($constraint) {
                    $constraint->aspectRatio();
                }
            )->save($filepath);

        $model->update([
            'investment_id' => $investment_id,
            'file' => $name
        ]);
    }
}
