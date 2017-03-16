<?php
class Indicadores{

    function helloWorld($f3){
      echo 'Hello world!!';
    }


    // GETTERS
    /*Modulo responsavel por validar usuario e responder com os Indicadores no banco*/
    function getIndicadores($f3){
      // VALIDA USER
      $conexao =     'mysql:host='.$f3->get("db_host").';port=3306;dbname='.$f3->get("db_name");
      $db=new DB\SQL($conexao,$f3->get("db_user"),$f3->get("db_password"));
      $user = $f3->get('PARAMS.usuario');
      $senha = $f3->get('PARAMS.senha');
      $tabela=new DB\SQL\Mapper($db,'usuario');
      $tabela->load(array('usuario=? AND senha=?', $user , $senha));
      $perfil = $tabela->Perfil_id;
      $permissao = null;
      $data = '';
      if($perfil != null){
        $tabela=new DB\SQL\Mapper($db,'perfil');
        $tabela->load(array('id=?', $perfil));
        $permissao = $tabela->permissao;
      }
      // CASO PERMITIDO
      if($permissao == 1){
        $tabela=new DB\SQL\Mapper($db,'indicador');
         $result=$tabela->find('id>0');
         $resultado = array();
        foreach ($result as $Get_search) {
          $data['id'] = $Get_search['id'];
          $data['nome'] = $Get_search['nome'];
          $data['objetivos'] = $Get_search['objetivos'];
          $resultado[] = $data;
        }
      }else{
        $resultado['Permissao'] = 'Erro ao logar';
      }
      // RESPONDE JSON
      echo json_encode($resultado);
    }


    /*Modulo responsavel por validar usuario e responder com os Pilares no banco*/
    function getPilares($f3){
      // VALIDA USER
      $conexao =     'mysql:host='.$f3->get("db_host").';port=3306;dbname='.$f3->get("db_name");
      $db=new DB\SQL($conexao,$f3->get("db_user"),$f3->get("db_password"));
      $user = $f3->get('PARAMS.usuario');
      $senha = $f3->get('PARAMS.senha');
      $tabela=new DB\SQL\Mapper($db,'usuario');
      $tabela->load(array('usuario=? AND senha=?', $user , $senha));
      $perfil = $tabela->Perfil_id;
      $permissao = null;
      $data = '';
      if($perfil != null){
        $tabela=new DB\SQL\Mapper($db,'perfil');
        $tabela->load(array('id=?', $perfil));
        $permissao = $tabela->permissao;
      }
      // CASO PERMITIDO
      if($permissao == 1){
        $tabela=new DB\SQL\Mapper($db,'pilar');
         $result=$tabela->find('id>0');
         $resultado = array();
        foreach ($result as $Get_search) {
          $data['id'] = $Get_search['id'];
          $data['Indicador_id'] = $Get_search['Indicador_id'];
          $data['nome'] = $Get_search['nome'];
          $data['descricao'] = $Get_search['descricao'];
          $resultado[] = $data;
        }
      }else{
        $resultado['Permissao'] = "Permissao Negada.";
      }
      // RESPONDE JSON
      echo json_encode($resultado);
    }

    /*Modulo responsavel por validar usuario e responder com os Pilares no banco*/
    function getTipos($f3){
      // VALIDA USER
      $conexao =     'mysql:host='.$f3->get("db_host").';port=3306;dbname='.$f3->get("db_name");
      $db=new DB\SQL($conexao,$f3->get("db_user"),$f3->get("db_password"));
      $user = $f3->get('PARAMS.usuario');
      $senha = $f3->get('PARAMS.senha');
      $tabela=new DB\SQL\Mapper($db,'usuario');
      $tabela->load(array('usuario=? AND senha=?', $user , $senha));
      $perfil = $tabela->Perfil_id;
      $permissao = null;
      $data = '';
      if($perfil != null){
        $tabela=new DB\SQL\Mapper($db,'perfil');
        $tabela->load(array('id=?', $perfil));
        $permissao = $tabela->permissao;
      }
      // CASO PERMITIDO
      if($permissao == 1){
        $tabela=new DB\SQL\Mapper($db,'tipo');
         $result=$tabela->find('id>0');
         $resultado = array();
        foreach ($result as $Get_search) {
          $data['id'] = $Get_search['id'];
          $data['Pilar_id'] = $Get_search['Pilar_id'];
          $data['nome'] = $Get_search['nome'];
          $data['descricao'] = $Get_search['descricao'];
          $resultado[] = $data;
        }
      }else{
        $resultado['Permissao'] = "Permissao Negada.";
      }
      // RESPONDE JSON
      echo json_encode($resultado);
    }


