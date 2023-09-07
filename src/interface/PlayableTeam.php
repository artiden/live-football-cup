<?php

namespace Artiden\FootballCup\interface;

interface PlayableTeam {
  public function getScore(): int;
  public function setScore(int $score): void;
}
