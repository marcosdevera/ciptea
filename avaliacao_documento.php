<?php 
    include_once ("classes/documentos.class.php");
    include_once('classes/obs.class.php');
    include_once("sessao.php");

    $d = new Documentos();

    $cod_pessoa_decode = urldecode($_GET['cod']);
    $cod_pessoa = base64_decode($cod_pessoa_decode);
    $identificacao = $d->exibirDocumentos($cod_pessoa);
    $nome_pessoa = $identificacao->fetch(PDO::FETCH_ASSOC);
    $doc = $d->exibirDocumentos($cod_pessoa);

    $obs = new Obs();
    $result_obs = $obs->exibirobs($cod_pessoa);
    $num_linha = $result_obs->rowCount(); 
?>
    <!doctype html>
    <html>
        <head>
            <meta charset="utf-8">
            <title>Avaliação de documentos</title>
            <!-- Bootstrap e dependências -->
            <link rel="stylesheet" href="css/bootstrap.min.css">
            <link rel="stylesheet" href="css/formValidation.css">
            <link rel="stylesheet" href="css/loading.css">
            <link rel="stylesheet" href="css/bootstrap-combobox.css">
            <link href="https://gitcdn.github.io/bootstrap-toggle/2.2.2/css/bootstrap-toggle.min.css" rel="stylesheet">
			<script src="jquery-1.3.2.min.js" type="text/javascript"></script>  
			<!-- <script type="text/javascript">
				$(document).ready(function(){
				
                    
					$(':checkbox').change(function() {

						var cod_status = this.checked ? '1' : '0';
						var cod_documento = $(this).attr("data-id");	
						$.post("update_status_doc.php", {"cod_status": cod_status, "cod_documento": cod_documento}, 
						function(data) {
                            
							if (data == "0"){
								alert("Data de vigência não pode ser menor do que data atual.");
							}	
														
						});
						
					})

				});
			</script> -->
        </head>
        <body>
            <div class="container">
                <div class="row">
                    <div class="col-sm-10">
                        <h2>ABA DE VALIDAÇÃO</h2>
                        <h4>Requerente: <?php echo $nome_pessoa['vch_nome'] ?></h4>
                        <h4>CPF: <?php echo $nome_pessoa['vch_cpf'] ?></h4>
                    </div>
                    <div class="col-sm-2 pull-right">
                        <a href="pessoa_cadastrada.php" class="btn btn-primary pull-right">Voltar</a>
                    </div>
                </div>
                <table class="table">
                    <tbody>
                        <tr>
                            <?php
                                while($row_documento = $doc->fetch(PDO::FETCH_ASSOC)){ ?>
                                    <tr>
                                        <td style="vertical-align: middle"><?php echo "<a target='_blank' href='ciptea/".$row_documento["vch_documento"]."'><img src='images/document.png' alt='Abrir Documento'></a>"?></td>
                                        <td><h4>Tipo da documentação</h4><?php if($row_documento["cod_tipo_documento"] == 1){echo "Foto de identificação";}else if($row_documento["cod_tipo_documento"] == 2){echo "Laudo médico";}else if($row_documento["cod_tipo_documento"] == 3){echo "Comprovante de residência";}else if($row_documento["cod_tipo_documento"] == 4){echo "Documento com foto";}else{echo "Requerimento";} ?></td>
                                        <td class="text-center"><h4>Data de inserção</h4> <?php echo $row_documento["sdt_insercao"] != "" ? date("d/m/Y", strtotime($row_documento["sdt_insercao"])) : ""?> </td>
                                        <td class="text-center"><h4>Status</h4> <strong><?php if($row_documento["status"] == 0){echo "Aguardando validação";}else{echo "Aprovado"; } ?></strong></td>
                                        <td class="text-center"><h4>Validar</h4>
                                            <form action="processamento/processar_usuario.php" method="POST">
                                                <input type="hidden" name="MM_action" id="MM_action" value="2">
                                                <input type="hidden" name="cod_pessoa" value="<?php echo $row_documento['cod_pessoa']; ?>">
                                                <input type="hidden" name="cod_tipo_documento" value="<?php echo $row_documento['cod_tipo_documento']; ?>">
                                                <input type="hidden" name="status" value="<?php if($row_documento["status"] == 0){ echo "1"; }else{echo "0";}  ?>">
                                                <input type="submit"  <?php if($row_documento["status"] == 0){ echo "class='btn btn-primary'"; }else{echo "class='btn btn-success'";} ?> value="Confirmar Validação">
                                            </form>
                                        </td>
                                    </tr>
                                <?php } 
                            ?>
                        </tr>
                    </tbody>
                </table>
                <tr>
                    <label for="obs_old">Observações enviadas:</label>
                    <textarea name="obs_old" id="obs_old" cols="30" rows="8" class="form-control"><?php if($num_linha > 0){ 
                            $count = "";
                            while($row_obs = $result_obs->fetch(PDO::FETCH_ASSOC)) {
                                $count++;
                                echo date("d/m/Y", strtotime($row_obs["sdt_criacao"])). " - - " . $row_obs["obs"] . "\n";
                            }    
                        } ?>
                    </textarea>
                </tr>
                <tr>
                    <form action="processamento/processar_usuario.php" method="POST">
                        <input type="hidden" name="MM_action" id="MM_action" value = "3">
                        <input type="hidden" name="cod_pessoa" id="cod_pessoa" value="<?php echo $cod_pessoa ?>">
                        <label for="obs">Novas observações:</label>
                        <textarea name="obs" id="obs" cols="30" rows="10" class="form-control"></textarea>
                        <button type="submit" class="btn btn-primary" style="margin-top:5px">Enviar observação</button>
                    </form>
                </tr>
            </div>

            <!-- Modal  -->
            <div id="myModal" class="modal fade" role="dialog">
                <div class="modal-dialog">

                    <!-- Modal content-->
                    <div class="modal-content">
                    </div>

                </div>
            </div>
            <!-- Final Modal inserir--> 
            <!-- Scripts Extras -->
    <?php include("scripts.php"); ?>
    <script src="https://gitcdn.github.io/bootstrap-toggle/2.2.2/js/bootstrap-toggle.min.js"></script>
    <script>

    </script>
    </body>
</html>