    /*Modulo responsavel por validar usuario e responder com os Niveis no banco*/
    function getNiveis($f3){
      // VALIDA USER
      $conexao =     'mysql:host='.$f3->get("db_host").';port=3306;dbname='.$f3->get("db_name");
      $db=new DB\SQL($conexao,$f3->get("db_user"),$f3->get("db_password"));
      $user = $f3->get('PARAMS.usuario');
      $senha = $f3->get('PARAMS.senha');
      $tabela=new DB\SQL\Mapper($db,'usuario');
      $tabela->load(array('usuario=? AND senha=?', $user , $senha));
      $perfil = $tabela->Perfil_id;
      $permissao = null;
      $data = '';
      if($perfil != null){
        $tabela=new DB\SQL\Mapper($db,'perfil');
        $tabela->load(array('id=?', $perfil));
        $permissao = $tabela->permissao;
      }
      // CASO PERMITIDO
      if($permissao == 1){
        $tabela=new DB\SQL\Mapper($db,'nivel');
         $result=$tabela->find('id>0');
         $resultado = array();
        foreach ($result as $Get_search) {
          $data['id'] = $Get_search['id'];
          $data['Tipo_id'] = $Get_search['Tipo_id'];
          $data['nome'] = $Get_search['nome'];
          $data['descricao'] = $Get_search['descricao'];
          $resultado[] = $data;
        }
      }else{
        $resultado['Permissao'] = "Permissao Negada.";
      }
      // RESPONDE JSON
      echo json_encode($resultado);
    }


    /*Modulo responsavel por validar usuario e responder com os Subniveis no banco*/
    function getSubniveis($f3){
      // VALIDA USER
      $conexao =     'mysql:host='.$f3->get("db_host").';port=3306;dbname='.$f3->get("db_name");
      $db=new DB\SQL($conexao,$f3->get("db_user"),$f3->get("db_password"));
      $user = $f3->get('PARAMS.usuario');
      $senha = $f3->get('PARAMS.senha');
      $tabela=new DB\SQL\Mapper($db,'usuario');
      $tabela->load(array('usuario=? AND senha=?', $user , $senha));
      $perfil = $tabela->Perfil_id;
      $permissao = null;
      $data = '';
      if($perfil != null){
        $tabela=new DB\SQL\Mapper($db,'perfil');
        $tabela->load(array('id=?', $perfil));
        $permissao = $tabela->permissao;
      }
      // CASO PERMITIDO
      if($permissao == 1){
        $tabela=new DB\SQL\Mapper($db,'subnivel');
         $result=$tabela->find('id>0');
         $resultado = array();
         foreach ($result as $Get_search) {
          $data['id'] = $Get_search['id'];
          $data['Nivel_id'] = $Get_search['Nivel_id'];
          $data['nome'] = $Get_search['nome'];
          $data['descricao'] = $Get_search['descricao'];
          $resultado[] = $data;
        }
      }else{
        $resultado['Permissao'] = "Permissao Negada.";
      }
      // RESPONDE JSON
      echo json_encode($resultado);
    }


