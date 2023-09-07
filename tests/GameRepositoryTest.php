<?php

namespace Artiden\FootballCup\Test;

use Artiden\FootballCup\Game;
use Artiden\FootballCup\ArrayGameRepository;
use Artiden\FootballCup\HumanTeam;
use PHPUnit\Framework\TestCase;

class GameRepositoryTest extends TestCase {
  protected function setUp():void {
    $homeTeam = new HumanTeam('home');
    $awayTeam = new HumanTeam('away');
    $this->game = new Game($homeTeam, $awayTeam);
    $this->repository = new ArrayGameRepository();

    parent::setUp();
  }

  protected function tearDown(): void {
    $this->repository = null;
    $this->game = null;

    parent::tearDown();
  }

  public function testGetActive(): void {
    $this->repository->store($this->game);
    $game = clone $this->game;
    $game->setActive(true);
    $this->repository->store($game);

    $this->assertCount(2, $this->repository->getAll());
    $this->assertCount(1, $this->repository->getActive());
  }

  public function testGetAll(): void {
    $id = $this->repository->store($this->game);
    $this->assertArrayHasKey($id, $this->repository->getAll());

    $this->repository->store($this->game);
    $this->assertCount(2, $this->repository->getAll());
  }

  public function testGetById(): void {
    $id = $this->repository->store($this->game);

    $this->assertIsString($id);
    $game = $this->repository->getById($id);

    $this->assertEquals($this->game, $game);
  }

  public function testSave(): void {
    $this->assertTrue(empty($this->repository->getAll()));
    $this->repository->store($this->game);
    $this->assertCount(1, $this->repository->getAll());
  }

  public function testUpdate(): void {
    $id = $this->repository->store($this->game);

    $this->assertIsString($id);
    $game = $this->repository->getById($id);
    $this->assertFalse($game->isActive());

    $game->setActive(true);
    $updateId = $this->repository->update($id, $game);
    $this->assertEquals($updateId, $id);
    $game = $this->repository->getById($updateId);
    $this->assertTrue($game->isActive());
  }
}
