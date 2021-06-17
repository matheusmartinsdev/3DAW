<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>

    <script>
        //Listando as UF's
        function callUF() {
            //Requisitando à API do IBGE a lista das UF's do Brasil
            let listUF = new XMLHttpRequest();
            
            listUF.onreadystatechange = function() {
                if ( (this.readyState == 4) && (this.status == 200) ) {
                    //Transformando o JSON recebido em um Objeto JavaScript
                    var obj = JSON.parse(this.responseText);

				    //Buscando informações relevantes no objeto criado acima
                    for (i=0;obj[i];i++) {
                        //Dentro deste FOR está sendo criado elementos OPTIONS dentro da tag SELECT
                        //Contendo as siglas das UF's presentes no objeto recebido da API do IBGE.
                        var element = document.createElement("OPTION");
                        element.setAttribute("value", obj[i].sigla);
                        var sigla = document.createTextNode(obj[i].sigla);
                        element.appendChild(sigla);
                        document.getElementById("state").appendChild(element);
                    }
                }
            }
            listUF.open("GET", "https://servicodados.ibge.gov.br/api/v1/localidades/estados");
            listUF.send();
        }

        //Selecionando UF 
        function callCity (UF) {
            //Removendo as cidades anteriores
            removeCities();

            //Recebendo a lista de municípios de uma determinada UF
            let listCities = new XMLHttpRequest();
            listCities.onreadystatechange = function() {
                if ( (this.readyState == 4) && (this.status == 200) ) {
                    let obj = JSON.parse(this.responseText);
                    for (i=0;obj[i];i++) {
                        let element = document.createElement("OPTION");
                        let city = document.createTextNode(obj[i].nome);
                        let div = document.getElementById("city");
                        element.appendChild(city);
                        div.appendChild(element);
                    }
                }
            }
            listCities.open("GET", "https://servicodados.ibge.gov.br/api/v1/localidades/estados/"+UF+"/municipios");
            listCities.send();
        } 

        //Função para zerar a lista de cidades carregadas
        function removeCities(){
            let select = document.querySelectorAll("#city > option");
            [].forEach.call(select, function(select){
                select.remove();
            })
        }
    
    </script>
</head>
<body onload="callUF()">
	<h5>Consumindo API do IBGE</h5>
    <form>
        <p> Estado: </p>
        <select id="state" onchange="callCity(this.options[this.selectedIndex].value)"></select>

        <p> Cidade: </p>
        <select id="city"></select>
        <input type="submit" value="Enviar">
    </form>
</body>
</html>