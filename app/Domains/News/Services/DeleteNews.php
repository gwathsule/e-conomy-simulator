<?php

namespace App\Domains\News\Services;

use App\Domains\News\News;
use App\Domains\News\NewsRepository;
use App\Domains\News\Validators\DeleteNewsValidator;
use App\Support\Service;
use Illuminate\Contracts\Filesystem\Factory;
use Illuminate\Support\Facades\DB;

class DeleteNews extends Service
{
    /**
     * @var NewsRepository
     */
    private $newsRepository;
    /**
     * @var Factory
     */
    private $storage;

    public function __construct(NewsRepository $newsRepository, Factory $storage)
    {
        $this->newsRepository = $newsRepository;
        $this->storage = $storage;
    }

    public function validate(array $data)
    {
        return (new DeleteNewsValidator())->validate($data);
    }

    protected function perform(array $data, array $columns = ['*'], array $relations = [])
    {
        /** @var News $news */
        $news = $this->newsRepository->getById($data['id']);
        $this->newsRepository->delete($news);
        $this->storage->disk()->deleteDirectory($news->getPathUrl());
        return $news;
    }
}
