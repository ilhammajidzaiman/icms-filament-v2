<?php

namespace App\Observers;

use App\Models\BlogArticle;
use Illuminate\Support\Facades\Storage;

class BlogArticleObserver
{
    /**
     * Handle the BlogArticle "created" event.
     */
    public function created(BlogArticle $blogArticle): void
    {
        //
    }

    /**
     * Handle the BlogArticle "updated" event.
     */
    public function updated(BlogArticle $blogArticle): void
    {
        if ($blogArticle->isDirty('file')) {
            Storage::disk('public')->delete($blogArticle->getOriginal('file'));
        }
    }

    /**
     * Handle the BlogArticle "deleted" event.
     */
    public function deleted(BlogArticle $blogArticle): void
    {
        //
    }

    /**
     * Handle the BlogArticle "restored" event.
     */
    public function restored(BlogArticle $blogArticle): void
    {
        //
    }

    /**
     * Handle the BlogArticle "force deleted" event.
     */
    public function forceDeleted(BlogArticle $blogArticle): void
    {
        if (!is_null($blogArticle->file)) {
            Storage::disk('public')->delete($blogArticle->file);
        }
    }
}
