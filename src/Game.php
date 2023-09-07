<?php

namespace Artiden\FootballCup;

use Artiden\FootballCup\exceptions\InactiveGameException;
use Artiden\FootballCup\exceptions\SameTeamException;
use Artiden\FootballCup\interface\PlayableTeam;

class Game
{
  public \DateTimeImmutable $createdAt;
  protected bool $active;

  public function __construct(
    protected PlayableTeam $homeTeam,
    protected PlayableTeam $awayTeam
  ) {
    // In real world app we can use uuid for comparison here
    if ($this->homeTeam->name === $this->awayTeam->name) {
      throw new SameTeamException();
    }

    $this->active = false;
    $this->createdAt = new \DateTimeImmutable();
  }

  public function getHomeTeam(): PlayableTeam
  {
    return $this->homeTeam;
  }

  public function getAwayTeam(): PlayableTeam
  {
    return $this->awayTeam;
  }

  public function setScore(int $homeTeamScore, int $awayTeamScore): void {
    if (!$this->active) {
      throw new InactiveGameException();
    }

    $this->homeTeam->setScore($homeTeamScore);
    $this->awayTeam->setScore($awayTeamScore);
  }

  public function getScore(): int {
    return $this->homeTeam->getScore() + $this->awayTeam->getScore();
  }

  public function isActive(): bool
  {
    return $this->active;
  }

  public function setActive(bool $active): void
  {
    $this->active = $active;
  }
}