    /*Modulo responsavel por validar usuario e responder com os Itens no banco*/
    function getItens($f3){
      // VALIDA USER
      $conexao =     'mysql:host='.$f3->get("db_host").';port=3306;dbname='.$f3->get("db_name");
      $db=new DB\SQL($conexao,$f3->get("db_user"),$f3->get("db_password"));
      $user = $f3->get('PARAMS.usuario');
      $senha = $f3->get('PARAMS.senha');
      $tabela=new DB\SQL\Mapper($db,'usuario');
      $tabela->load(array('usuario=? AND senha=?', $user , $senha));
      $perfil = $tabela->Perfil_id;
      $permissao = null;
      $data = '';
      if($perfil != null){
        $tabela=new DB\SQL\Mapper($db,'perfil');
        $tabela->load(array('id=?', $perfil));
        $permissao = $tabela->permissao;
      }
      // CASO PERMITIDO
      if($permissao == 1){
        $tabela=new DB\SQL\Mapper($db,'item');
         $result=$tabela->find('id>0');
         $resultado = array();
         foreach ($result as $Get_search) {
          $data['id'] = $Get_search['id'];
          $data['Subnivel_id'] = $Get_search['Subnivel_id'];
          $data['nome'] = $Get_search['nome'];
          $data['exigencia'] = $Get_search['exigencia'];
          $data['notaMaxima'] = $Get_search['notaMaxima'];
          $data['obrigatorio'] = $Get_search['obrigatorio'];
          $resultado[] = $data;
        }
      }else{
        $resultado['Permissao'] = "Permissao Negada.";
      }
      // RESPONDE JSON
      echo json_encode($resultado);
    }

    /*Modulo responsavel por validar usuario e responder com os Ponntuacoes no banco*/
    function getPontuacoes($f3){
      // VALIDA USER
      $conexao =     'mysql:host='.$f3->get("db_host").';port=3306;dbname='.$f3->get("db_name");
      $db=new DB\SQL($conexao,$f3->get("db_user"),$f3->get("db_password"));
      $user = $f3->get('PARAMS.usuario');
      $senha = $f3->get('PARAMS.senha');
      $tabela=new DB\SQL\Mapper($db,'usuario');
      $tabela->load(array('usuario=? AND senha=?', $user , $senha));
      $perfil = $tabela->Perfil_id;
      $permissao = null;
      $data = '';
      if($perfil != null){
        $tabela=new DB\SQL\Mapper($db,'perfil');
        $tabela->load(array('id=?', $perfil));
        $permissao = $tabela->permissao;
      }
      // CASO PERMITIDO
      if($permissao == 1){
        $tabela=new DB\SQL\Mapper($db,'pontuacao');
         $result=$tabela->find('id>0');
         $resultado = array();
         foreach ($result as $Get_search) {
          $data['id'] = $Get_search['id'];
          $data['Item_id'] = $Get_search['Item_id'];
          $data['descricao'] = $Get_search['descricao'];
          $data['nota'] = $Get_search['nota'];
          $resultado[] = $data;
        }
      }else{
        $resultado['Permissao'] = "Permissao Negada.";
      }
      // RESPONDE JSON
      echo json_encode($resultado);
    }

    /*Modulo responsavel por validar usuario e responder com os Criterios Legais no banco*/
    function getCriterioLegais($f3){
      // VALIDA USER
      $conexao =     'mysql:host='.$f3->get("db_host").';port=3306;dbname='.$f3->get("db_name");
      $db=new DB\SQL($conexao,$f3->get("db_user"),$f3->get("db_password"));
      $user = $f3->get('PARAMS.usuario');
      $senha = $f3->get('PARAMS.senha');
      $tabela=new DB\SQL\Mapper($db,'usuario');
      $tabela->load(array('usuario=? AND senha=?', $user , $senha));
      $perfil = $tabela->Perfil_id;
      $permissao = null;
      $data = '';
      if($perfil != null){
        $tabela=new DB\SQL\Mapper($db,'perfil');
        $tabela->load(array('id=?', $perfil));
        $permissao = $tabela->permissao;
      }
      // CASO PERMITIDO
      if($permissao == 1){
        $tabela=new DB\SQL\Mapper($db,'criteriolegal');
         $result=$tabela->find('id>0');
         $resultado = array();
         foreach ($result as $Get_search) {
          $data['id'] = $Get_search['id'];
          $data['Norma_id'] = $Get_search['Norma_id'];
          $data['descricao'] = $Get_search['descricao'];
          $resultado[] = $data;
        }
      }else{
        $resultado['Permissao'] = "Permissao Negada.";
      }
      // RESPONDE JSON
      echo json_encode($resultado);

    }

