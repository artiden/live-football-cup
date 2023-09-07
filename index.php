<?php

require_once ('vendor/autoload.php');

use Artiden\FootballCup\HumanTeam;

$repository = new \Artiden\FootballCup\ArrayGameRepository();

$teams = [
  [
    new HumanTeam('Mexico'),
    new HumanTeam('Canada'),
  ],
  [
    new HumanTeam('Spain'),
    new HumanTeam('Brazil'),
  ],
  [
    new HumanTeam('Germany'),
    new HumanTeam('France'),

  ],
  [
    new HumanTeam('Uruguay'),
    new HumanTeam('Italy'),
  ],
  [
    new HumanTeam('Argentina'),
    new HumanTeam('Australia'),
  ],
];

$scores = [
  [
    0, 5,
  ],
  [
    10, 2,
  ],
  [
    2, 2,
  ],
  [
    6, 6,
  ],
  [
    3, 1,
  ],
];

$games = [];
foreach ($teams as $k => $team) {
  list($homeTeam, $awayTeam) = $team;
  list($homeTeamScore, $awayTeamScore) = $scores[$k];

  $game = new \Artiden\FootballCup\Game($homeTeam, $awayTeam);
  $repository->store($game);
}

$board = new \Artiden\FootballCup\Board($repository);
$allGames = $repository->getAll();
echo "All games:\n";
printSummary($allGames);
// Activating all games and update scores
$index = 0;
foreach ($allGames as $id => $game) {
  $board->startGame($id);
  list($homeTeamScore, $awayTeamScore) = $scores[$index];
  $board->updateScore($id, $homeTeamScore, $awayTeamScore);
  $index++;
}

echo "Summary based on all active games:\n";
printSummary($board->getSummary());

// Deactivating random game
$id = array_rand($allGames);
$board->finishGame($id);

echo "After deactivated random game:\n";
printSummary($board->getSummary());


function printSummary(array $games) : void {
  $position = 1;
  /** @var \Artiden\FootballCup\Game $game */
  foreach ($games as $id => $game) {
    $homeTeam = $game->getHomeTeam();
    $awayTeam = $game->getAwayTeam();
    echo "$position. {$homeTeam->name} {$homeTeam->getScore()} - {$awayTeam->name} {$awayTeam->getScore()}\n";
    $position++;
  }
}
