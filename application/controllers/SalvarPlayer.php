<?php
defined('BASEPATH') OR exit('No direct script access allowed');

 // INICIANDO A API
require_once __DIR__  . "/vendor/autoload.php"; 

use RiotAPI\LeagueAPI\LeagueAPI;
use RiotAPI\LeagueAPI\Definitions\Region;

use RiotAPI\DataDragonAPI\DataDragonAPI;

class SalvarPlayer extends CI_Controller {
	//VARIAVEL $dados é o que vai dar o get dos dados no nosso banco
	//VARIAVEL $api faz parte da inicialização da api que utilizamos , desse jeito inicializamos ela apenas uma vez e podemos usar em todas as functions
	public $dados;
	var $api;



	public function __construct() {
		parent::__construct(); 
  
  
  //Essa são as opções de inicialização da api , elas podem ser encontradas aqui https://github.com/dolejska-daniel/riot-api/wiki/LeagueAPI%3A-How-to-begin
  // Aqui por enquanto é o unico lugar que setamos a Key para usarmos em todo site
    $this->api= new LeagueAPI([
		  
		   LeagueAPI::SET_KEY    => 'SUA CHAVE API DA RIOT ',

		   LeagueAPI::SET_REGION => Region::BRASIL,
		   LeagueAPI::SET_VERIFY_SSL =>false ,
		
		    DataDragonAPI::initByVersion('9.24.2'),

                  LeagueAPI::SET_CACHE_CALLS => true,
                  LeagueAPI::SET_CACHE_CALLS_LENGTH => 360,
		
		
		]);
		
		$this->load->library('form_validation');
		$this->load->library('session');
		$this->load->helper('form');
                $this->load->model('PlayerModel');
                $this->dados = new PlayerModel;
  
	 }



	public function index()
	{

//index.php é nossa pagina inicial , ela carrega o header e o index.php
		$this->load->view('header');
		$this->load->view('index');
	}



	public function saveSummoner(){
 
     // Função para salvar o player e o nome de invocador dele
   
      //apenas inciando a variavel que foi declarada la em cima
		$api=$this->api;
		
		
		
		

		
		 // PEGANDO O POST DO PLAYER PRA SER SALVO
			$sumName = $this->input->post('savePlayer');
			
			//A VARIAVEL QUERY É A NOSSA CONSULTA AO BANCO DE DADOS PARA VERIFICAR SE JA EXISTE UM "SUMMONERNAME" IGUAL AO QUE FOI SALVO.
	           $query = null;
		   $query = $this->db->get_where('cadastro', array(//making selection
                    'summonerName' => $sumName));
			
		 //A VARIAVEL COUNT VAI  CHECAR SE EXISTE O NOME NO BANCO DE DADOS ----- EX: SE NUM_ROW FOR IGUAL OU MAIS QUE 1 QUER DIZER QUE O NOME JA EXISTE.	
		   $count = $query->num_rows(); 
		
		 //O TRY  PEGA O PLAYER A SER SALVO E ASSIM VERIFICA SE ELE EXISTE NO BD DA RIOT 
		 //SE O PLAYER EXISTIR NA RIOT ELE SALVA AS INFORMAÇÕES DE ID E NOME NO BANCO DE DADOS  , SE NÃO EXISTIR EXIBE UM ALERT E RETORNA PRA PAGINA INICIAL.
		
		 try {
		
			$getSummoner = $api->getSummonerByName($sumName);
                   
                   //ARRAY COM TODAS INFORMAÇÕES QUE VAMOS SALVAR NO BANCO DE DADOS
                   // NA API DA RIOT  o return  DE getSummonerByName são :
                   /* profileIconId:int	 
                      name:string	
                      puuid:string	
                      summonerLevel:long	
                      revisionDate:long	
                      id:string	
                      accountId:string*/

			$data = array(
				'summonerName' => $getSummoner->name,
				'summonerId'=>$getSummoner->id,
				'accountId'=>$getSummoner->accountId,
                                'player'=>$this->input->post('nomeJogador'),
                                'puuId'=>$getSummoner->puuid,
                                'region'=>'Brasil',
                                'profileIconId'=>$getSummoner->profileIconId
			
				
				
			 
	
			);
			
		//AQUI FAZEMOS A VERIFICAÇÃO DO COUNT , SE FOR IGUAL A 0 QUER DIZER QUE O NOME NÃO EXISTE NO BANCO DE DADOS  , ENTÃO ELE SALVA OS DADOS.				
if ($count === 0) {
			
			//CASO O PLAYER EXISTA NA RIOT UM ALERT É FEITO E OS DADOS SÃO INSERIDOS NO BANCO DE DADOS
			print "<script type=\"text/javascript\">alert('Player $sumName Has been Saved in the Database !' );
			window.location.href = 'http://ideiaesports.com.br/RiotSummoner/'; </script>";
			return $this->db->insert('cadastro', $data);
}

// SE O COUNT FOR IGUAL A 1 , SIGNIFICA QUE O NOME JA EXISTE NO BANCO DE DADOS , ENTÃO ELE RETORNA UMA MENSAGEM DE ERRO.
else {
			print "<script type=\"text/javascript\">alert(' Player $sumName Already Exists in the Database ' );
			window.location.href = 'http://ideiaesports.com.br/RiotSummoner/'; </script>";
			
		}
		
		
		
		}
		
		//CASO O PLAYER NAO EXISTA NA RIOT APENAS UM ALERT INFORMANDO QUE O JOGADOR NAO FOI ENCONTRADO E UM RETURN PRA PAGINA INICIAL

		catch (Exception $e) {
			print "<script type=\"text/javascript\">alert('Jogador $sumName Não Encontrado na Riot !');
			window.location.href = 'http://ideiaesports.com.br/RiotSummoner/'; </script>";
			

		}
		
		



}



public function update() {

				
		    




}









public function consulta() {
	
		
		
				
		    /*

			

 //foreach ($data as $dados) { 
 
 // foreach ($dados as $dado){

 //$accId=$dado->puuId;
 
 //$up=$api->getSummonerByPUUID($dado->puuId);//echo '<pre>' ;
 //$acc=$up->puuid;
  //$d = array(
       
        'summonerName'  => $up->name,
        'summonerId'  => $up->id,
        'profileIconId'  => $up->profileIconId,
        'accountId'  => $up->accountId
        
);

 $this->db->where('puuId', $acc);
 $this->db->update('cadastro', $d);


 }
 }	 */

		


//VARIAVEL DATA QUE PUXA DA MODEL 'PLAYERMODEL'	TODO NOSSO BD PARA FAZERMOS A CONSULTA
$data['data'] = $this->dados->get_dados();


//PEGANDO A VARIAVEL API QUE FOI INICIADA NO CONSTRUCT
$api=$this->api;

//JOGANDO A VARIAVEL API NUM ARRAY E ASSIM CARREGA-LA JUNTO AO HEADER, FAZENDO COM QUE NÃO PRECISEMOS FAZER UM NOVA INICIALIZAÇÃO NA PAGINA CONSULTA.PHP , ISSO NOS PERMITE ALTERAR A CHAVE API SOMENTE AQUI NO CONTROLLER 
$consultaApi['api'] = $api;


 // AQUI CARREGAMOS O HEADER JUNTO COM A VARIAVEL API ,  E A PAGINA CONSULTA.PHP COM A VARIAVEL $DATA PARA CONSEGUIRMOS LISTAR E PERCORRER TODO NOSSO BANCO DE DADOS A FIM DE MOSTRAR O CONTEUDO DO MESMO

		$this->load->view('header',$consultaApi);
		$this->load->view('consulta',$data);
		
	
}
}
