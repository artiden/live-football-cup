<?php

namespace Artiden\FootballCup;

use Artiden\FootballCup\interface\PlayableTeam;

class HumanTeam extends Team implements PlayableTeam {
  public function __construct(
    string $name,
    private int $score = 0
  ) {
    parent::__construct($name);
  }

  public function getScore(): int
  {
    return $this->score;
  }

  public function setScore(int $score): void
  {
    if ($score < 0 || $score < $this->score) {
      throw new \InvalidArgumentException('Can not decrease score');
    }

    $this->score = $score;
  }
}
