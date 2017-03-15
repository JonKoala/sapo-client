function objectFindByKey(array, key, value) {
    for (var i = 0; i < array.length; i++) {
        if (array[i][key] === value) {
            return array[i];
        }
    }
    return null;
}


// 0 Legislativo e 78 Executivo
function seleciona_entidades(tipo){
  if(tipo == 0){
    var inicio =  0;
  }else{
    var inicio = 78;
  }
  for(var i = inicio ; i < inicio+78 ; i++){
    elemento = "#entidades-"+i;
    $(elemento).click();
  }
}


//Selecionar todos os itens
function seleciona_itens(){
  $("#select_itens").children().click();
  console.log("Pronto..");
}




function Hello($scope, $http) {

    $scope.username = "";
    $scope.password = "";
    $scope.perfil = 0;
    $scope.logado = 0;
    $scope.conteudo = "inicio";
    $scope.usuario_id = 0;

    $scope.usuarios = [];
    $scope.logar = function(callback){
      // usuario/luciano/123456
      var username = $("#username").val();
      var password = $("#password").val();
      $scope.url = "usuario/"+username +"/"+password;
      $http.get($scope.url).
      success(function(data) {
          $scope.usuarios = data;
          $.each($scope.usuarios, function(key,objeto){
              if(objeto.usuario == username && objeto.senha == password){
                $scope.username = username;
                $scope.password = password;
                $scope.perfil = objeto.Perfil_id;
                $scope.usuario_id = objeto.id;
                $scope.logado = 1;
              }
          });
          menssagem = "";
          if( $scope.logado == 1){
          }else{
            menssagem = '<div class="alert alert-danger"><strong></strong>Senha ou Usuario incorretos.</div>';
            $("#status").empty();
            $("#status").append(menssagem);
          }
        if (callback) callback();
      });
    }

    $scope.deslogar = function(){
      $scope.username = "";
      $scope.password = "";
      $scope.perfil = 0;
      $scope.logado = 0;
      $scope.conteudo = "inicio";
      $scope.usuario_id = 0;
    }


    $scope.na_indicador = 1;
    $scope.na_nome = "";
    $scope.na_objetivos = "";
    $scope.na_observacoes = "";
    $scope.na_entidades = [];
    $scope.na_itens = [];

    $scope.nova_avaliacao_confirma = function(){

      // Indicador
      $scope.na_indicador = $("#indicador").val();
      // Nome
      $scope.na_nome = $("#nome").val();
      // Objetivos
      $scope.na_objetivos = $("#objetivos").val();
      // Observacoes
      $scope.na_observacoes = $("#observacoes").val();
      // Entidades
      $.each($(".entidades"), function(key,objeto){
        if($(objeto).is(":checked") == true){
          $scope.na_entidades.push($(objeto).val());
        }
      });
      // Itens
      $.each($(".itens"), function(key,objeto){
        if($(objeto).is(":checked") == true){
          $scope.na_itens.push($(objeto).val());
        }
      });
      // data
      var today = new Date();
      var dd = today.getDate();
      var mm = today.getMonth()+1; //January is 0!

      var yyyy = today.getFullYear();
      if(dd<10){
          dd='0'+dd
      }
      if(mm<10){
          mm='0'+mm
      }
      var today = yyyy+'-'+mm+'-'+dd;



      // Variaveis carregadas, hora de criar as tabelas de notas.
      // Primeiro passo criar avaliacao.
      // avaliacao/luciano/123456/1/AvalPostTeste/ObjetivoTeste/2016-01-01/null
      url = ""+"avaliacao"+"/"+$scope.username+"/"+$scope.password+"/"+$scope.na_indicador+"/"+$scope.na_nome+"/"+$scope.na_objetivos+"/"+today;
      $http.post(url).
      success(function(data) {
        // Segundo passo criar ObjetoDeAvaliacao.
        avaliacao_id = data.id;
        console.log(avaliacao_id);
        for(var i = 0 ; i<$scope.na_entidades.length;i++){
          // console.log($scope.na_entidades[i]);
          // POST /objetoavaliacao/@usuario/@senha/@entidade_id/@avaliacao_id/@observacoes=Avaliacoes->postObjetoAvaliacao
          if($scope.na_observacoes.length>1){
            url_objetoavaliacao = ""+"objetoavaliacao"+"/"+$scope.username+"/"+$scope.password+"/"+$scope.na_entidades[i]+"/"+avaliacao_id+"/"+$scope.na_observacoes;
          }else{
            url_objetoavaliacao = ""+"objetoavaliacao"+"/"+$scope.username+"/"+$scope.password+"/"+$scope.na_entidades[i]+"/"+avaliacao_id;
          }
          $http.post(url_objetoavaliacao).
          success(function(data2) {
            objetoavaliacao_id = data2.id;
            // Criar tabela de nota.
            // POST /nota/@usuario/@senha/@usuario_id/@item_id/@objetodeavaliacao_id/@observacoes=Avaliacoes->postNota
            // url_nota = ""+"nota"+"/"+$scope.username+"/"+$scope.password+"/"+$scope.usuario_id+"/"+MUDARR+"/"+objetoavaliacao_id+"/null";
            for(var j = 0 ; j<$scope.na_itens.length;j++){
              url_nota = ""+"nota"+"/"+$scope.username+"/"+$scope.password+"/"+$scope.usuario_id+"/"+$scope.na_itens[j]+"/"+objetoavaliacao_id;
              $http.post(url_nota).
              success(function(data3) {
                console.log("Inseri um item");
              });
              setTimeout(function(){
                $scope.setConteudo("avaliacoes");
              }, 2000);
            }
          });
        }
      });
      // Redirecionar para setConteudo(avaliacoes)



    }

    $scope.avaliacoes = [];
    $scope.indicadores = [];
    $scope.entidades = [];
    $scope.itens = [];
    $scope.avaliando = 0;
    $scope.objetosdeavaliacao = [];
    $scope.avaliando_objeto = 0;
    $scope.notas = [];
    $scope.itensAvaliados = [];
    $scope.pilares = [];

    $scope.setConteudo = function(caminho){
      $scope.conteudo = caminho;
      $("#menu_topo").children().removeClass("active");
      $("#"+caminho).addClass("active");
      // Avaliacoes
      if(caminho == "avaliacoes"){
        url = ""+"avaliacao"+"/"+$scope.username+"/"+$scope.password;
        $http.get(url).
        success(function(data) {
          $scope.avaliacoes = data;
          url2 = ""+"indicador"+"/"+$scope.username+"/"+$scope.password;
          $http.get(url2).
          success(function(data2) {
            $scope.indicadores = data2;
            $.each($scope.avaliacoes, function(key,objeto){
                // objeto.indicador_nome;
                indicador = objectFindByKey($scope.indicadores, "id", objeto.Indicador_id );
                objeto.indicador_nome = indicador.nome;
            });
          });
        });
      }
      // Nova avaliacao
      if(caminho == "nova_avaliacao"){
        // Carrega indicadores
        url = ""+"indicador"+"/"+$scope.username+"/"+$scope.password;
        $("#indicador").empty();
        $http.get(url).
        success(function(data) {
          $scope.indicadores = data;
          $.each($scope.indicadores, function(key,objeto){
                // Preenche Select
                $("#indicador").append("<option value='"+objeto.id+"'>"+objeto.nome+"</option>");
          });
        });
        // Carrega entidades
        url = ""+"entidades"+"/"+$scope.username+"/"+$scope.password;
        $("#select_entidades > .col-md-11").empty();
        $http.get(url).
        success(function(data) {
          $scope.entidades = data;
          $.each($scope.entidades, function(key,objeto){
                // Preenche Select
                check_box_preenchido = '<div class="checkbox"><label for="entidades-'+key+'"><input class="entidades" name="entidades" id="entidades-'+key+'" value="'+objeto.id+'" type="checkbox">'+objeto.nome+' - '+objeto.poder+'</label></div>';
                $("#select_entidades > .col-md-11").append(check_box_preenchido);
          });
        });
        // Carrega Itens
        url = ""+"itens_indicador"+"/"+$scope.username+"/"+$scope.password+"/1";
        $("#select_itens").empty();
        $http.get(url).
        success(function(data) {
          $scope.itens = data;
          $.each($scope.itens, function(key,objeto){
                // Preenche Select
                check_box_preenchido = '<tr><td><input name="itens" class="checkbox_tabela itens" id="itens-'+key+'" value="'+objeto.id+'" type="checkbox"></td><td>'+objeto.nome+'</td><td>'+objeto.exigencia+'</td><td>'+objeto.notaMaxima+'</td></tr>';
                $("#select_itens").append(check_box_preenchido);
          });
          $("#indicador").on("change",function(){
            url = ""+"itens_indicador"+"/"+$scope.username+"/"+$scope.password+"/"+$("#indicador").val();
            $("#select_itens").empty();
            $http.get(url).
            success(function(data) {
              $scope.itens = data;
              $.each($scope.itens, function(key,objeto){
                    // Preenche Select
                    check_box_preenchido = '<tr><td><input name="itens" class="checkbox_tabela itens" id="itens-'+key+'" value="'+objeto.id+'" type="checkbox"></td><td>'+objeto.nome+'</td><td>'+objeto.exigencia+'</td><td>'+objeto.notaMaxima+'</td></tr>';
                    $("#select_itens").append(check_box_preenchido);
              });
              $(".checkbox_tabela").parent().parent().on("click",function(){
                 checkbox = $(this).find(".checkbox_tabela")[0];
                 $(checkbox).click();
              });
            });
          });
          $(".checkbox_tabela").parent().parent().on("click",function(){
             checkbox = $(this).find(".checkbox_tabela")[0];
             $(checkbox).click();
          });
        });

      }

      // Proxima aba
      if(caminho == "avaliando"){

        url = ""+"objetoavaliacao"+"/"+$scope.username+"/"+$scope.password+"/"+$scope.avaliando;
        $http.get(url).
        success(function(data) {
          $scope.objetosdeavaliacao = data;
          url2 = ""+"entidades"+"/"+$scope.username+"/"+$scope.password;
          $http.get(url2).
          success(function(data2) {
            $scope.entidades = data2;
            $.each($scope.objetosdeavaliacao, function(key,objeto){
                entidade = objectFindByKey($scope.entidades, "id", objeto.Entidade_id );
                objeto.entidade_nome = entidade.nome;
                // GET /nota/@usuario/@senha/@objeto_id=Avaliacoes
                url3 = ""+"nota"+"/"+$scope.username+"/"+$scope.password+"/"+objeto.id;
                $http.get(url3).
                success(function(data3) {
                    notas = data3;
                    percent = 0;
                    $.each(notas, function(key,objeto2){
                      if(objeto2.Pontuacao_id != 0){
                        percent = percent + 1;
                      }
                    });
                    novo_status = Math.round((percent/notas.length)*100);
                    objeto.concluido = novo_status+"%";
                });
            });
          });
        });

      }

      // Avaliando nota com accordion
      if(caminho == "avaliando_nota"){
        url = ""+"itemrelacionado"+"/"+$scope.username+"/"+$scope.password+"/"+$scope.avaliando_objeto;
        $http.get(url).
        success(function(data) {
          $scope.itensAvaliados = data;
          var pilares = [];
          var niveis = [];
          var subniveis = [];
          var itens = [];
          var status = 0;

          var qtd = 0;
          $.each($scope.itensAvaliados, function(key,objeto){
            if(objeto.pontuacao_id != 0){
              qtd = qtd + 1;
            }
          });
          status = Math.round(((qtd)/($scope.itensAvaliados.length))*100);
          $(".progress-bar-striped").css("width",status+"%");
          $(".progress-bar-striped").html(status+"%");


          // Preenche pilares
          for (var i = 0; i < $scope.itensAvaliados.length; i++) {
            temp = $scope.itensAvaliados[i];
            if(objectFindByKey(pilares, 'pilar' , temp['pilar']) == null){
              pilares.push({"pilar":temp['pilar'],"niveis":[]});
            }
          }

          // Preenche niveis
          for (var i = 0; i < $scope.itensAvaliados.length; i++) {
            temp = $scope.itensAvaliados[i];
            for (var j = 0; j < pilares.length; j++) {
              temp2 = pilares[j];
              if(temp2.pilar == temp.pilar){
                if(objectFindByKey(temp2.niveis, 'nivel' , temp['nivel']) == null){
                  temp2.niveis.push({"nivel":temp['nivel'],"subniveis":[]});
                  // console.log(temp2);
                }
              }
            }
          }

          for (var i = 0; i < $scope.itensAvaliados.length; i++) {
            temp = $scope.itensAvaliados[i];
            for (var j = 0; j < pilares.length; j++) {
              temp2 = pilares[j];
              for (var k = 0; k < temp2.niveis.length; k++) {
                temp3 = temp2.niveis[k];
                if(temp3.nivel == temp.nivel){
                  if(objectFindByKey(temp3.subniveis, 'subnivel' , temp['subnivel']) == null){
                    temp3.subniveis.push({"subnivel":temp['subnivel'],"itens":[]});
                  }
                }
              }
            }
          }

          for (var i = 0; i < $scope.itensAvaliados.length; i++) {
            temp = $scope.itensAvaliados[i];
            for (var j = 0; j < pilares.length; j++) {
              temp2 = pilares[j];
              for (var k = 0; k < temp2.niveis.length; k++) {
                temp3 = temp2.niveis[k];
                for (var l = 0; l < temp3.subniveis.length; l++) {
                  temp4 = temp3.subniveis[l];
                  if(temp4.subnivel == temp.subnivel){
                      temp5 = temp4.itens;
                      temp5.push(temp);
                  }
                }
              }
            }
          }
          $scope.pilares = pilares;

          setTimeout(function(){
            $(".checkbox_tabela").parent().parent().on("click",function(){
              a = $(this)[0];
              var b = $(a).find("[type=radio]");
              c = $(b)[0];
              c.click();
            });
            // $(a).filter('[value="5"]').attr('checked', true);
            // ProgressBar
            var qtd = 0;
            $.each($scope.itensAvaliados, function(key,objeto){
              if(objeto.pontuacao_id != 0){
                $(".checkbox_tabela[name="+objeto.nota_id+"]").filter("[value='"+objeto.pontuacao_id+"']").attr('checked', true);
                qtd = qtd + 1;
                botao_a_mudar = $(".checkbox_tabela[name="+objeto.nota_id+"]").filter("[value='"+objeto.pontuacao_id+"']").parent().parent().parent().parent().parent().parent().parent().prev();
                $(botao_a_mudar).removeClass("btn-default").addClass("btn-success");
              }
            });

            // Responsavel por fazer a navegacao com tab entretanto esta conflitando com o click do botao.
            // $(".botao_item").on("focus", function(e){
            //     $(this).parent().prev().find("button").click();
            //     $(this).click();
            // });


            $(".botao_item").on("click",
              function(e){
                botao_clicado = $(this);
                div_prox = $(botao_clicado).next();
                nota_id = $(div_prox).attr('name');
                inputs = $(div_prox).find(".checkbox_tabela").filter(":checked").val();
                pontuacao_id = inputs;

                if(pontuacao_id == null){
                  // Nada a ser feito pois nao possui valor
                }else{
                  // PUT /nota/@usuario/@senha/@nota_id/@usuario_id/@pontuacao_id/@dt_avaliacao=Avaliacoes->putNota
                  // data
                  var today = new Date();
                  var dd = today.getDate();
                  var mm = today.getMonth()+1; //January is 0!
                  var yyyy = today.getFullYear();
                  if(dd<10){
                      dd='0'+dd
                  }
                  if(mm<10){
                      mm='0'+mm
                  }
                  var today = yyyy+'-'+mm+'-'+dd;
                  url = ""+"nota"+"/"+$scope.username+"/"+$scope.password+"/"+nota_id+"/"+$scope.usuario_id+"/"+pontuacao_id+"/"+today;
                  $http.put(url).
                  success(function(data) {
                    objeto = objectFindByKey($scope.itensAvaliados, 'nota_id', nota_id);
                    objeto.pontuacao_id = pontuacao_id;
                    qtd = 0;
                    $.each($scope.itensAvaliados, function(key,objeto){
                      if(objeto.pontuacao_id != 0){
                        qtd = qtd + 1;
                        botao_a_mudar = $(".checkbox_tabela[name="+objeto.nota_id+"]").filter("[value='"+objeto.pontuacao_id+"']").parent().parent().parent().parent().parent().parent().parent().prev();
                        $(botao_a_mudar).removeClass("btn-default").addClass("btn-success");
                      }else{
                        botao_a_mudar = $(".checkbox_tabela[name="+objeto.nota_id+"]").filter("[value='"+objeto.pontuacao_id+"']").parent().parent().parent().parent().parent().parent().parent().prev();
                        $(botao_a_mudar).removeClass("btn-success").addClass("btn-default");
                      }
                    });
                    status = Math.round(((qtd)/($scope.itensAvaliados.length))*100);
                    $(".progress-bar-striped").css("width",status+"%");
                    $(".progress-bar-striped").html(status+"%");
                  })

                }
              }
            );


          },2000);
        });
      }

      // Avaliando nota com tree-view
      if(caminho == "avaliando_nota2"){
          $scope.selectedNode = "";
          $scope.showSelected = function(sel) {
               $scope.selectedNode = sel;
               setTimeout(function(){
                 $("select").on("change",function(){
                   // data
                   var today = new Date();
                   var dd = today.getDate();
                   var mm = today.getMonth()+1; //January is 0!
                   var yyyy = today.getFullYear();
                   if(dd<10){
                       dd='0'+dd
                   }
                   if(mm<10){
                       mm='0'+mm
                   }
                   var today = yyyy+'-'+mm+'-'+dd;
                   nota_id = $(this).attr('name');
                   pontuacao_id = $(this).val();
                   url_atualiza = ""+"nota"+"/"+$scope.username+"/"+$scope.password+"/"+nota_id+"/"+$scope.usuario_id+"/"+pontuacao_id+"/"+today;
                   $http.put(url_atualiza).success(function(data_atualiza){
                     console.log("Atualizado");
                   });
                 });
               },100);
           };
          $scope.treeOptions = {
              nodeChildren: "children",
              dirSelectable: false,
              injectClasses: {
                  ul: "a1",
                  li: "a2",
                  liSelected: "a7",
                  iExpanded: "a3",
                  iCollapsed: "a4",
                  iLeaf: "a5",
                  label: "a6",
                  labelSelected: "a8"
              }
          }
          $scope.expandedNodes  = [];

          url = ""+"itemrelacionado"+"/"+$scope.username+"/"+$scope.password+"/"+$scope.avaliando_objeto;
          $http.get(url).
          success(function(data) {
            $scope.itensAvaliados = data;
            var pilares = [];
            var tipos = [];
            var niveis = [];
            var subniveis = [];
            var itens = [];

            var objtemp = $scope.itensAvaliados[0];
            $scope.entidade_avaliada = objtemp.entidade;


            // Preenche pilares
            for (var i = 0; i < $scope.itensAvaliados.length; i++) {
              temp = $scope.itensAvaliados[i];
              if(objectFindByKey(pilares, 'name' , temp['pilar']) == null){
                pilares.push({"name":temp['pilar'],"children":[]});
              }
            }

            // Preenche tipo
            for (var i = 0; i < $scope.itensAvaliados.length; i++) {
              temp = $scope.itensAvaliados[i];
              for (var j = 0; j < pilares.length; j++) {
                temp12 = pilares[j];
                if(temp12.name == temp.pilar){
                  if(objectFindByKey(temp12.children, 'name' , temp['tipo']) == null){
                    temp12.children.push({"name":temp['tipo'],"children":[]});
                  }
                }
              }
            }

            // Preenche niveis
            for (var i = 0; i < $scope.itensAvaliados.length; i++) {
              temp = $scope.itensAvaliados[i];
              for (var j = 0; j < pilares.length; j++) {
                temp12 = pilares[j];
                for (var k = 0; k < temp12.children.length; k++) {
                  temp2 = temp12.children[k];
                  if(temp2.name == temp.tipo){
                    if(objectFindByKey(temp2.children, 'name' , temp['nivel']) == null){
                      temp2.children.push({"name":temp['nivel'],"children":[]});
                      // console.log(temp2);
                    }
                  }
                }
              }
            }

            // Preenche subniveis
            for (var i = 0; i < $scope.itensAvaliados.length; i++) {
              temp = $scope.itensAvaliados[i];
              for (var j = 0; j < pilares.length; j++) {
                temp12 = pilares[j];
                for (var k = 0; k < temp12.children.length; k++) {
                  temp2 = temp12.children[k];
                  for (var l = 0; l < temp2.children.length; l++) {
                    temp3 = temp2.children[l];
                    if(temp3.name == temp.nivel){
                      if(objectFindByKey(temp3.children, 'name' , temp['subnivel']) == null){
                        temp3.children.push({"name":temp['subnivel'],"itens":[]});
                        //console.log(temp3);
                      }
                    }
                  }
                }
              }
            }


            for (var i = 0; i < $scope.itensAvaliados.length; i++) {
              temp = $scope.itensAvaliados[i];
              for (var j = 0; j < pilares.length; j++) {
                temp12 = pilares[j];
                for (var z = 0; z < temp12.children.length; z++) {
                  temp2 = temp12.children[z];
                  for (var k = 0; k < temp2.children.length; k++) {
                    temp3 = temp2.children[k];
                    for (var l = 0; l < temp3.children.length; l++) {
                      temp4 = temp3.children[l];
                      if(temp4.name == temp.subnivel){
                          temp5 = temp4.itens;
                          temp5.push(temp);
                      }
                    }
                  }
                }
              }
            }

            console.log(pilares);
            $scope.dataForTheTree = pilares;
            $scope.expandAll = function(){
              var allNodes = [];
              function addToAllNodes(children) {
                  if (!children || typeof(children) == "array" && children.length == 0) {
                    return;
                  }
                  for (var i = 0; i < children.length; i++) {
                    allNodes.push(children[i]);
                    addToAllNodes(children[i].children);
                  }
              }
              addToAllNodes($scope.dataForTheTree); // Replace $scope.dataForTheTree with yours
              $scope.expandedNodes = allNodes;
            }
            $scope.getColor = function(e){
              if(!(e.itens == undefined)){
                // Filhos
                var status = 0;
                $.each(e.itens,function(key,obj){
                  if(obj.pontuacao_id != 0){
                    status = status + 1;
                  }
                });
                if(status == e.itens.length){
                  return "green";
                }else{
                  return "red";
                }
              }else{
                return "DarkBlue";
              }
            }
        });
      }

      if(caminho == "indicadores"){
        var defaultOption = {nome: 'Selecione', id: 0}
        var pontuacoesIndex = 0;

        $scope.model = {
          indicador: {},
          pilar: {},
          nivel: {},
          subnivel: {},
          pontuacoes: []
        };

        $scope.options = {
          indicadores: [],
          pilares: [],
          niveis: [],
          subniveis: []
        };

        $scope.actions = {
          addPontuacao: function() {
            $scope.model.pontuacoes.push({index:pontuacoesIndex});
            pontuacoesIndex++;
          },

          removePontuacao: function(index) {
            $scope.model.pontuacoes = $scope.model.pontuacoes.filter(function (pontuacao) {return pontuacao.index != index});
          },

          resetModels: function() {
            models = [].concat.apply([], arguments);
            for (model of models)
              $scope.model[model] = {};
          },

          resetOptions: function() {
            options = [].concat.apply([], arguments);
            for (option of options)
              $scope.options[option] = [];
          },

          updateIndicador: function(id) {
            $scope.actions.resetModels('pilar', 'nivel', 'subnivel');
            $scope.actions.resetOptions('pilares', 'niveis', 'subniveis');

            if (id == 0) { return; }

            $http.get('pilar'+'/'+$scope.username+'/'+$scope.password).success(function (result) {
              result = result.filter(function(pilar) {return pilar.Indicador_id === $scope.model.indicador.id});
              result.push(defaultOption);
              $scope.model.pilar = defaultOption;
              $scope.options.pilares = result;
            });
          },

          updatePilar: function(id) {
            $scope.actions.resetModels('nivel', 'subnivel');
            $scope.actions.resetOptions('niveis', 'subniveis');

            if (id == 0) { return; }

            $http.get('nivel'+'/'+$scope.username+'/'+$scope.password).success(function (result) {
              result = result.filter(function(nivel) {return nivel.Pilar_id === $scope.model.pilar.id});
              result.push(defaultOption);
              $scope.model.nivel = defaultOption;
              $scope.options.niveis = result;
            });
          },

          updateNivel: function(id) {
            $scope.actions.resetModels('subnivel');
            $scope.actions.resetOptions('subniveis');

            if (id == 0) { return; }

            $http.get('subnivel'+'/'+$scope.username+'/'+$scope.password).success(function (result) {
              result = result.filter(function(subnivel) {return subnivel.Nivel_id === $scope.model.nivel.id});
              result.push(defaultOption);
              $scope.model.subnivel = defaultOption;
              $scope.options.subniveis = result;
            });
          }
        };

        //loading indicadores
        $http({
            method: 'GET',
            url: 'indicador'+'/'+$scope.username+'/'+$scope.password,
            data: {}
        }).success(function (result) {
          result.push(defaultOption);
          $scope.model.indicador = defaultOption;
          $scope.options.indicadores = result;
        });
      }

      // Fim da funcao setConteudo
    }

    $scope.avaliar = function(id){
      $scope.avaliando = id;
      $scope.setConteudo("avaliando");
    }

    $scope.avaliar_nota = function(id){
      $scope.avaliando_objeto = id;
      $scope.setConteudo("avaliando_nota");
    }

    $scope.avaliar_nota2 = function(id){
      $scope.avaliando_objeto = id;
      $scope.setConteudo("avaliando_nota2");
    }

    $scope.deletar_objeto = function(id){
      url = ""+"objetoavaliacao-delete"+"/"+$scope.username+"/"+$scope.password+"/"+id;
      $http.delete(url).
      success(function(data) {
        $scope.setConteudo("avaliando");
      })
    }

    $scope.deletar_avaliacao = function(id){
      url = ""+"avaliacao-delete"+"/"+$scope.username+"/"+$scope.password+"/"+id;
      $http.delete(url).
      success(function(data) {
        $scope.setConteudo("avaliacoes");
      })
    }

	//source: http://stackoverflow.com/a/18646795
	angular.element(document).ready(function () {
		/* TODO: remover - pulando etapa de login */
		$("#username").val('victor');
		$("#password").val('123');
		$scope.logar(function() {
      $scope.setConteudo("indicadores");
    });
		/* */
	});
};

function removeFromArray(array, variable, value) {
  for (var i=0; i<array.length; i++) {
    var item = array[i];
    if (item[variable] === value) {
      array.splice(i, 1);
      break;
    }
  }

  return array;
}
