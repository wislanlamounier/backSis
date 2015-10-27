<div class="separador" ><span style="color: #ddd;" class="title">CONFIGURAÇÕES GERAIS</span><input type="button" style="background-color: rgba(000,000,000,0.1); border:0; float:right; color:#cc0000" value="Configurar" onclick="mostraTabela1('config_gerais')" ></div>
<div id="config_gerais" style="float:left; width:100%">    
    <div class="formulario-regiao">        
        <form action="configuracoes">
            <div class="formulario-regiao-titulo">
                <span>Cadastro de Região</span>
            </div>
            <div class="formulario-regiao-dados">
                <span>Código:</span><input type="text" id="codigo" name="codigo">
            </div>
            <div class="formulario-regiao-dados">
                <span>Nome:</span><input type="text" id="nome" name="nome">
            </div>
            <div class="formulario-regiao-dados">
                <span>Estado:</span><input type="text" id="estado" name="estado">
            </div>
            <div class="formulario-regiao-dados">
                <span>Cidade</span><input type="text" id="cidade" name="cidade">
            </div>
            <div class="formulario-regiao-dados">
                <span>Bairro/Zona</span><input type="text" id="bairro-zona" name="bairro-zona">
            </div>
            <div class="formulario-regiao-dados">
                <span>Descrição</span><textarea cols="3" id="desc" width="300px;" name="desc"></textarea>
            </div>
            <div class="formulario-regiao-cadastrar">
                <input class="button" type="submit" id="cadastrar" name="cadastrar" value="Cadastrar">
            </div>
        </form>        
    </div>
    
</div>