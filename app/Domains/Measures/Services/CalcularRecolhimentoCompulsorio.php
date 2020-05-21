<?php

namespace App\Domains\Measures\Services;

use App\Domains\Game\Game;
use App\Domains\Timeline\Timeline;
use App\Domains\Timeline\TimelineRepository;
use App\Domains\User\User;
use App\Domains\Measures\RecolhimentoCompulsorio;
use App\Domains\Measures\Validators\CalcularRecolhimentoCompulsorioValidator;
use App\Support\Service;
use Illuminate\Support\Facades\Auth;

class CalcularRecolhimentoCompulsorio extends Service
{

    /**
     * @var RecolhimentoCompulsorio
     */
    private $measure;
    /**
     * @var TimelineRepository
     */
    private $timelineRepository;

    public function __construct(RecolhimentoCompulsorio $measure, TimelineRepository $timelineRepository)
    {
        $this->measure = $measure;
        $this->timelineRepository = $timelineRepository;
    }

    public function validate(array $data)
    {
        return (new CalcularRecolhimentoCompulsorioValidator())->validate($data);
    }

    protected function perform(array $data, array $columns = ['*'], array $relations = [])
    {
        /** @var User $user */
        $user = Auth::user();
        /** @var Game $game */
        $game = $user->getActiveGame();
        /** @var Timeline $oldTimeline */
        $oldTimeline = $game->timelines->last();
        $newInfo = $this->measure->handle($oldTimeline, $data);

        $newTimeline = new Timeline();
        $newTimeline->game_id = $game->id;
        $newTimeline->pib = $newInfo['pib'];
        $newTimeline->unemployment_tax = $newInfo['unemployment_tax'];
        $newTimeline->inflation = $newInfo['inflation'];
        $newTimeline->measure_code = $this->measure->getCode();
        $newTimeline->measure_description = $this->measure->getDescription();
        $newTimeline->measure_value = $data['valor'];
        $newTimeline->round = $oldTimeline->round++;
        $this->timelineRepository->save($newTimeline);
        return $game;
    }
}