    /*Modulo responsavel por validar usuario e responder com os Normas no banco*/
    function getNormas($f3){
      // VALIDA USER
      $conexao =     'mysql:host='.$f3->get("db_host").';port=3306;dbname='.$f3->get("db_name");
      $db=new DB\SQL($conexao,$f3->get("db_user"),$f3->get("db_password"));
      $user = $f3->get('PARAMS.usuario');
      $senha = $f3->get('PARAMS.senha');
      $tabela=new DB\SQL\Mapper($db,'usuario');
      $tabela->load(array('usuario=? AND senha=?', $user , $senha));
      $perfil = $tabela->Perfil_id;
      $permissao = null;
      $data = '';
      if($perfil != null){
        $tabela=new DB\SQL\Mapper($db,'perfil');
        $tabela->load(array('id=?', $perfil));
        $permissao = $tabela->permissao;
      }
      // CASO PERMITIDO
      if($permissao == 1){
        $tabela=new DB\SQL\Mapper($db,'norma');
         $result=$tabela->find('id>0');
         $resultado = array();
         foreach ($result as $Get_search) {
          $data['id'] = $Get_search['id'];
          $data['tipo'] = $Get_search['tipo'];
          $data['nome'] = $Get_search['nome'];
          $resultado[] = $data;
        }
      }else{
        $resultado['Permissao'] = "Permissao Negada.";
      }
      // RESPONDE JSON
      echo json_encode($resultado);

    }


    /*Modulo responsavel por validar usuario e responder com os ItemHasCriterio no banco*/
    function getItemHasCriterio($f3){
      // VALIDA USER
      $conexao =     'mysql:host='.$f3->get("db_host").';port=3306;dbname='.$f3->get("db_name");
      $db=new DB\SQL($conexao,$f3->get("db_user"),$f3->get("db_password"));
      $user = $f3->get('PARAMS.usuario');
      $senha = $f3->get('PARAMS.senha');
      $tabela=new DB\SQL\Mapper($db,'usuario');
      $tabela->load(array('usuario=? AND senha=?', $user , $senha));
      $perfil = $tabela->Perfil_id;
      $permissao = null;
      $data = '';
      if($perfil != null){
        $tabela=new DB\SQL\Mapper($db,'perfil');
        $tabela->load(array('id=?', $perfil));
        $permissao = $tabela->permissao;
      }
      // CASO PERMITIDO
      if($permissao == 1){
        $tabela=new DB\SQL\Mapper($db,'item_has_criteriolegal');
         $result=$tabela->find('');
         $resultado = array();
         foreach ($result as $Get_search) {
          $data['Item_id'] = $Get_search['Item_id'];
          $data['CriterioLegal_id'] = $Get_search['CriterioLegal_id'];
          $resultado[] = $data;
        }
      }else{
        $resultado['Permissao'] = "Permissao Negada.";
      }
      // RESPONDE JSON
      echo json_encode($resultado);

    }






    // POSTS




