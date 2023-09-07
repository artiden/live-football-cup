<?php

namespace Artiden\FootballCup\interface;

use Artiden\FootballCup\Game;

interface GameRepositoryInterface
{
  public function getActive(): array;
  public function getAll(): array;
  public function getById(string $id): Game;
  public function store(Game $game): string;
  public function update(string $id, Game $game): string;
}
