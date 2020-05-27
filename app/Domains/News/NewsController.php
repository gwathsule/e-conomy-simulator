<?php

namespace App\Domains\News;

use App\Domains\Indicator\IndicatorRepository;
use App\Domains\IndicatorRule\IndicatorRuleRepository;
use App\Domains\News\Services\CreateNews;
use App\Domains\News\Services\DeleteNews;
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
    /**
     * @var IndicatorRepository
     */
    private $indicatorRepository;
    /**
     * @var IndicatorRuleRepository
     */
    private $indicatorRuleRepository;

    public function __construct(
        NewsRepository $newsRepository,
        IndicatorRepository $indicatorRepository,
        IndicatorRuleRepository $indicatorRuleRepository
    )
    {
        $this->indicatorRepository = $indicatorRepository;
        $this->indicatorRuleRepository = $indicatorRuleRepository;
        $this->newsRepository = $newsRepository;
    }

    public function createNews(Request $request)
    {
        try {
            /** @var CreateNews $service */
            $service = app()->make(CreateNews::class);
            $service->handle($request->toArray());
            return $this->returnWithSuccess()->with($this->newsPageInfo());
        }catch (ValidationException $ex){
            return $this->returnWithException($ex)->withInput();
        }catch (Exception $ex){
            return $this->returnWithException(new InternalErrorException())->withInput();
        }
    }

    public function deleteNews($id)
    {
        try {
            /** @var DeleteNews $service */
            $service = app()->make(DeleteNews::class);
            $service->handle(['id' => $id]);
            return $this->returnWithSuccess()->with($this->newsPageInfo());
        }catch (ValidationException $ex){
            return $this->returnWithException($ex)->withInput();
        }catch (Exception $ex){
            return $this->returnWithException(new InternalErrorException())->withInput();
        }
    }

    public function newsPage()
    {
        return view('admin.noticias')->with($this->newsPageInfo());
    }

    private function newsPageInfo()
    {
        return [
            'listNews' => $this->newsRepository->getAll(),
            'indicators' => $this->indicatorRepository->getAll(),
            'ruleConditions' => $this->indicatorRuleRepository->getAllConditions(),
        ];
    }
}
