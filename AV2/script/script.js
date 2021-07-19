//Escrever na div de exibição 'divShow'
function writteOnDiv(content) {
  const divShow = document.getElementById("show");
  divShow.innerHTML = content;
}

function isNumeric(obj) {
  return obj - parseFloat(obj) >= 0;
}

function validaEntradas(obj) {
  function focus(key) {
    document.querySelector("[name='" + key + "']").style.background = "tomato";
    document.querySelector("[name='" + key + "']").focus();
  }
  for (const [key, value] of Object.entries(obj)) {
    if (key == "cod_barras") {
      if (
        !isNumeric(value) ||
        value == "" ||
        value.toString().length < 12 ||
        value.toString().length > 13
      ) {
        focus(key);
        return false;
      }
    } else {
      if (key == "nome") {
        if (
          isNumeric(value) ||
          value == "" ||
          value.length < 5 ||
          value.length > 60
        ) {
          focus(key);
          return false;
        }
      } else {
        if (key == "fabricante") {
          if (isNumeric(value) || value == "" || value.length > 20) {
            focus(key);
            return false;
          }
        } else {
          if (key == "categoria") {
            if (isNumeric(value) || value == "" || value.length > 20) {
              focus(key);
              return false;
            }
          } else {
            if (key == "tipo_prod") {
              if (isNumeric(value) || value == "" || value.length > 20) {
                focus(key);
                return false;
              }
            } else {
              if (key == "preco") {
                if (!isNumeric(value) || value <= 0 || value == "") {
                  focus(key);
                  return false;
                }
              } else {
                if (key == "quant") {
                  if (!isNumeric(value) || value < 0 || value == "") {
                    focus(key);
                    return false;
                  }
                } else {
                  if (key == "peso") {
                    if (!isNumeric(value) || value <= 0 || value == "") {
                      focus(key);
                      return false;
                    }
                  } else {
                    if (key == "descricao") {
                      if (
                        value == "" ||
                        value.length > 700 ||
                        value.length <= 0
                      ) {
                        focus(key);
                        return false;
                      }
                    } else {
                      if (key == "link_img") {
                        //VERIFICAR DEPOIS
                        if (value == "") {
                          focus(key);
                          return false;
                        }
                      }
                    }
                  }
                }
              }
            }
          }
        }
      }
    }
  }
  //Se chegou até aqui, todas as entradas são válidas.
  return true;
}

//Inserir
function inserir() {
  let day = new Date();
  let date =
    day.getFullYear() +
    "-" +
    ("0" + (day.getMonth() + 1).toString()).slice(-2) +
    "-" +
    ("0" + day.getDate().toString()).slice(-2);

  //Objeto a ser enviado para o backend
  var obj = {
    cod_barras: document.querySelector("[name='cod_barras']").value,
    nome: document.querySelector("[name='nome']").value,
    fabricante: document.querySelector("[name='fabricante']").value,
    categoria: document.querySelector("[name='categoria']").value,
    tipo_prod: document.querySelector("[name='tipo_prod']").value,
    preco: document.querySelector("[name='preco']").value,
    quant: document.querySelector("[name='quant']").value,
    peso: document.querySelector("[name='peso']").value,
    descricao: document.querySelector("[name='descricao']").value,
    data: date,
    status: document.querySelector("[name='status']").checked,
  };

  //Verificando se os valores do objeto são válidos
  if (validaEntradas(obj)) {
    let xhttp = new XMLHttpRequest();
    xhttp.onreadystatechange = function () {
      if (this.readyState == 4 && this.status == 201) {
        alert("Inserido com sucesso!");
      } else {
        if (this.readyState == 4 && this.status != 201) {
          alert("Erro interno ao inserir!");
        }
      }
    };
    xhttp.open("POST", "incluir.php");
    xhttp.send(JSON.stringify(obj));

    //Gerando página do produto
    geraPagina(obj.cod_barras.toString());

    //Exibe o formulário em branco novamente
    exibeForm();
  } else {
    alert("Campo(s) inválido(s)!");
  }
}

