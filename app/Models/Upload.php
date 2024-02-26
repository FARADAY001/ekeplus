<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Mostafaznv\Larupload\Enums\LaruploadMode;
use Mostafaznv\Larupload\Storage\Attachment;
use Mostafaznv\Larupload\Traits\Larupload;

class Upload extends Model
{
    use Larupload;
    
    /**
     * Define Upload Entities
     *
     * @return Attachment[]
     */
    public function attachments(): array
    {
        return [
            Attachment::make('main_file'),
            Attachment::make('other_file', LaruploadMode::LIGHT),
        ];
    }
}
