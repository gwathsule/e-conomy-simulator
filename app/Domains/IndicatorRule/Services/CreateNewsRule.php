<?php

namespace App\Domains\IndicatorRule\Services;

use App\Domains\IndicatorRule\IndicatorRule;
use App\Domains\IndicatorRule\IndicatorRuleRepository;
use App\Domains\IndicatorRule\Validators\CreateNewsRuleValidator;
use App\Domains\News\News;
use App\Domains\News\NewsRepository;
use App\Support\Service;

class CreateNewsRule extends Service
{
    /**
     * @var IndicatorRuleRepository
     */
    private $indicatorRuleRepository;
    /**
     * @var NewsRepository
     */
    private $newsRepository;

    public function __construct(
        IndicatorRuleRepository $indicatorRuleRepository,
        NewsRepository $newsRepository
    )
    {
        $this->indicatorRuleRepository = $indicatorRuleRepository;
        $this->newsRepository = $newsRepository;
    }

    public function validate(array $data)
    {
        return (new CreateNewsRuleValidator())->validate($data);
    }

    protected function perform(array $data, array $columns = ['*'], array $relations = [])
    {
        /** @var News $news */
        $news = $this->newsRepository->getById($data['news_id']);
        if (!is_null($news->indicator_rule_id)) {
            $rule = $this->indicatorRuleRepository->getById($news->indicator_rule_id);
        } else {
            $rule = new IndicatorRule();
        }
        if($data['condition'] != IndicatorRule::CONDITION_CHANCE_OF_OCCURRENCE) {
            $rule->indicator = $data['indicator'];
        } else {
            $rule->indicator = null;
        }
        $rule->condition = $data['condition'];
        $rule->value = $data['value'];
        $rule->type = IndicatorRule::TYPE_NEWS;
        $this->indicatorRuleRepository->save($rule);

        if (is_null($news->indicator_rule_id)){
            $news->indicator_rule_id = $rule->id;
            $this->newsRepository->update($news);
        }
        return $rule;
    }
}
