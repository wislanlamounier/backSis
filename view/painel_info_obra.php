<?php    // print_r($_SESSION['obra']['cliente']);
        if (isset($_SESSION['obra']['dados'])){
        $cliente = $_SESSION['obra']['dados'];
       // print_r($cliente);
       //  echo "<br>".$cliente['nome'];
       //  echo "<br>".$cliente['data_inicio_previsto'];
       //  echo "<br>".$cliente['desc'];
       //  echo "<br>".$cliente['rua'];
       //  echo "<br>".$cliente['num'];
        // echo "<br>".$cliente['telefone_com'];
        }else{
          $cliente['nome']="...";
          $cliente['data_inicio_previsto']="...";
          $cliente['desc']="...";
          $cliente['rua']="...";
          $cliente['num']="...";
          $cliente['telefone_com']="...";
        }
        
?>
<div class="painel-controle">
      <div class="title-box" style="float:left;width:100%"><div style="float:left"><img src="../images/info.png" width="35px" style="margin-left:5px;"></div><div style="float:left; margin-top:10px; margin-left:10px; "><span style="width:120px" class="title">Informações Obra</span></div></div>
      <div class="colum">
        <div style="width:100%;"><span style="color: #676767;">Dados da obra</span></div>
        <table>
          <tr colspan="2"></tr>
          <tr ><td><span style="font-size:18px;">Nome</span></td><td><span type="text" id="nome" ><?php echo $cliente['nome']?></span></td></tr>
          <tr ><td><span style="font-size:18px;">Data de Inicio</span></td><td><span type="text" id="data_inicio_previsto" ><?php echo $cliente['data_inicio_previsto']?></span></td></tr>
          <tr ><td><span style="font-size:18px;">Rua:</span></td><td><span type="text" id="rua" ><?php echo $cliente['rua']?><span style="font-size:18px;">,</span></span><span ><?php echo $cliente['num']?></span></td></tr>
          <tr ><td><span style="font-size:18px;">Descricao</span></td><td><textarea  readonly type="text" id="telefone_com" ><?php echo $cliente['desc']?></textarea></td></tr>
        </table>



        <!-- 
        <div class="descricao"><span style="font-size:18px;">Nome: </span></div> <div class="descricao"><span type="text" id="nome" ><?php echo $cliente['nome']?></span></div>
        <div class="descricao"><span style="font-size:18px;">Data de Início: </span></div> <div class="descricao"><span type="text" id="data_inicio_previsto" ><?php echo $cliente['data_inicio_previsto']?></span></div>
        <div class="descricao"><span style="font-size:18px;">Rua: </span></div> <div class="descricao"><span type="text" id="rua" ><?php echo $cliente['rua']?><span style="font-size:18px;"> Nº: </span></span><span ><?php echo $cliente['num']?></span></div>
        <div class="descricao"><span style="font-size:18px;">Descrição: </span></div> <div class="descricao"><textarea style="width: 100%; margin: 0px 0px 30px; height: 350%; font-size: 15px; background-color: rgba(100,100,100,0.0);" readonly type="text" id="telefone_com" ><?php echo $cliente['desc']?></textarea></div> -->
        
      </div>

</div>