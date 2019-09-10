
<!doctype html>
<html lang="pt">
  <head>
      <!-- Required meta tags -->
      <meta charset="utf-8">
      <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

      <!-- Bootstrap CSS -->
      <link rel="stylesheet" href="../node_modules/bootstrap/compiler/bootstrap.css">
      <link rel="stylesheet" href="../node_modules/bootstrap/compiler/style.css">

      <!-- Font Awesome -->
      <link rel="stylesheet" href="../node_modules/font-awesome/css/font-awesome.min.css">

      <!-- Meus estilos -->
      <link rel="stylesheet" href="../css/pagina.css">

      <title>Entrada</title>
  </head>


  <body>
    <div class="barra">
      <div class="ba">
        <label  ><i class="fa fa-bar-chart"></i> Me Organiza</label>
      </div>
      <div class="right">
        <a href="#" ><i class="fa fa-cog"></i></a>
        <a href="projetoLogin.html" ><i class="fa fa-close"></i></a>
      </div>
    </div>
    <a href="../despesas_fixas" class="tablink" >Despesas</a>
    <a href="../resumo" class="tablink">Resumo</a>
    <a href="" class="tablink" style="background-color: #8FBC8F" >Entrada</a>

    <div id="Entrada">
      <form  style="width: 90%;background-color: white;margin: 0 auto;">
        <table class="table table-bordered table-dark" >
          <thead class="thead-dark">
            <tr class="header">
              <th style="width:10%;">Data</th>
              <th style="width:50%;">Descrição</th>
              <th style="width:20%;">Tipo de entrada</th>
              <th style="width:10%;">Valor</th>
              <th style="width:10%;"></th>
            </tr>
          </thead>
            <tr>
            	<td><input name="data" onkeypress="mascaraData(this)" required maxlength="10" style="width:100%; margin-top: 3px;border: 3px;"></input></td>
            	<td><input name="descricao" required style="width:100%; margin-top: 3px;border: 3px;"></input></td>
        		  <td>
                <select name="tipo-entrada" style="border-radius: 5px;height: 30px;">
                  <option selected value="Cartão de Débito">Cartão Débito</option>
                  <option value="Cartão de Crédito">Cartão de Crédito</option>
              		<option value="Espécie">Espécie</option>
              		<option value="Boleto">Boleto</option>
              		<option value="Promissória">Promissória</option>
                </select>
              </td>
            
             	<td><input name="valor" required style="width:100%; margin-top: 3px;border: 3px;"></input></td>
              <td><button class="btn btn-success" type="submit" >Adicionar</button></td>
            </tr>
          </table>
        </form>
        <!-- Máscara para data -->
        <script> 
          function mascaraData(val) {
            var pass = val.value;
            var expr = /[0123456789]/;

            for (i = 0; i < pass.length; i++) {
                // charAt -> retorna o caractere posicionado no índice especificado
                var lchar = val.value.charAt(i);
                var nchar = val.value.charAt(i + 1);

                if (i == 0) {
                // search -> retorna um valor inteiro, indicando a posição do inicio da primeira
                // ocorrência de expReg dentro de instStr. Se nenhuma ocorrencia for encontrada o método retornara -1
                // instStr.search(expReg);
                if ((lchar.search(expr) != 0) || (lchar > 3)) {
                    val.value = "";
                }

                } else if (i == 1) {

                if (lchar.search(expr) != 0) {
                    // substring(indice1,indice2)
                    // indice1, indice2 -> será usado para delimitar a string
                    var tst1 = val.value.substring(0, (i));
                    val.value = tst1;
                    continue;
                }

                if ((nchar != '/') && (nchar != '')) {
                    var tst1 = val.value.substring(0, (i) + 1);

                    if (nchar.search(expr) != 0)
                    var tst2 = val.value.substring(i + 2, pass.length);
                    else
                    var tst2 = val.value.substring(i + 1, pass.length);

                    val.value = tst1 + '/' + tst2;
                }

                } else if (i == 4) {

                if (lchar.search(expr) != 0) {
                    var tst1 = val.value.substring(0, (i));
                    val.value = tst1;
                    continue;
                }

                if ((nchar != '/') && (nchar != '')) {
                    var tst1 = val.value.substring(0, (i) + 1);

                    if (nchar.search(expr) != 0)
                    var tst2 = val.value.substring(i + 2, pass.length);
                    else
                    var tst2 = val.value.substring(i + 1, pass.length);

                    val.value = tst1 + '/' + tst2;
                }
                }

                if (i >= 6) {
                if (lchar.search(expr) != 0) {
                    var tst1 = val.value.substring(0, (i));
                    val.value = tst1;
                }
                }
            }

            if (pass.length > 10)
                val.value = val.value.substring(0, 10);
            return true;
        }
    </script>
    </div>
  </body>
</html>