function exibeForm() {
  writteOnDiv(
    "<form id='form'><p>Imagem:<br><input type='file' name='inpFile'><br><p>Código de Barras: <input type='text' name='cod_barras' placeholder='7829238208123' maxlength='13' minlength='12' ></p><p>Produto: <input type='text' name='nome' placeholder='Galaxy S20+' maxlength='60' ></p><p>Fabricante: <input type='text' name='fabricante' placeholder='Samsung' maxlength='20' ></p><p>Categoria:<select name='categoria'><option value='op1'>Opcao</option></select></p><p>Tipo de produto:<select name='tipo_prod'><option value='op1'>Opcao</option></select></p><p>Preço: <input type='number' name='preco' placeholder='9.999,99' ></p><p>Quantidade: <input type='number' name='quant' placeholder='10' ></p><p>Peso (g): <input type='number' name='peso' placeholder='1000' ></p><p>Descrição: <textarea name='descricao' rows='4' cols='50' maxlength='700'  style='resize: none;'></textarea></p><p>Status: <input type='checkbox' name='status'><label for='status'>Ativo/Inativo</label></p><button type='button' id='submit' onclick='upload(); inserir();'>Enviar</button></form>"
  );
}

//Buscar
function exibeBuscar() {
  writteOnDiv(
    "<p>Código de Barras: <input type='text' name='cod_barras' placeholder='78292382' maxlength='13' minlength='12' required></p><input type='button' value='Buscar' id='submit' onclick='busca()'>"
  );
}

function busca() {
  let cod_barras = document.querySelector("[name='cod_barras']").value;

  let xhttp = new XMLHttpRequest();
  xhttp.onreadystatechange = function () {
    if (this.readyState == 4 && this.status == 200) {
      writteOnDiv(this.response);
    }
  };
  xhttp.open("POST", "buscar.php");
  xhttp.send(cod_barras);
}

//Listar
function showTable() {
  let xhttp = new XMLHttpRequest();
  xhttp.onreadystatechange = function () {
    if (this.readyState == 4 && this.status == 200) {
      writteOnDiv(this.response);
    }
  };
  xhttp.open("GET", "listar.php");
  xhttp.send();
}

//Deletar - OK
function deletar(id) {
  let xhttp = new XMLHttpRequest();

  if (confirm("Tem certeza que deseja excluir este cadastro?")) {
    xhttp.onreadystatechange = function () {
      if (this.readyState == 4 && this.status == 200) {
        alert("Cadastro excluído!");
      } else {
        if (this.readyState == 4 && this.status == 500) {
          alert("Erro ao excluir cadastro!");
        }
      }
    };
    xhttp.open("DELETE", "excluir.php");
    xhttp.send(id);
    showTable();
  }
}

//Alterar
function alterar(id) {
  let xhttp = new XMLHttpRequest();
  xhttp.onreadystatechange = function () {
    if (this.readyState == 4 && this.status == 200) {
      writteOnDiv(this.response);
    }
  };
  xhttp.open("POST", "alterar.php");
  xhttp.send(id.toString());
}

function enviaAlteracao(id) {
  let day = new Date();
  let date =
    day.getFullYear() +
    "-" +
    ("0" + (day.getMonth() + 1).toString()).slice(-2) +
    "-" +
    ("0" + day.getDate().toString()).slice(-2);

  const obj = {
    id: id,
    cod_barras: document.querySelector("[name='cod_barras']").value,
    nome: document.querySelector("[name='nome']").value,
    fabricante: document.querySelector("[name='fabricante']").value,
    categoria: document.querySelector("[name='categoria']").value,
    tipo_prod: document.querySelector("[name='tipo_prod']").value,
    preco: document.querySelector("[name='preco']").value,
    quant: document.querySelector("[name='quant']").value,
    peso: document.querySelector("[name='peso']").value,
    descricao: document.querySelector("[name='descricao']").value,
    data: date,
    status: document.querySelector("[name='status']").checked,
  };

  const xhr = new XMLHttpRequest();

  xhr.onreadystatechange = function () {
    if (this.readyState == 4 && this.status == 200) {
      alert("Item alterado com sucesso!");
    }
  };

  xhr.open("PUT", "alterar.php");
  xhr.send(JSON.stringify(obj));

  geraPagina(obj.cod_barras);
}

function upload() {
  const inpFile = document.querySelector("[name='inpFile']");
  const cod_barras = document
    .querySelector("[name='cod_barras']")
    .value.toString();

  const xhr = new XMLHttpRequest();
  let formData = new FormData();

  //Preparando formulário com dados do arquivo
  for (let file of inpFile.files) {
    formData.append("myFiles[]", file);
  }

  formData.append("barrCode", cod_barras);

  xhr.open("POST", "upload.php");
  xhr.send(formData);
}

function geraPagina(cod_barras) {
  const xhr = new XMLHttpRequest();

  xhr.open("POST", "geraPagina.php");
  xhr.send(cod_barras.toString());
}
