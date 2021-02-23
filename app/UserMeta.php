<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Spatie\MediaLibrary\Exceptions\FileCannotBeAdded\DiskDoesNotExist;
use Spatie\MediaLibrary\Exceptions\FileCannotBeAdded\FileDoesNotExist;
use Spatie\MediaLibrary\Exceptions\FileCannotBeAdded\FileIsTooBig;
use Spatie\MediaLibrary\HasMedia\HasMedia;
use Spatie\MediaLibrary\HasMedia\HasMediaTrait;
use Spatie\MediaLibrary\Models\Media;

class UserMeta extends Model implements HasMedia
{
    use HasMediaTrait;

    protected $fillable = ['phone', 'country', 'city', 'birthday'];

    /**
     * @param $pathToFile
     * @return Media
     * @throws DiskDoesNotExist
     * @throws FileDoesNotExist
     * @throws FileIsTooBig
     */
    public function addAvatar($pathToFile)
    {
        return $this->addMedia($pathToFile)->toMediaCollection('avatars');
    }

    /**
     * @return Media|null
     */
    public function getAvatar()
    {
        return $this->getFirstMedia('avatars');
    }

    /**
     * @return bool|null
     * @throws \Exception
     */
    public function removeAvatar()
    {
        $itemMedia = $this->getFirstMedia('avatars');
        return $itemMedia->delete();
    }
}
