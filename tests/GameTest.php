<?php

namespace Artiden\FootballCup\Test;

use Artiden\FootballCup\exceptions\SameTeamException;
use Artiden\FootballCup\Game;
use Artiden\FootballCup\HumanTeam;
use Mockery\Mock;
use PHPUnit\Framework\TestCase;

class GameTest extends TestCase
{
  protected $homeTeamName = 'home';
  protected $awayTeamName = 'away';

  protected function setUp(): void {
    $this->homeTeam = new HumanTeam($this->homeTeamName);
    $this->awayTeam = new HumanTeam($this->awayTeamName);$this->awayTeam->name = $this->awayTeamName;

    parent::setUp();
  }

  public function testGameCreatedInInactiveState(): void {
    $game = new \Artiden\FootballCup\Game($this->homeTeam, $this->awayTeam);

    $this->assertFalse($game->isActive());
  }

  public function testExceptionIsThrownOnTheSameTeam(): void {
    $this->expectException(SameTeamException::class);
    $game = new Game($this->homeTeam, $this->homeTeam);
  }

  public function testCanNotUpdateScoreWhenGameInactive(): void {
    $game = new Game($this->homeTeam, $this->awayTeam);

    $this->expectException(\Artiden\FootballCup\exceptions\InactiveGameException::class);
    $game->setScore(1, 1);
  }

  public function testCreationTimeIsSet(): void {
    $game = new \Artiden\FootballCup\Game($this->homeTeam, $this->awayTeam);
    $timeDiff = $game->createdAt->diff(new \DateTimeImmutable())->format("%u seconds");

    $this->assertTrue($timeDiff < 5);
  }

  public function testGameStartedWithZeroScore(): void {
    $game = new Game($this->homeTeam, $this->awayTeam);

    $this->assertEquals(0, $game->getScore());
  }

  public function testCanActivateGame(): void {
    $game = new Game($this->homeTeam, $this->awayTeam);

    $this->assertFalse($game->isActive());
    $game->setActive(true);
    $this->assertTrue($game->isActive());
  }

  public function testCanDeactivateGame(): void {
    $game = new Game($this->homeTeam, $this->awayTeam);

    $game->setActive(true);
    $this->assertTrue($game->isActive());
    $game->setActive(false);
    $this->assertFalse($game->isActive());
  }

  public function testGameScoreUpdates(): void {
    $game = new Game($this->homeTeam, $this->awayTeam);

    $this->assertEquals(0, $game->getScore());
    $game->setActive(true);
    $game->setScore(1, 3);
    $this->assertEquals(4, $game->getScore());
  }
}
