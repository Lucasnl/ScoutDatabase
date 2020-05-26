 
#    <h1><center>  <em> Scout Database</em> </center></h1>

# Como Funciona ?

- Uma simples aplicação que utiliza a Api Wrapper https://github.com/dolejska-daniel/riot-api do League of Legends
    para salvar algumas informações do jogadores no banco de dados
- É colocado o nome do jogador e o nome que ele utiliza no jogo , a comunicação com a api é feita e se o nome de jogador existir ele é   salvo no banco de dados com todas suas informações , e que informações são essas ? - Continua

# Informações Salvas no Banco de dados 

 - profileIconID : o Id do icone que o jogador esta usando para ser mostrado na consulta
 - summonerID : O id de invocador do jogador ele é unico por região
 - summonerName :O nome de invocador que foi buscado (se ele não for encontrado pela api é claro que ele não é salvo e o usuário recebe um erro)
 -accountID : o id da conta do jogador , também é unico por região
 -player: é o nome real do jogador(é apenas um Post , não vem da Api)  que é obrigatório ao cadastrar o summonerName
 -puuid : é o id da conta  , ele é unico globalmente (é o id dos Ids)
 -region : região da onde a conta vem (por enquanto está setado padrão brasil)
 
<img src ="https://i.imgur.com/wtiCorw.png" />



# Segue o Video exemplificando o funcionamento

* Por causa dos Rate Limits  não é possivel mostrar todos os usuarios cadastrados 
* Os dados mostrados na consulta por enquanto é apenas o Elo , Pontos de Liga , Vitorias , Derrotas e o icone de perfil que a conta está usando  
* Todos esses dados da consulta são carregados a partir do summonnerId,accountId ou puuid salvos no banco de dados 
* O ideal seria salvar esses dados da consulta diretamente no BD para assim facilitar o carregamento e não ter tantos problemas com os rate limits , talvez nas próximas atualizações.


<img src ="https://i.ibb.co/thr6HPN/ezgif-2-43942f760c0d.gif" />
