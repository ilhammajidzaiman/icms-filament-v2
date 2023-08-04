<?php

namespace App\Observers;

use App\Models\Slideshow;
use Illuminate\Support\Facades\Storage;

class SlideshowObserver
{
    /**
     * Handle the Slideshow "created" event.
     */
    public function created(Slideshow $slideshow): void
    {
        //
    }

    /**
     * Handle the Slideshow "updated" event.
     */
    public function updated(Slideshow $slideshow): void
    {
        if ($slideshow->isDirty('file')) {
            Storage::disk('public')->delete($slideshow->getOriginal('file'));
        }
    }

    /**
     * Handle the Slideshow "deleted" event.
     */
    public function deleted(Slideshow $slideshow): void
    {
        //
    }

    /**
     * Handle the Slideshow "restored" event.
     */
    public function restored(Slideshow $slideshow): void
    {
        //
    }

    /**
     * Handle the Slideshow "force deleted" event.
     */
    public function forceDeleted(Slideshow $slideshow): void
    {
        if (!is_null($slideshow->file)) {
            Storage::disk('public')->delete($slideshow->file);
        }
    }
}
