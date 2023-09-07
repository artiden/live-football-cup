<?php

namespace Artiden\FootballCup\helpers;

use Artiden\FootballCup\Game;

class SortHelper {
  public static function sortBoardGames(array $activeGames): array {
    uasort($activeGames, function (Game $a, Game $b){
      $scoreA = $a->getScore();
      $scoreB = $b->getScore();
      if ($scoreB === $scoreA) {
        return $b->createdAt->format('U') <=> $b->createdAt->format('U');
      }

      return $scoreB <=> $scoreA;
    });

    return $activeGames;
  }
}
