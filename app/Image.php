<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;
use Intervention\Image\ImageManagerStatic as ImageManager;

class Image extends Model
{
    const IMG_WIDTH = 1920;
    const IMG_HEIGHT = 1920;
    const THUMB_WIDTH = 400;
    const THUMB_HEIGHT = 400;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */

    protected $fillable = [
        'gallery_id',
        'name',
        'file'
    ];

    public function imageUpload($file)
    {

        $name = Str::slug($file->getClientOriginalName(), '-') . '_' . Str::random(3) . '.' .$file->getClientOriginalExtension();
        $file->storeAs('gallery/images', $name, 'public_uploads');

        $filepath = public_path('uploads/gallery/images/' . $name);
        ImageManager::make($filepath)->resize(self::IMG_WIDTH, self::IMG_HEIGHT, function ($constraint) {
            $constraint->aspectRatio();
        })->save($filepath);

        $filethumbpath = public_path('uploads/gallery/images/thumbs/' . $name);
        ImageManager::make($filepath)->fit(self::THUMB_WIDTH)->save($filethumbpath);

        $this->update(['file' => $name, 'name' => $file->getClientOriginalName()]);
    }

    public function sort(object $array)
    {
        $updateRecordsArray = $array->get('recordsArray');
        $listingCounter = 1;
        foreach ($updateRecordsArray as $recordIDValue) {
            $entry = self::find($recordIDValue);
            $entry->sort = $listingCounter;
            $entry->save();
            $listingCounter = $listingCounter + 1;
        }
    }

}
