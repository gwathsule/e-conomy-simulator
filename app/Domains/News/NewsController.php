<?php

namespace App\Domains\News;

use App\Domains\Indicator\IndicatorRepository;
use App\Domains\News\Services\CreateNews;
use App\Http\Controllers\Controller;
use App\Support\Exceptions\InternalErrorException;
use App\Support\Exceptions\ValidationException;
use Exception;
use Illuminate\Http\Request;

class NewsController extends Controller
{
    /**
     * @var NewsRepository
     */
    private $newsRepository;

    public function __construct(NewsRepository $newsRepository)
    {
        $this->newsRepository = $newsRepository;
    }

    public function createNews(Request $request)
    {
        try {
            /** @var CreateNews $service */
            $service = app()->make(CreateNews::class);
            $service->handle($request->toArray());
            return $this->returnWithSuccess()->with([
                'listNews' => $this->newsRepository->getAll(),
            ]);
        }catch (ValidationException $ex){
            return $this->returnWithException($ex)->withInput();
        }catch (Exception $ex){
            return $this->returnWithException(new InternalErrorException())->withInput();
        }
    }

    public function newsPage()
    {
        return view('admin.noticias')->with([
            'listNews' => $this->newsRepository->getAll(),
        ]);
    }
}
