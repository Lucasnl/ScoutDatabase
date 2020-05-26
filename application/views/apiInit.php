<?php 




use RiotAPI\LeagueAPI\LeagueAPI;
use RiotAPI\LeagueAPI\Definitions\Region;
use RiotAPI\DataDragonAPI\DataDragonAPI;
use Objects\TournamentCodeParameters;
use Objects\SummonerIdParams;
use Objects\TournamentCodeUpdateParameters;
use Objects\ProviderRegistrationParameters;



//  Initialize the library
$api = new LeagueAPI([
    //  Your API key, you can get one at https://developer.riotgames.com
    LeagueAPI::SET_KEY    => 'RGAPI-d3d424c9-4f81-4749-a041-8f501c72957d',
    //  Target region (you can change it during lifetime of the library instance)
    LeagueAPI::SET_REGION => Region::BRASIL,
    LeagueAPI::SET_VERIFY_SSL => false,

   
    DataDragonAPI::initByCdn(),


    LeagueAPI::SET_CACHE_CALLS => true,
    LeagueAPI::SET_CACHE_CALLS_LENGTH => 360,


]);



?>