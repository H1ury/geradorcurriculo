<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Gerador de Currículo</title>
    <script type="text/javascript" src="./JS/jquery.js"></script>
    <link rel="stylesheet" href="css/style.css">
</head>

<script>
    document.addEventListener("DOMContentLoaded", function(){
        document.getElementById("startButton").addEventListener("click", function(){
            document.getElementById("formContainer").style.display = "block";
            this.style.display = "none";
            document.querySelector("div.Tables").style.justifyContent = "start"; 
        });
    });

    function calcularIdade() {
        const DataNascimento = document.getElementById('DataNascimento').value;
        const nascimento = new Date(DataNascimento);
        const hoje = new Date();
        let idade = hoje.getFullYear() - nascimento.getFullYear();
        const mes = hoje.getMonth() - nascimento.getMonth();
        if (mes < 0 || (mes === 0 && hoje.getDate() < nascimento.getDate())) {
            idade--;
        }
        document.getElementById('idade').value = idade;
    }

    function addcampo(sectionId, label){
        const container = document.getElementById(sectionId);
        
        const campoDiv = document.createElement('div');
        campoDiv.className = 'wrap-input';
        
        const campoLabel = document.createElement('label');
        campoLabel.className = 'label-input';
        campoLabel.innerText = label;

        const campoInput = document.createElement('input');
        campoInput.className = 'input100';
        campoInput.type = 'text'
        campoInput.name = sectionId.slice(0,-6) + '[]';

        campoDiv.appendChild(campoLabel);
        campoDiv.appendChild(campoInput);

        container.appendChild(campoDiv);
    }

    function add2Campos() {
        const container = document.getElementById('AddExperiencia');

        const campos = [
            { name:'experiencia[]', label:'Experiência - Cargo|Empresa'},
            { name: 'descricao_cargo[]', label:'Descrição do Cargo'}
        ];
        
        campos.forEach(campo2 =>{
                const campo2Div = document.createElement('div');
                campo2Div.className = 'wrap-input';
                campo2Div.setAttribute('data-validate', `${campo2.label} é obrigatório!`);

                const input = document.createElement('input');
                input.className = 'input100';
                input.type = 'text';
                input.name = campo2.name;
                input.required = true;

                const labelElement = document.createElement('label');
                labelElement.className = 'label-input';
                labelElement.innerText = campo2.label;

                campo2Div.appendChild(labelElement);
                campo2Div.appendChild(input);

                container.appendChild(campo2Div);
            });
    }

    $(document).ready(function(){
	    $("#pagina2").click(function(){
		    window.location.href = 'gerar_curriculo.php'
	    });
    });
</script>

<body>
    <div class="TableContent">
        <div class="Tables" style="background-color: #fff; overflow-y: scroll;">
            <div>
                <button id="startButton">CLIQUE AQUI PARA INICIAR</button>
            </div>
            <img src="./images/logo_unipar.jpg">
            <form action="gerar_curriculo.php" method="POST" id="formContainer" name="meu_formulario">
                <!-- CAMPO NOME-->
                <div class="wrap-input" id="camposNome">
                    <label class="label-input" for="nome">Nome</label>
                    <input class="input100" id="nome" type="text" required name="nome" data-validate="Este campo é obrigatório.">
                </div>
                <!-- CAMPO DATA NASCIMENTO-->
                <div class="wrap-input">
                    <label class="label-input" for="DataNascimento">Data de Nascimento</label>
                    <input class="input100" id="DataNascimento" name="DataNascimento" type="date" onchange="calcularIdade()" required data-validate="Este campo é obrigatório">
                </div>
                <!--CAMPO IDADE-->
                <div class="wrap-input">
                    <label class="label-input" for="idade">Idade</label>
                    <input class="input100" id="idade" name="idade" readonly value="0">
                </div>
                <!--CAMPO NÚMERO TELEFONE-->
                <div class="wrap-input">
                    <label class="label-input" for="telefone">Telefone</label>
                    <input class="input100" type="text" name="numero" id="telefone" placeholder="(99)99999-9999" style="color: black;">
                </div>
                <!-- CAMPO E-MAIL -->
                <div class="wrap-input">
                    <label class="label-input" for="email">E-mail</label>
                    <input class="input100" type="email" name="email" id="email">
                </div>
                <!-- CAMPO ENDEREÇO -->
                <div class="wrap-input">
                    <label class="label-input" for="endereco">Endereço - Rua|Cidade|Estado</label>
                    <input class="input100" type="text" id="endereco" name="endereco">
                </div>
                <!-- CAMPO DESCRIÇÃO \ OBJETIVO-->
                <div class="wrap-input">
                    <label class="label-input" for="descricao">Descrição | Objetivo</label>
                    <input class="input100" type="text" name="descricao" id="descricao">
                </div>
                <!-- CAMPO EDUCAÇÃO -->
                <div class="CampoEducacao" id="campoEducacao">
                    <div class="wrap-input">
                        <label class="label-input" for="educacao">Educação - Curso|Instituição</label>
                        <input class="input100" type="text" name="educacao[]" id="educacao">
                    </div>
                </div>
                <button id="addEducacao" class="buttonAdicionar" type="button" onclick="addcampo('campoEducacao', 'Educação - Curso|Instituição')">Adicionar Item</button>
                <!-- CAMPO EXPERIÊNCIA -->
                <div id="AddExperiencia">
                    <div class="wrap-input">
                        <label class="label-input" for="experiencia">Experiência - Cargo|Empresa</label>
                        <input class="input100" type="text" name="experiencia[]" id="experiencia">
                    </div>
                    <!-- CAMPO DESCRIÇÃO DO CARGO -->
                    <div class="wrap-input">
                        <label class="label-input" for="descricao_cargo">Descrição do Cargo</label>
                        <input class="input100" type="text" name="descricao_cargo[]" id="descricao_cargo">
                    </div>
                </div>
                <button id="addExperiencia" class="buttonAdicionar" type="button" onclick="add2Campos()">Adicionar Item</button>
                <!-- CAMPO HABILIDADES-->
                <div id="campoHabilidade">
                    <div class="wrap-input">
                        <label class="label-input" for="habilidades">Habilidades</label>
                        <input class="input100" type="text" name="habilidades[]" id="habilidades">
                    </div>
                </div>
                <button id="addHabilidade" class="buttonAdicionar" type="button" onclick="addcampo('campoHabilidade', 'Habilidades')">Adicionar Item</button>
                <!-- BOTAO DE GERAR CURRÍCULO -->
                <button id="pagina2" class="buttonGerarCurriculo" type="submit">Gerar Currículo</button>
            </form>
        </div>
        <!-- SEGUNDO LADO DA PÁGINA -->
        <div class="Tables">
            <span class="tituloGerador">Gerador de <br>Currículo</span>
            <span class="subtiuloGerador">Crie seu currículo totalmente online e automático, apenas incluindo as suas informações</span>
        </div>
    </div>
</body>
</html>