    //Metodo responsavel pela insercao de um novo Indicador no Banco.
    function postIndicador($f3){
      // VALIDA USER
      $conexao =     'mysql:host='.$f3->get("db_host").';port=3306;dbname='.$f3->get("db_name");
$db=new DB\SQL($conexao,$f3->get("db_user"),$f3->get("db_password"));
      $user = $f3->get('PARAMS.usuario');
      $senha = $f3->get('PARAMS.senha');
      $tabela=new DB\SQL\Mapper($db,'usuario');
      $tabela->load(array('usuario=? AND senha=?', $user , $senha));
      $perfil = $tabela->Perfil_id;
      $permissao = null;
      $data = '';
      if($perfil != null){
        $tabela=new DB\SQL\Mapper($db,'perfil');
        $tabela->load(array('id=?', $perfil));
        $permissao = $tabela->permissao;
      }
      // CASO PERMITIDO
      if($permissao == 1){
        $nome = $f3->get('PARAMS.nome');
        $objetivos = $f3->get('PARAMS.objetivos');
        $conexao =     'mysql:host='.$f3->get("db_host").';port=3306;dbname='.$f3->get("db_name");
$db=new DB\SQL($conexao,$f3->get("db_user"),$f3->get("db_password"));
        $tabela=new DB\SQL\Mapper($db,'indicador');
        $tabela->nome = $nome;
        $tabela->objetivos = $objetivos;
        $tabela->save();
        $data['Status'] = "Inserido com sucesso.";
      }else{
        $data['Status'] = "Permissao Negada.";
      }
      // RESPONDE JSON
      echo json_encode($data);
    }

    //Metodo responsavel pela insercao de um novo Pilar no Banco.
    function postPilar($f3){
      // VALIDA USER
      $conexao =     'mysql:host='.$f3->get("db_host").';port=3306;dbname='.$f3->get("db_name");
$db=new DB\SQL($conexao,$f3->get("db_user"),$f3->get("db_password"));
      $user = $f3->get('PARAMS.usuario');
      $senha = $f3->get('PARAMS.senha');
      $tabela=new DB\SQL\Mapper($db,'usuario');
      $tabela->load(array('usuario=? AND senha=?', $user , $senha));
      $perfil = $tabela->Perfil_id;
      $permissao = null;
      $data = '';
      if($perfil != null){
        $tabela=new DB\SQL\Mapper($db,'perfil');
        $tabela->load(array('id=?', $perfil));
        $permissao = $tabela->permissao;
      }
      // CASO PERMITIDO
      if($permissao == 1){
        $indicador_id = $f3->get('PARAMS.indicador_id');
        $nome = $f3->get('PARAMS.nome');
        $descricao = $f3->get('PARAMS.descricao');
        $conexao =     'mysql:host='.$f3->get("db_host").';port=3306;dbname='.$f3->get("db_name");
$db=new DB\SQL($conexao,$f3->get("db_user"),$f3->get("db_password"));
        $tabela=new DB\SQL\Mapper($db,'pilar');
        $tabela->nome = $nome;
        $tabela->Indicador_id = (int)$indicador_id;
        $tabela->descricao = $descricao;
        $tabela->save();
        $data['Status'] = "Inserido com sucesso.";
      }else{
        $data['Status'] = "Permissao Negada.";
      }
      // RESPONDE JSON
      echo json_encode($data);
    }


    //Metodo responsavel pela insercao de um novo Nivel no Banco.
    function postNivel($f3){
      // VALIDA USER
      $conexao =     'mysql:host='.$f3->get("db_host").';port=3306;dbname='.$f3->get("db_name");
$db=new DB\SQL($conexao,$f3->get("db_user"),$f3->get("db_password"));
      $user = $f3->get('PARAMS.usuario');
      $senha = $f3->get('PARAMS.senha');
      $tabela=new DB\SQL\Mapper($db,'usuario');
      $tabela->load(array('usuario=? AND senha=?', $user , $senha));
      $perfil = $tabela->Perfil_id;
      $permissao = null;
      $data = '';
      if($perfil != null){
        $tabela=new DB\SQL\Mapper($db,'perfil');
        $tabela->load(array('id=?', $perfil));
        $permissao = $tabela->permissao;
      }
      // CASO PERMITIDO
      if($permissao == 1){
        $pilar_id = $f3->get('PARAMS.pilar_id');
        $nome = $f3->get('PARAMS.nome');
        $descricao = $f3->get('PARAMS.descricao');
        $conexao =     'mysql:host='.$f3->get("db_host").';port=3306;dbname='.$f3->get("db_name");
$db=new DB\SQL($conexao,$f3->get("db_user"),$f3->get("db_password"));
        $tabela=new DB\SQL\Mapper($db,'nivel');
        $tabela->nome = $nome;
        $tabela->Pilar_id = (int)$pilar_id;
        $tabela->descricao = $descricao;
        $tabela->save();
        $data['Status'] = "Inserido com sucesso.";
      }else{
        $data['Status'] = "Permissao Negada.";
      }
      // RESPONDE JSON
      echo json_encode($data);
    }


