<?php

namespace App;

class TennisMatch
{
    protected Player $playerOne;

    protected Player $playerTwo;

    public function __construct(Player $playerOne, Player $playerTwo)
    {
        $this->playerOne = $playerOne;
        $this->playerTwo = $playerTwo;
    }

    public function score(): string
    {
        if ($this->hasWinner()) {
            return "Winner: {$this->leader()}";
        }

        if ($this->hasAdvantage()) {
            return "Advantage: {$this->leader()}";
        }

        if ($this->isDeuce()) {
            return 'deuce';
        }

        return sprintf(
            "%s-%s",
            $this->playerOne->toTerm(),
            $this->playerTwo->toTerm(),
        );
    }

    protected function hasWinner(): bool
    {
        if (max([$this->playerOne->points, $this->playerTwo->points]) < 4) {
            return false;
        }

        return abs($this->playerOne->points - $this->playerTwo->points) >= 2;
    }

    protected function leader(): string
    {
        return $this->playerOne->points > $this->playerTwo->points
            ? $this->playerOne->name
            : $this->playerTwo->name;
    }

    protected function canBeWon(): bool
    {
        return $this->playerOne->points >= 3 && $this->playerTwo->points >= 3;
    }

    protected function isDeuce(): bool
    {
        return $this->canBeWon() && $this->playerOne->points === $this->playerTwo->points;
    }

    protected function hasAdvantage(): bool
    {
        if ($this->canBeWon()) {
            return (! $this->isDeuce());
        }

        return false;
    }
}
