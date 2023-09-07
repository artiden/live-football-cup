<?php

namespace Artiden\FootballCup;

use Artiden\FootballCup\exceptions\GameNotfound;
use Artiden\FootballCup\helpers\SortHelper;
use Artiden\FootballCup\interface\GameRepositoryInterface;

class Board {

  public function __construct(
    protected GameRepositoryInterface $repository
  ) {}

  public function startGame(string$id): void {
    $game = null;

    try {
      $game = $this->repository->getById($id);
    } catch (GameNotfound $e) {
      echo "The game with given ID is not found";
      return;
    }

    $game->setActive(true);
    $this->repository->update($id, $game);
  }

  public function finishGame(string $id): void {
    $game = null;

    try {
      $game = $this->repository->getById($id);
    } catch (GameNotfound $e) {
      echo "The game with given ID is not found";
      return;
    }

    $game->setActive(false);
    $this->repository->update($id, $game);
  }

  public function updateScore(string $id, int $homeTeamScore, int $awayTeamScore): void {
    $game = null;

    try {
      $game = $this->repository->getById($id);
    } catch (GameNotfound $e) {
      echo "The game with given ID is not found";
      return;
    }

    try {
      $game->setScore($homeTeamScore, $awayTeamScore);
      $this->repository->update($id, $game);
    } catch (\Exception $e) {
      echo "Can't update the game score due to error: {$e->getMessage()}";
      return;
    }
  }

  public function getSummary(): array {
    return SortHelper::sortBoardGames($this->repository->getActive());
  }
}
