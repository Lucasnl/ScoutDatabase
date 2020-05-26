<!-- DIV  PARA SALVAR O JOGADOR NO BD -->
<div class="container">
<H1 class="titleIndex"> Scout Database </h1>

<div class="col-md-12">
                        <form method="POST" action="<?php echo site_url('/SalvarPlayer/saveSummoner/'); ?> " enctype="application/x-www-form-urlencoded">
                           
<div class="formPlayers">



 <div class="form-row">
                                <div class="form-group col-md-12">


                                    <label>Summoner Name</label>
								  
									<input type="text" class="form-control" id="savePlayer" name="savePlayer" placeholder="Ex: paiN Kami" required> <br/>

									

                                </div>


                      
                                <div class="form-group col-md-12">
                                    <label>Player</label>
								  
									<input type="text" class="form-control" id="nomeJogador" name="nomeJogador" placeholder="Ex: Kami" required> <br/>

									<input type="submit" class="btn btn-success" value="Save" />
									
									<a class="btn btn-success ButtonFloat" href="http://ideiaesports.com.br/RiotSummoner/SalvarPlayer/consulta"> Query </a>


                                </div>

                          </div>

                        </form>
</div>


                    </div>
                </div>
            