<?php

namespace App\Domains\IndicatorRule;

use App\Domains\Indicator\IndicatorRepository;
use App\Domains\IndicatorRule\Services\CreateNewsRule;
use App\Domains\News\News;
use App\Domains\News\NewsRepository;
use App\Http\Controllers\Controller;
use App\Support\Exceptions\InternalErrorException;
use App\Support\Exceptions\ValidationException;
use Illuminate\Http\Request;
use Exception;

class IndicatorRuleController extends Controller
{
    public function createNewsRule(Request $request)
    {
        try {
            /** @var CreateNewsRule $service */
            $service = app()->make(CreateNewsRule::class);
            /** @var News $game */
            $service->handle($request->toArray());
            return $this->returnWithSuccess()->with([
                'listNews' => (new NewsRepository)->getAll(),
                'indicators' => (new IndicatorRepository)->getAll(),
                'ruleConditions' => (new IndicatorRuleRepository)->getAllConditions(),
            ]);
        }catch (ValidationException $ex){
            return $this->returnWithException($ex)->withInput();
        }catch (Exception $ex){
            return $this->returnWithException(new InternalErrorException(__('internal-error')));
        }
    }
}
