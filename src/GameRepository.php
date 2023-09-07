<?php

namespace Artiden\FootballCup;

use Artiden\FootballCup\exceptions\GameNotfound;
use Artiden\FootballCup\interface\GameRepositoryInterface;

class GameRepository implements GameRepositoryInterface {

  /**
   * @param array $storage In real world application we should pass some storage here...
   */
  public function __construct(
    private array $storage = []
  ) {}

  public function getActive(): array {
    return array_filter($this->storage, function (\Artiden\FootballCup\Game $item) {
      return $item->isActive();
    });
  }

  public function getAll(): array {
    return $this->storage;
  }

  public function getById(string $id): \Artiden\FootballCup\Game {
    $this->checkAvailability($id);

    return $this->storage[$id];
  }

  public function store(Game $game): string {
    // In real world app, I would use uuid.
    $id = uniqid();

    $this->storage[$id] = $game;

    return $id;
  }

  public function update(string $id, Game $game): string {
    $this->checkAvailability($id);

    $this->storage[$id] = $game;

    return $id;
  }

protected function checkAvailability(string $id): void {
    if (!array_key_exists($id, $this->storage)) {
      throw new GameNotfound();
    }
}
}