    //Metodo responsavel pela insercao de um novo Subnivel no Banco.
    function postSubnivel($f3){
      // VALIDA USER
      $conexao =     'mysql:host='.$f3->get("db_host").';port=3306;dbname='.$f3->get("db_name");
$db=new DB\SQL($conexao,$f3->get("db_user"),$f3->get("db_password"));
      $user = $f3->get('PARAMS.usuario');
      $senha = $f3->get('PARAMS.senha');
      $tabela=new DB\SQL\Mapper($db,'usuario');
      $tabela->load(array('usuario=? AND senha=?', $user , $senha));
      $perfil = $tabela->Perfil_id;
      $permissao = null;
      $data = '';
      if($perfil != null){
        $tabela=new DB\SQL\Mapper($db,'perfil');
        $tabela->load(array('id=?', $perfil));
        $permissao = $tabela->permissao;
      }
      // CASO PERMITIDO
      if($permissao == 1){
        $nivel_id = $f3->get('PARAMS.nivel_id');
        $nome = $f3->get('PARAMS.nome');
        $descricao = $f3->get('PARAMS.descricao');
        $conexao =     'mysql:host='.$f3->get("db_host").';port=3306;dbname='.$f3->get("db_name");
$db=new DB\SQL($conexao,$f3->get("db_user"),$f3->get("db_password"));
        $tabela=new DB\SQL\Mapper($db,'subnivel');
        $tabela->nome = $nome;
        $tabela->Nivel_id = (int)$nivel_id;
        $tabela->descricao = $descricao;
        $tabela->save();
        $data['Status'] = "Inserido com sucesso.";
      }else{
        $data['Status'] = "Permissao Negada.";
      }
      // RESPONDE JSON
      echo json_encode($data);
    }


    //Metodo responsavel pela insercao de um novo Item no Banco.
    function postItem($f3){
      // VALIDA USER
      $conexao =     'mysql:host='.$f3->get("db_host").';port=3306;dbname='.$f3->get("db_name");
      $db=new DB\SQL($conexao,$f3->get("db_user"),$f3->get("db_password"));
      $user = $f3->get('PARAMS.usuario');
      $senha = $f3->get('PARAMS.senha');
      $tabela=new DB\SQL\Mapper($db,'usuario');
      $tabela->load(array('usuario=? AND senha=?', $user , $senha));
      $perfil = $tabela->Perfil_id;
      $permissao = null;
      $data = '';
      if($perfil != null){
        $tabela=new DB\SQL\Mapper($db,'perfil');
        $tabela->load(array('id=?', $perfil));
        $permissao = $tabela->permissao;
      }
      // CASO PERMITIDO
      if($permissao == 1){

        $POST = json_decode($f3->BODY,TRUE);
        $id = $POST['id'];
        $subnivel_id = $POST['subnivelId'];
        $nome = $POST['nome'];
        $exigencia = $POST['exigencia'];
        $notamaxima = $POST['notaMaxima'];

        $conexao =     'mysql:host='.$f3->get("db_host").';port=3306;dbname='.$f3->get("db_name");
        $db=new DB\SQL($conexao,$f3->get("db_user"),$f3->get("db_password"));
        $tabela=new DB\SQL\Mapper($db,'item');

        if ($id) {
          $tabela->load(array('id=?', $id));
        }
        $tabela->nome = $nome;
        $tabela->Subnivel_id = (int)$subnivel_id;
        $tabela->exigencia = $exigencia;
        $tabela->notaMaxima = floatval($notamaxima);
        $tabela->save();
        if($tabela->dry()){
          $data['Status'] = "Erro.";
        }else{
          $data['Status'] = "Inserido com sucesso.";
          $data['id'] = $tabela->id;
        }
      }else{
        $data['Status'] = "Permissao Negada.";
      }
      // RESPONDE JSON
      echo json_encode($data);
    }


