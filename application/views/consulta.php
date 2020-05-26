<?php 




use RiotAPI\LeagueAPI\LeagueAPI;
use RiotAPI\LeagueAPI\Definitions\Region;
use RiotAPI\DataDragonAPI\DataDragonAPI;











?>
<!-- DIV PRA DAR ESPAÇO DO TOPO E CENTRALIZAR A DIV --> 

<div class="Container Espaco">

<div class = "Conteudo">


<table id="table" class="table table-striped table-bordered responsive" cellspacing="0" width="100%">


  <thead class="thead-dark">
      <tr>
	      


         <th width="5%"> Player</th>
         <th width="5%">SummonerName </th>
         <th width="5%">Elo</th>


  

		  
      </tr>
  </thead>


  <tbody>
  <?php 

      $count = 0;
      $end = 75;
      
      //AQUI TEMOS UM FOREACH QUE PEGA A VARIAVEL $DATA DO NOSSO CONTROLER COM A FINALIDADE DE PERCORRER TODOS RESULTADOS DO NOSSO BANCO DE DADO
   foreach ($data as $dados) { 
   $count++;
  $getDados= $api->getLeagueEntriesForSummoner($dados->summonerId);  
  
  
 
  $profileIcon=$dados->profileIconId;
  
  if ($count == $end) break;
  
   //echo '<pre>';var_dump($getDados]);
   
 
 ?>      

  
     <tr>
	 
	 
	
	
	  <td><?php echo DataDragonAPI::getProfileIcon($profileIcon, [ 'class' => 'rounded', ]); Echo ' '; echo $dados->player; ?></td>
	  <td><?php echo $dados->summonerName; ?></td>
        <td>
        
        <?php   foreach ($getDados as $getAll) {
   
 if ($getAll==NULL) {echo('Unranked');} else {echo $getAll->tier;} echo ' '; if ($getAll->rank==true){echo $getAll->rank;} else {echo "Unranked";}  echo ' - '.$getAll->leaguePoints.' LP';

 echo '<br/>'.$getAll->wins.'W'.' / '.$getAll->losses.'L';
 
 
 }?></td>

	 
	 
	

	 
	 </tr>
	    <?php } ?>
	 </tbody>
	 
	 </table>
	 </div>
	 
	 
	 </div>
	 
	 
	 
	 
	 
	 
	 
	 
	  <!--     <form method="POST" action="<?php echo site_url('/SalvarPlayer/update/'); ?> " enctype="application/x-www-form-urlencoded">

	 
	 <button type='submit'>Update</button>
	 
	 </form> -->
	 
	 
	 
	<!-- AQUI FAZEMOS A INICIALIZAÇÃO DO DATATABLES JUNTAMENTE COM SUA TRADUÇÃO --> 
<script>

$(document).ready(function() {
    $('#table').DataTable({
	
	
	
	
	"order":[[ 0, "asc" ]],  "pageLength": 10,       stateSave: true ,  


		  
		   "bJQueryUI": true,
                "oLanguage": {
                    "sProcessing":   "Processando...",
                    "sLengthMenu":   "Mostrar _MENU_ registros",
                    "sZeroRecords":  "Não foram encontrados resultados",
                    "sInfo":         "Mostrando de _START_ até _END_ de _TOTAL_ registros",
                    "sInfoEmpty":    "Mostrando de 0 até 0 de 0 registros",
                    "sInfoFiltered": "",
                    "sInfoPostFix":  "",
                    "sSearch":       "Buscar:",
                    "sUrl":          "",
                    "oPaginate": {
                        "sFirst":    "Primeiro",
                        "sPrevious": "Anterior",
                        "sNext":     "Seguinte",
                        "sLast":     "Último",
						
                    }
				  
				  
				}
			
        
    } );	  
	  });
	  
	  

	  

  
  
</script>
