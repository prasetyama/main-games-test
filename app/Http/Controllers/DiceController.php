<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class DiceController extends Controller
{
    public function index(){
        $numPlayers = 4; 
        $numDice = 3; 

        $this->playGame($numPlayers, $numDice);
    }

    public function playGame($numPlayers, $numDice){
        $players = [];
        $points = [];
        
        for ($i = 0; $i < $numPlayers; $i++) {
            $players[] = $numDice;
            $points[] = 0;
        }
        
        while (count(array_filter($players)) > 1) {
            for ($i = 0; $i < $numPlayers; $i++) {
                if ($players[$i] > 0) {
                    $roll = $this->rollDice();
                    echo "Player " . ($i + 1) . " rolled a $roll.";
                    echo "<br>";
                    
                    if ($roll == 6) {
                        $players[$i]--;
                        $points[$i]++;
                    } elseif ($roll == 1) {
                        $players[$i]--;
                        $nextPlayer = ($i + 1) % $numPlayers;
                        $players[$nextPlayer]++;
                    }
                }
            }
        }
        
        $winner = array_search(max($points), $points) + 1;
        echo "Player $winner wins with " . max($points) . " points!";
        echo "<br>";
    }

    public function rollDice(){
        return rand(1, 6);
    }
}
