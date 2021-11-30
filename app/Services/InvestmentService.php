<?php

namespace App\Services;

use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Str;
use Intervention\Image\ImageManagerStatic as Image;

//CMS
use App\Models\Plan;

class InvestmentService
{
    public function upload(object $model, UploadedFile $file)
    {

        if ($model->plan()->exists()) {
            if (File::isFile(public_path('investment/plan/' . $model->plan()->first()->file))) {
                File::delete(public_path('investment/plan/' . $model->plan()->first()->file));
            }
        }

        $name = date('His') . '_' . Str::slug($model->name) . '.' . $file->getClientOriginalExtension();
        $file->storeAs('plan', $name, 'investment_uploads');

        $filepath = public_path('investment/plan/' . $name);
        Image::make($filepath)->fit(config('images.plan.width'), config('images.plan.height'))->save($filepath);

        Plan::updateOrCreate(
            ['investment_id' => $model->id],
            ['file' => $name]
        );
    }
}
