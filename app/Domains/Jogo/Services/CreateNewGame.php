<?php

namespace App\Domains\Game\Services;

use App\Domains\Game\Game;
use App\Domains\Game\GameRepository;
use App\Domains\Game\Validators\CreateNewGameValidator;
use App\Domains\Timeline\Momento;
use App\Domains\Timeline\TimelineRepository;
use App\Domains\User\User;
use App\Support\Service;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class CreateNewGame extends Service
{
    /**
     * @var GameRepository
     */
    private $gameRepository;
    /**
     * @var TimelineRepository
     */
    private $timelineRepository;

    public function __construct(
        GameRepository $gameRepository,
        TimelineRepository $timelineRepository
    )
    {
        $this->gameRepository = $gameRepository;
        $this->timelineRepository = $timelineRepository;
    }

    public function validate(array $data)
    {
        return (new CreateNewGameValidator())->validate($data);
    }

    protected function perform(array $data, array $columns = ['*'], array $relations = [])
    {
        //create a new game
        $newGame = new Game();
        $newGame->country_name = $data['pais'];
        $newGame->currency_name = $data['moeda'];
        $newGame->minister_name = $data['ministro'];
        $newGame->president_name = $data['presidente'];
        $newGame->description = $data['descricao'];
        $newGame->rounds = $data['rodadas'];
        $newGame->active = true;

        //create first timeline with real information of Brazil in 2019
        $firstTimeline = new Momento();
        $firstTimeline->round = 0;
        $firstTimeline->pib = 7.3;
        $firstTimeline->unemployment_tax = 11.9;
        $firstTimeline->inflation = 4.25;

        DB::transaction(function () use ($data, $newGame, $firstTimeline) {
            /** @var User $user */
            $user = Auth::user();
            //disable last game
            $lastGame = $user->getActiveGame();
            if(! is_null($lastGame)) {
                $lastGame->active = false;
                $this->gameRepository->update($lastGame);
            }
            $newGame->user_id = $user->id;
            $this->gameRepository->save($newGame);
            $firstTimeline->game_id = $newGame->id;
            $this->timelineRepository->save($firstTimeline);
        });
        return $newGame;
    }
}
