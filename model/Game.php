<?php

class Game{

    // Properties
    protected int $game_id;
    protected int $board_id;
    protected int $character_id;
    protected string $start_date;
    protected string $save_date;

    // Constructor
    public function __construct(int $game_id, int $board_id, int $character_id, string $start_date = null, string $save_date = null )
    {
        $this->game_id = $game_id;      
        $this->board_id = $board_id; 
        $this->character_id = $character_id; 
        if ( $this->start_date ===  null){
            $this->start_date = date('Y-m-d') ;
        } else{
            $this->start_date = $start_date;
        }
        if ( $this->save_date ===  null){
            $this->save_date = date('Y-m-d') ;
        } else{
            $this->save_date = $save_date;
        }  
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