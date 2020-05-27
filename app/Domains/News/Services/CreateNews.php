<?php

namespace App\Domains\News\Services;

use App\Domains\News\News;
use App\Domains\News\NewsRepository;
use App\Domains\News\Validators\CreateNewsValidator;
use App\Support\Service;
use Illuminate\Contracts\Filesystem\Factory;
use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\DB;

class CreateNews extends Service
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
        return (new CreateNewsValidator())->validate($data);
    }

    protected function perform(array $data, array $columns = ['*'], array $relations = [])
    {
        $news = new News();
        $news->title = $data['title'];
        $news->description = $data['description'];
        DB::transaction(function () use ($data, $news) {
            $this->newsRepository->save($news);
            /** @var UploadedFile $imageFile  */
            $imageFile = $data['image'] ?? null;
            $path = $news->getPathUrl();
            if ($imageFile) {
                $this->storage->disk()->put($path, $imageFile, 'public');
                $news->image_url = $path . $imageFile->hashName();
            }
            $this->newsRepository->update($news);
        });
        return $news;
    }
}