    //Metodo responsavel pela insercao de um novo Pontuacao no Banco.
    function postPontuacao($f3){
      // VALIDA USER
      $conexao =     'mysql:host='.$f3->get("db_host").';port=3306;dbname='.$f3->get("db_name");
      $db=new DB\SQL($conexao,$f3->get("db_user"),$f3->get("db_password"));
      $user = $f3->get('PARAMS.usuario');
      $senha = $f3->get('PARAMS.senha');
      $tabela=new DB\SQL\Mapper($db,'usuario');
      $tabela->load(array('usuario=? AND senha=?', $user , $senha));
      $perfil = $tabela->Perfil_id;
      $permissao = null;
      $data = '';
      if($perfil != null){
        $tabela=new DB\SQL\Mapper($db,'perfil');
        $tabela->load(array('id=?', $perfil));
        $permissao = $tabela->permissao;
      }
      // CASO PERMITIDO
      if($permissao == 1){

        $POST = json_decode($f3->BODY,TRUE);
        $id = $POST['id'];
        $item_id = $POST['itemId'];
        $descricao = $POST['descricao'];
        $nota = $POST['nota'];

        $conexao =     'mysql:host='.$f3->get("db_host").';port=3306;dbname='.$f3->get("db_name");
        $db=new DB\SQL($conexao,$f3->get("db_user"),$f3->get("db_password"));
        $tabela=new DB\SQL\Mapper($db,'pontuacao');

        if ($id) {
          $tabela->load(array('id=?', $id));
        }
        $tabela->Item_id = (int)$item_id;
        $tabela->descricao = $descricao;
        $tabela->nota = floatval($nota);
        $tabela->save();
        if($tabela->dry()){
          $data['Status'] = "Erro ao inserir registro.";
        }else{
          $data['Status'] = "Inserido com sucesso.";
          $data['id'] = $tabela->id;
        }
      }else{
        $data['Status'] = "Permissao Negada.";
      }
      // RESPONDE JSON
      echo json_encode($data);
    }

    //Metodo responsavel pela insercao de um novo Norma no Banco.
    function postNorma($f3){
      // VALIDA USER
      $conexao =     'mysql:host='.$f3->get("db_host").';port=3306;dbname='.$f3->get("db_name");
$db=new DB\SQL($conexao,$f3->get("db_user"),$f3->get("db_password"));
      $user = $f3->get('PARAMS.usuario');
      $senha = $f3->get('PARAMS.senha');
      $tabela=new DB\SQL\Mapper($db,'usuario');
      $tabela->load(array('usuario=? AND senha=?', $user , $senha));
      $perfil = $tabela->Perfil_id;
      $permissao = null;
      $data = '';
      if($perfil != null){
        $tabela=new DB\SQL\Mapper($db,'perfil');
        $tabela->load(array('id=?', $perfil));
        $permissao = $tabela->permissao;
      }
      // CASO PERMITIDO
      if($permissao == 1){
        $tipo = $f3->get('PARAMS.tipo');
        $nome = $f3->get('PARAMS.nome');
        $conexao =     'mysql:host='.$f3->get("db_host").';port=3306;dbname='.$f3->get("db_name");
$db=new DB\SQL($conexao,$f3->get("db_user"),$f3->get("db_password"));
        $tabela=new DB\SQL\Mapper($db,'norma');
        $tabela->tipo = $tipo;
        $tabela->nome = $nome;
        $tabela->save();
        if($tabela->dry()){
          $data['Status'] = "Erro ao inserir registro.";
        }else{
          $data['Status'] = "Inserido com sucesso.";
        }
      }else{
        $data['Status'] = "Permissao Negada.";
      }
      // RESPONDE JSON
      echo json_encode($data);
    }


