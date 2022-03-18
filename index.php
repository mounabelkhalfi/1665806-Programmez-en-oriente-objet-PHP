<?php
class Encouter 
{
    

public const RESULT_WINNER = 1;
public const RESULT_LOSER = -1;
public const RESULT_DRAW = 0;
public const RESULT_POSSIBILITIES = [RESULT_WINNER, RESULT_LOSER, RESULT_DRAW];

public function probabilityAgainst(int $levelPlayerOne, int $againstLevelPlayerTwo)
{
    return $this->(1/(1+(10 ** (($againstLevelPlayerTwo - $levelPlayerOne)/400))));
}

public function setNewLevel(int &$levelPlayerOne, int $againstLevelPlayerTwo, int $playerOneResult)
{
    if (!in_array($this->playerOneResult, RESULT_POSSIBILITIES)) {
        trigger_error(sprintf('Invalid result. Expected %s',implode(' or ', RESULT_POSSIBILITIES)));
    }

    $this->levelPlayerOne += (int) (32 * ($this->playerOneResult - probabilityAgainst($this->levelPlayerOne, $this->againstLevelPlayerTwo)));
}

$greg = 400;
$jade = 800;

echo sprintf(
    'Greg à %.2f%% chance de gagner face a Jade',
    probabilityAgainst($greg, $jade)*100
).PHP_EOL;

// Imaginons que greg l'emporte tout de même.
setNewLevel($greg, $jade, RESULT_WINNER);
setNewLevel($jade, $greg, RESULT_LOSER);

echo sprintf(
    'les niveaux des joueurs ont évolués vers %s pour Greg et %s pour Jade',
    $greg,
    $jade
);

exit(0);
