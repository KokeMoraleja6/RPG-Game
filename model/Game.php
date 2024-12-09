<?php

class Game{

    // Properties
    protected int $game_id;
    protected int $board_id;
    protected int $character_id;
    protected string $start_date = "";
    protected string $save_date = "";

    // Constructor
    public function __construct(int $game_id, int $board_id, int $character_id, string $start_date = null, string $save_date = null )
    {
        $this->game_id = $game_id;
        $this->board_id = $board_id;
        $this->character_id = $character_id;
        $this->start_date = $start_date ?? date('Y-m-d');
        $this->save_date = $save_date ?? date('Y-m-d');
    }

    // Getters
    public function getGameId(): int {
        return $this->game_id;
    }

    public function getBoardId(): int {
        return $this->board_id;
    }

    public function getCharacterId(): int {
        return $this->character_id;
    }

    public function getStartDate(): string {
        return $this->start_date;
    }

    public function getSaveDate(): string {
        return $this->save_date;
    }

}