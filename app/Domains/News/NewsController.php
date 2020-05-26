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
    public function createNews(Request $request)
    {
        try {
            /** @var CreateNews $service */
            $service = app()->make(CreateNews::class);
            $service->handle($request->toArray());
            return redirect()->route('news');
        }catch (ValidationException $ex){
            return $this->returnWithException($ex)->withInput();
        }catch (Exception $ex){
            return $this->returnWithException(new InternalErrorException(__('internal-error')));
        }
    }

    public function newsPage()
    {
        $newsRepository = new NewsRepository();
        $indicatorsRepository = new IndicatorRepository();
        $indicators = $indicatorsRepository->getAll();
        $listNews = $newsRepository->getAll();
        return view('admin.noticias')->with([
            'listNews' => $listNews,
            'indicators' => $indicators,
        ]);
    }
}
