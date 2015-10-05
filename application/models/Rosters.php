<?php

/**
 * This is the roster model.
 *
 * @author adamh
 */
/* This class represents a player on the team */

class Player {

    public $name = array();
    public $num = array();
    public $pos = array();

    function __construct($nameArr, $numArr, $posArr) {
        $this->name = $nameArr;
        $this->num = $numArr;
        $this->pos = $posArr;
    }

}

class Rosters extends CI_Model {

    //constructor (a good practice)
    function __construct() {
        parent::__construct();
    }

    /* Creates mock data of each player */

    function mockData() {
        $players = array();
        $playerNames = array(
            "Antonio Andrews",
            "David Bass",
            "Byron Bell",
            "Angelo Blackson",
            "Beau Brinkley",
            "Zach Brown",
            "Jurrell Casey",
            "Chase Coffman",
            "Perrish Cox",
            "Harry Douglas",
            "Anthony Fasano",
            "Jalston Fowler",
            "Andy Gallik",
            "Dorial Green-Beckham",
            "Michael Griffin",
            "Sammie Hill",
            "Marqueston Huff",
            "Justin Hunter",
            "Steven Johnson",
            "QaQuan Jones",
            "Brett Kern",
            "Karl Klug",
            "Taylor Lewan",
            "Marcus Mariota",
            "Mike Martin",
            "Dexter McCluster",
            "Jason McCourty",
            "Jamon Meredith",
            "Zach Mettenberger",
            "Derrick Morgan",
            "Deiontrex Mount",
            "Brian Orakpo",
            "Ropati Pitoitua",
            "Jeremiah Poutasi",
            "Cody Riggs",
            "Bishop Sankey",
            "Brian Schwenke",
            "Da'Narris Searcy",
            "Coty Sensabaugh",
            "Quinton Spain",
            "Daimion Stafford",
            "Craig Stevens",
            "Ryan Succop",
            "Phillip Supernaw",
            "Delanie Walker",
            "Chance Warmack",
            "Terrance West",
            "Charlie Whitehurst",
            "Avery Williamson",
            "Al Woods",
            "Wesley Woodyard",
            "Blidi Wreh-Wilson",
            "Kendall Wright"
        );

        $playerNumbers = array(
            26,
            51,
            76,
            95,
            48,
            55,
            99,
            85,
            29,
            83,
            80,
            45,
            69,
            17,
            33,
            94,
            28,
            15,
            52,
            90,
            6,
            97,
            77,
            8,
            93,
            22,
            30,
            79,
            7,
            91,
            53,
            98,
            92,
            72,
            37,
            20,
            62,
            21,
            24,
            60,
            39,
            88,
            4,
            89,
            82,
            70,
            35,
            12,
            54,
            96,
            59,
            25,
            13
        );

        $playerPositions = array(
            "RB",
            "LB",
            "T",
            "DT",
            "LS",
            "LB",
            "DT",
            "TE",
            "CB",
            "WR",
            "TE",
            "FB",
            "C",
            "WR",
            "S",
            "NT",
            "DB",
            "WR",
            "MLB",
            "DL",
            "P",
            "DL",
            "P",
            "DL",
            "T",
            "QB",
            "DL",
            "RB",
            "CB",
            "T",
            "QB",
            "OLB",
            "OLB",
            "OLB",
            "DE",
            "T",
            "RB",
            "C",
            "S",
            "CB",
            "G",
            "S",
            "TE",
            "K",
            "TE",
            "TE",
            "G",
            "RB",
            "QB",
            "LB",
            "DL",
            "LB",
            "CB",
            "WR"
        );

        //Creates an array of players
        $rosterSize = count($playerNames);
        for ($i = 0; $i < $rosterSize; $i++) {
            $temp = new Player($playerNames[$i], $playerNumbers[$i], $playerPositions[$i]);
            array_push($players, $temp);
        }
        return $players;
    }

    /* Returns all players on the team including name, number and position */

    function all() {
        return $this->mockData();
    }

}
