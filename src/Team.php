<?php

namespace Artiden\FootballCup;

abstract class Team
{
  public function __construct(
    public string $name
  ) {
    if (empty($this->name)) {
      throw new \InvalidArgumentException('The team name can not be empty');
    }
  }
}