    //Metodo responsavel pela insercao de um novo Criterio Legal no Banco.
    function postCriterioLegal($f3){
      // VALIDA USER
      $conexao =     'mysql:host='.$f3->get("db_host").';port=3306;dbname='.$f3->get("db_name");
$db=new DB\SQL($conexao,$f3->get("db_user"),$f3->get("db_password"));
      $user = $f3->get('PARAMS.usuario');
      $senha = $f3->get('PARAMS.senha');
      $tabela=new DB\SQL\Mapper($db,'usuario');
      $tabela->load(array('usuario=? AND senha=?', $user , $senha));
      $perfil = $tabela->Perfil_id;
      $permissao = null;
      $data = '';
      if($perfil != null){
        $tabela=new DB\SQL\Mapper($db,'perfil');
        $tabela->load(array('id=?', $perfil));
        $permissao = $tabela->permissao;
      }
      // CASO PERMITIDO
      if($permissao == 1){
        $norma_id = $f3->get('PARAMS.norma_id');
        $descricao = $f3->get('PARAMS.descricao');
        $conexao =     'mysql:host='.$f3->get("db_host").';port=3306;dbname='.$f3->get("db_name");
$db=new DB\SQL($conexao,$f3->get("db_user"),$f3->get("db_password"));
        $tabela=new DB\SQL\Mapper($db,'criteriolegal');
        $tabela->Norma_id = (int)$norma_id;
        $tabela->descricao = $descricao;
        $tabela->save();
        if($tabela->dry()){
          $data['Status'] = "Erro ao inserir registro.";
        }else{
          $data['Status'] = "Inserido com sucesso.";
        }
      }else{
        $data['Status'] = "Permissao Negada.";
      }
      // RESPONDE JSON
      echo json_encode($data);
    }

    //Metodo responsavel pela insercao de um novo Criterio Legal no Banco.
    function postItemHasCriterio($f3){
      // VALIDA USER
      $conexao =     'mysql:host='.$f3->get("db_host").';port=3306;dbname='.$f3->get("db_name");
$db=new DB\SQL($conexao,$f3->get("db_user"),$f3->get("db_password"));
      $user = $f3->get('PARAMS.usuario');
      $senha = $f3->get('PARAMS.senha');
      $tabela=new DB\SQL\Mapper($db,'usuario');
      $tabela->load(array('usuario=? AND senha=?', $user , $senha));
      $perfil = $tabela->Perfil_id;
      $permissao = null;
      $data = '';
      if($perfil != null){
        $tabela=new DB\SQL\Mapper($db,'perfil');
        $tabela->load(array('id=?', $perfil));
        $permissao = $tabela->permissao;
      }
      // CASO PERMITIDO
      if($permissao == 1){
        $item_id = $f3->get('PARAMS.item_id');
        $criterioLegal_id = $f3->get('PARAMS.criterioLegal_id');
        $conexao =     'mysql:host='.$f3->get("db_host").';port=3306;dbname='.$f3->get("db_name");
$db=new DB\SQL($conexao,$f3->get("db_user"),$f3->get("db_password"));
        $tabela=new DB\SQL\Mapper($db,'item_has_criteriolegal');
        $tabela->Item_id = (int)$item_id;
        $tabela->CriterioLegal_id = (int)$criterioLegal_id;
        $tabela->save();
        if($tabela->dry()){
          $data['Status'] = "Erro ao inserir registro.";
        }else{
          $data['Status'] = "Inserido com sucesso.";
        }
      }else{
        $data['Status'] = "Permissao Negada.";
      }
      // RESPONDE JSON
      echo json_encode($data);
    }









}
?>
