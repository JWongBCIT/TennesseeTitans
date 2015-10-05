<?php

/* This class repersents a team in the league */

class Team {

    function __construct($name, $div, $key) {
        $this->teamName = $name;
        $this->div = $div;
        $this->key = $key;
    }

    public $key = "";
    public $teamName = "";
    public $div = "";

    
    
}

/**
 * This is the league model. It repersents all the teams in the leaque 
 * with affiliated info.
 *
 * @author adamh
 */
class Leagues extends CI_Model {

    //constructor (a good practice)
    function __construct() {
        parent::__construct();
    }

    /* Creates the mock data for this model since there is no data base at this
     * time. 
     * @return It returns the array of Team objects for all the teams in the 
     * league.
     */

    function mockData() {
        $teams = array();
        $teamKeys = array(
            "ARI",
            "ATL",
            "BAL",
            "BUF",
            "CAR",
            "CHI",
            "CIN",
            "CLE",
            "DAL",
            "DEN",
            "DET",
            "GB",
            "HOU",
            "IND",
            "JAC",
            "KC",
            "MIA",
            "MIN",
            "NE",
            "NO",
            "NYG",
            "NYJ",
            "OAK",
            "PHI",
            "PIT",
            "SD",
            "SF",
            "STL",
            "SEA",
            "TB",
            "TEN",
            "WAS"
        );

        $teamNames = array(
            "Arizona Cardinals",
            "Atlanta Falcons",
            "Baltimore Ravens",
            "Buffalo Bills",
            "Carolina Panthers",
            "Chicago Bears",
            "Cincinnati Bengals",
            "Cleveland Browns",
            "Dallas Cowboys",
            "Denver Broncos",
            "Detroit Lions",
            "GreenBay Packers",
            "Houston Texans",
            "Indianapolis Colts",
            "Jacksonville Jaguars",
            "KansasCity Chiefs",
            "Miami Dolphins",
            "Minnesota Vikings",
            "NewEngland Patriots",
            "NewOrleans Saints",
            "NewYork Giants",
            "NewYork Jets",
            "Oakland Raiders",
            "Philadelphia Eagles",
            "Pittsburgh Steelers",
            "SanDiego Chargers",
            "SanFrancisco 49ers",
            "Seattle Seahawks",
            "StLouis Rams",
            "TampaBay Buccaneers",
            "Tennessee Titans",
            "Washington Redskins");
        
        $divs = array(
            "NCW",
            "NCS",
            "ACN",
            "ACE",
            "NCS",
            "NCN",
            "ACN",
            "ACN",
            "NCE",
            "ACW",
            "NCN",
            "NCN",
            "ACS",
            "ACS",
            "ACS",
            "ACW",
            "ACE",
            "NCN",
            "ACE",
            "NCS",
            "NCE",
            "ACE",
            "ACW",
            "NCE",
            "ACN",
            "ACW",
            "NCW",
            "NCW",
            "NCW",
            "NCS",
            "ACS",
            "NCE"
        );


        $leagueSize = count($teamNames);
        for ($i = 0; $i < $leagueSize; $i++) {
            $temp = new Team($teamNames[$i], $divs[$i], $teamKeys[$i]);
            array_push($teams, $temp);
        }
        return $teams;
    }
    
    /*
     * Function gets all the teams from the mockData method. This is where 
     * it will get all of them from the database.
     * @return This  function returns an array of team objects from the 
     * mockData function.
     */
    function all() {
        //return mockData();
    }

}
