<?php

namespace AngusDV\ParsNews\Observers;

use AngusDV\ParsNews\Entity\Article;
use AngusDV\ParsNews\Jobs\AdminNotificationJob;

class ArticleObserver
{
    public function created(Article $article)
    {
        AdminNotificationJob::dispatch($article);
    }
}
