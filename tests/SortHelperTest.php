<?php

namespace Artiden\FootballCup\Test;

use Artiden\FootballCup\Game;
use Artiden\FootballCup\helpers\SortHelper;
use PHPUnit\Framework\TestCase;

class SortHelperTest extends TestCase {

  public function testHelperSortsByScoreAndCreationDate(): void {
    $game1 = \Mockery::mock(Game::class);
    $game1->makePartial();
    $game1->createdAt = new \DateTimeImmutable('2023-01-01 01:11:11');
    $game1->shouldReceive('getScore')
      ->times(2)
      ->andReturn(1);

    $game2 = \Mockery::mock(Game::class);
    $game2->makePartial();
    $game2->createdAt = new \DateTimeImmutable('2023-02-02 02:22:22');
    $game2->shouldReceive('getScore')
      ->times(2)
      ->andReturn(1);

    $game3 = \Mockery::mock(Game::class);
    $game3->makePartial();
    $game3->createdAt = new \DateTimeImmutable('2023-03-03 03:33:33');
    $game3->shouldReceive('getScore')
      ->times(2)
      ->andReturn(10);

    $game4 = \Mockery::mock(Game::class);
    $game4->makePartial();
    $game4->createdAt = new \DateTimeImmutable('2023-04-04 04:44:44');
    $game4->shouldReceive('getScore')
      ->times(2)
      ->andReturn(12);

    $game5 = \Mockery::mock(Game::class);
    $game5->makePartial();
    $game5->createdAt = new \DateTimeImmutable('2022-01-01 01:11:11');
    $game5->shouldReceive('getScore')
      ->times(2)
      ->andReturn(12);

    $game6 = \Mockery::mock(Game::class);
    $game6->makePartial();
    $game6->createdAt = new \DateTimeImmutable('2023-11-11 01:11:11');
    $game6->shouldReceive('getScore')
      ->times(2)
      ->andReturn(12);

    $sortedBoard = SortHelper::sortBoardGames([
      $game1,
      $game2,
      $game3,
      $game4,
      $game5,
      $game6,
    ]);

    $previousGame = $currentGame = $sortedBoard[array_key_first($sortedBoard)];
    foreach ($sortedBoard as $game) {
      $currentGame = $game;
      $this->assertGreaterThanOrEqual($currentGame->getScore(), $previousGame->getScore());
      $previousGame = $game;
    }
  }

}
