<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Storage;

class Logo extends Model
{
    use HasFactory;

    public function storeFile($file)
    {
        if (!Storage::exists('public/logo/')) {
            Storage::makeDirectory('public/logo/', 0777, true, true);
        }

        $this->file = basename($file->store('public/logo/'));
    }
}
