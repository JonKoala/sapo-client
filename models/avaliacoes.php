<?php
class Avaliacoes{

    // GETTERS
    /*Modulo responsavel por validar usuario e responder com os Entidades no banco*/
    function getEntidades($f3){
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
        $tabela=new DB\SQL\Mapper($db,'entidade');
         $result=$tabela->find('id>0');
         $resultado = array();
         foreach ($result as $Get_search) {
          $data['id'] = $Get_search['id'];
          $data['nome'] = $Get_search['nome'];
          $data['poder'] = $Get_search['poder'];
          $data['esfera'] = $Get_search['esfera'];
          $data['geonames_uri'] = $Get_search['geonames_uri'];
          $data['dbpedia_uri'] = $Get_search['dbpedia_uri'];
          $data['populacao'] = $Get_search['populacao'];
          $data['pib'] = $Get_search['pib'];
          $resultado[] = $data;
        }
      }else{
        $resultado['Permissao'] = "Permissao Negada.";
      }
      // RESPONDE JSON
      echo json_encode($resultado);
    }

    /*Modulo responsavel por validar usuario e responder com uma Entidade do banco baseado em um entidade_id*/
    function getEntidade($f3){
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
        $entidade_id = $f3->get('PARAMS.entidade_id');
        $tabela=new DB\SQL\Mapper($db,'entidade');
        $result = $tabela->find(array('id=?', $entidade_id));
        $resultado = array();
         foreach ($result as $Get_search) {
          $data['id'] = $Get_search['id'];
          $data['nome'] = $Get_search['nome'];
          $data['poder'] = $Get_search['poder'];
          $data['esfera'] = $Get_search['esfera'];
          $data['geonames_uri'] = $Get_search['geonames_uri'];
          $data['dbpedia_uri'] = $Get_search['dbpedia_uri'];
          $data['populacao'] = $Get_search['populacao'];
          $data['pib'] = $Get_search['pib'];
          $resultado[] = $data;
        }
      }else{
        $resultado['Permissao'] = "Permissao Negada.";
      }
      // RESPONDE JSON
      echo json_encode($resultado);
    }

    /*Modulo responsavel por validar usuario e responder com os Avaliacoes no banco*/
    function getAvaliacoes($f3){
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
        $tabela=new DB\SQL\Mapper($db,'avaliacao');
         $result=$tabela->find('id>0');
         $resultado = array();
         foreach ($result as $Get_search) {
          $data['id'] = $Get_search['id'];
          $data['Indicador_id'] = $Get_search['Indicador_id'];
          $data['nome'] = $Get_search['nome'];
          $data['objetivos'] = $Get_search['objetivos'];
          $data['dt_Inicio'] = $Get_search['dt_Inicio'];
          // $data['dt_Fim'] = $Get_search['dt_Fim'];
          $resultado[] = $data;
        }
      }else{
        $resultado['Permissao'] = "Permissao Negada.";
      }
      // RESPONDE JSON
      echo json_encode($resultado);
    }

    /*Modulo responsavel por validar usuario e responder com os Objeto de Avaliacao no banco*/
    function getObjetoAvaliacao($f3){
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
        $tabela=new DB\SQL\Mapper($db,'objetodeavaliacao');
         $result=$tabela->find('id>0');
         $resultado = array();
         foreach ($result as $Get_search) {
          $data['id'] = $Get_search['id'];
          $data['Entidade_id'] = $Get_search['Entidade_id'];
          $data['Avaliacao_id'] = $Get_search['Avaliacao_id'];
          $data['observacoes'] = $Get_search['observacoes'];
          $resultado[] = $data;
        }
      }else{
        $resultado['Permissao'] = "Permissao Negada.";
      }
      // RESPONDE JSON
      echo json_encode($resultado);
    }

    /*Modulo responsavel por validar usuario e responder com os Objeto de Avaliacao baseado em um id de avaliacao no banco*/
    function getObjetoAvaliacaoAvaliacao($f3){
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
        $avaliacao_id = $f3->get('PARAMS.avaliacao_id');
        $tabela=new DB\SQL\Mapper($db,'objetodeavaliacao');
         $result=$tabela->find(array('Avaliacao_id=?',$avaliacao_id));
         $resultado = array();
         foreach ($result as $Get_search) {
          $data['id'] = $Get_search['id'];
          $data['Entidade_id'] = $Get_search['Entidade_id'];
          $data['Avaliacao_id'] = $Get_search['Avaliacao_id'];
          $data['observacoes'] = $Get_search['observacoes'];
          $resultado[] = $data;
        }
      }else{
        $resultado['Permissao'] = "Permissao Negada.";
      }
      // RESPONDE JSON
      echo json_encode($resultado);
    }


    /*Modulo responsavel por deletar um objeto de avaliacao do banco tao quanto suas respectivas notas.*/
    function deleteObjetoAvaliacao($f3){
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
        $objeto_id = $f3->get('PARAMS.objeto_id');
        $tabela=new DB\SQL\Mapper($db,'nota');
        $result=$tabela->find(array('ObjetoDeAvaliacao_id=?',$objeto_id));
        $resultado = array();
        foreach ($result as $Get_search) {
          $Get_search->erase();
        }
        $tabela=new DB\SQL\Mapper($db,'objetodeavaliacao');
        $tabela->load(array('id=?', $objeto_id));
        $tabela->erase();
        $resultado['Permissao'] = "Sucesso!";
      }else{
        $resultado['Permissao'] = "Permissao Negada.";
      }
      // RESPONDE JSON
      echo json_encode($resultado);
    }


    /*Modulo responsavel por deletar um objeto de avaliacao do banco tao quanto suas respectivas notas.*/
    function deleteAvaliacao($f3){
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
        $avaliacao_id = $f3->get('PARAMS.avaliacao_id');
        // $f3->set('result',$db->exec('select nota.* from nota inner join objetodeavaliacao as obj on (obj.id = nota.ObjetoDeAvaliacao_id) inner join avaliacao as aval on (aval.id = obj.Avaliacao_id) where aval.id = ?', $avaliacao_id));
        // $result=$db->exec(array('select nota.* from nota inner join objetodeavaliacao as obj on (obj.id = nota.ObjetoDeAvaliacao_id) inner join avaliacao as aval on (aval.id = obj.Avaliacao_id) where aval.id = ?', $avaliacao_id));
        $result=$db->exec('select nota.* from nota inner join objetodeavaliacao as obj on (obj.id = nota.ObjetoDeAvaliacao_id) inner join avaliacao as aval on (aval.id = obj.Avaliacao_id) where aval.id = :id',array(':id'=>$avaliacao_id));
        // foreach ($result as $Get_search) {
        // echo $result;
        // }
        $tabela=new DB\SQL\Mapper($db,'objetodeavaliacao');
        $result=$tabela->find(array('Avaliacao_id=?',$avaliacao_id));
        $resultado = array();
        foreach ($result as $Get_search) {
          $Get_search->erase();
        }
        $tabela=new DB\SQL\Mapper($db,'avaliacao');
        $tabela->load(array('id=?', $avaliacao_id));
        $tabela->erase();
        $resultado['Permissao'] = "Sucesso!";
      }else{
        $resultado['Permissao'] = "Permissao Negada.";
      }
      // RESPONDE JSON
      echo json_encode($resultado);
    }


    /*Modulo responsavel por validar usuario e responder com as Notas no banco*/
    function getNotas($f3){
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
        $tabela=new DB\SQL\Mapper($db,'nota');
         $result=$tabela->find('id>0');
         $resultado = array();
         foreach ($result as $Get_search) {
          $data['id'] = $Get_search['id'];
          $data['Usuario_id'] = $Get_search['Usuario_id'];
          $data['Pontuacao_id'] = $Get_search['Pontuacao_id'];
          $data['Item_id'] = $Get_search['Item_id'];
          $data['ObjetoDeAvaliacao_id'] = $Get_search['ObjetoDeAvaliacao_id'];
          $data['dt_Avaliacao'] = $Get_search['dt_Avaliacao'];
          $data['evidencias'] = $Get_search['evidencias'];
          $data['observacoes'] = $Get_search['observacoes'];
          $resultado[] = $data;
        }
      }else{
        $resultado['Permissao'] = "Permissao Negada.";
      }
      // RESPONDE JSON
      echo json_encode($resultado);
    }

    /*Modulo responsavel por validar usuario e responder com as Notas referentes ao objeto_id passado como referencia banco*/
    function getNotasObjeto($f3){
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
        $objeto_id = $f3->get('PARAMS.objeto_id');
        $tabela=new DB\SQL\Mapper($db,'nota');
         $result=$tabela->find(array('ObjetoDeAvaliacao_id=?',$objeto_id));
         $resultado = array();
         foreach ($result as $Get_search) {
          $data['id'] = $Get_search['id'];
          $data['Usuario_id'] = $Get_search['Usuario_id'];
          $data['Pontuacao_id'] = $Get_search['Pontuacao_id'];
          $data['Item_id'] = $Get_search['Item_id'];
          $data['ObjetoDeAvaliacao_id'] = $Get_search['ObjetoDeAvaliacao_id'];
          $data['dt_Avaliacao'] = $Get_search['dt_Avaliacao'];
          $data['evidencias'] = $Get_search['evidencias'];
          $data['observacoes'] = $Get_search['observacoes'];
          $resultado[] = $data;
        }
      }else{
        $resultado['Permissao'] = "Permissao Negada.";
      }
      // RESPONDE JSON
      echo json_encode($resultado);
    }



    /*Modulo responsavel por item com seus respectivos parentes baseado na Nota_Id */
    function getItemRelacionado($f3){
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
        $f3->set('result',$db->exec('select itens.*, nots.id as nota_id,nots.Pontuacao_id as pontuacao_id , ent.nome as entidade, tipando as Tipo from (SELECT tip.nome as tipando,i.*, pil.nome as pilar, niv.nome as nivel, sub.nome as subnivel FROM item AS i INNER JOIN subnivel  AS  sub ON i.Subnivel_id = sub.id INNER JOIN nivel     AS  niv ON sub.Nivel_id = niv.id INNER JOIN tipo     AS  tip ON tip.id = niv.Tipo_id INNER JOIN pilar AS  pil ON pil.id = tip.Pilar_id INNER JOIN indicador AS  ind ON pil.Indicador_id = ind.id) as itens INNER JOIN nota AS nots ON nots.Item_id = itens.id INNER JOIN objetodeavaliacao as obj ON obj.id = nots.ObjetoDeAvaliacao_id INNER JOIN entidade as ent ON obj.Entidade_id = ent.id WHERE nots.ObjetoDeAvaliacao_id=? order by notaMaxima', $f3->get('PARAMS.objeto_id')));
        $result=$f3->get('result');
        $resultado = array();
        foreach ($result as $Get_search) {
          $data['id'] = $Get_search['id'];
          // Captura as pontuacoes filhas
          $tabela=new DB\SQL\Mapper($db,'pontuacao');
          $pontuacao = $tabela->find(array('Item_id=?',$Get_search['id']));
          $pontuacoes = array();
          foreach ($pontuacao as $unidade_pontuacao){
            $obj['id'] =  $unidade_pontuacao['id'];
            $obj['Item_id'] =  $unidade_pontuacao['Item_id'];
            $obj['descricao'] =  $unidade_pontuacao['descricao'];
            $obj['nota'] =  $unidade_pontuacao['nota'];
            $pontuacoes[] =  $obj;
          }
          $data['pontuacoes'] = $pontuacoes;
          $data['Subnivel_id'] = $Get_search['Subnivel_id'];
          $data['nome'] = $Get_search['nome'];
          $data['exigencia'] = $Get_search['exigencia'];
          $data['notaMaxima'] = $Get_search['notaMaxima'];
          $data['obrigatorio'] = $Get_search['obrigatorio'];
          $data['pilar'] = $Get_search['pilar'];
          $data['nivel'] = $Get_search['nivel'];
          $data['subnivel'] = $Get_search['subnivel'];
          $data['nota_id'] = $Get_search['nota_id'];
          $data['pontuacao_id'] = $Get_search['pontuacao_id'];
          $data['entidade'] = $Get_search['entidade'];
          $data['tipo'] = $Get_search['Tipo'];
          $resultado[] = $data;
        }
      }else{
        $resultado['Permissao'] = "Permissao Negada.";
      }
      // RESPONDE JSON
      echo json_encode($resultado);

    }



    /*Modulo responsavel por validar usuario e responder com os Objeto de Avaliacao no banco*/
    function getUsuarios($f3){
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
        $tabela=new DB\SQL\Mapper($db,'usuario');
         $result=$tabela->find('id>0');
         $i = 0;
         foreach ($result as $Get_search) {
          $i = $i + 1;
          $data[$i]['id'] = $Get_search['id'];
          $data[$i]['Perfil_id'] = $Get_search['Perfil_id'];
          $data[$i]['usuario'] = $Get_search['usuario'];
          $data[$i]['senha'] = $Get_search['senha'];
        }
      }else{
        $data['Permissao'] = "Permissao Negada.";
      }
     // RESPONDE JSON
      echo json_encode($data);
    }

    /*Modulo responsavel por validar usuario e responder com os Avaliacoes no banco*/
    function getPerfil($f3){
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
        $tabela=new DB\SQL\Mapper($db,'perfil');
        $result=$tabela->find('id>0');
        $i = 0;
        foreach ($result as $Get_search) {
          $i = $i + 1;
          $data[$i]['id'] = $Get_search['id'];
          $data[$i]['nome'] = $Get_search['nome'];
          $data[$i]['permissao'] = $Get_search['permissao'];
        }
      }else{
        $data['Permissao'] = "Permissao Negada.";
      }
      // RESPONDE JSON
      echo json_encode($data);
    }


    // Metodo responsavel por trazer todos os itens de um determinado indicador
    function getItensIndicador($f3){
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
          $f3->set('result',$db->exec('SELECT	i.* FROM item AS i INNER JOIN subnivel  AS  sub ON i.Subnivel_id = sub.id INNER JOIN nivel     AS  niv ON sub.Nivel_id = niv.id INNER JOIN tipo     AS  tip ON niv.Tipo_id = tip.id INNER JOIN pilar AS  pil ON tip.Pilar_id = pil.id INNER JOIN indicador AS  ind ON pil.Indicador_id = ind.id WHERE ind.id = ?', $f3->get('PARAMS.id_indicador')));
          $result=$f3->get('result');
          $resultado = array();
          foreach ($result as $Get_search) {
            $data['id'] = $Get_search['id'];
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









    // POSTS


    //Metodo responsavel pela insercao de um novo Pilar no Banco.
    function postAvaliacao($f3){
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
        $objetivos = $f3->get('PARAMS.objetivos');
        $dt_inicio = $f3->get('PARAMS.dt_inicio');
        // $dt_fim = $f3->get('PARAMS.dt_fim');
        $conexao =     'mysql:host='.$f3->get("db_host").';port=3306;dbname='.$f3->get("db_name");
        $db=new DB\SQL($conexao,$f3->get("db_user"),$f3->get("db_password"));
        $tabela=new DB\SQL\Mapper($db,'avaliacao');
        $tabela->Indicador_id = (int)$indicador_id;
        $tabela->nome = $nome;
        $tabela->objetivos = $objetivos;
        $tabela->dt_Inicio = $dt_inicio;
        // $tabela->dt_Fim = $dt_fim;
        $tabela->save();
        $data['id'] = $tabela->id;
      }else{
        $data['Status'] = "Permissao Negada.";
      }
      // RESPONDE JSON
      echo json_encode($data);
    }





    //Metodo responsavel pela insercao de um novo Pilar no Banco.
    function postObjetoAvaliacao($f3){
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
        $entidade_id = $f3->get('PARAMS.entidade_id');
        $avaliacao_id = $f3->get('PARAMS.avaliacao_id');
        if( $f3->get('PARAMS.observacoes') != null){
          $observacoes = $f3->get('PARAMS.observacoes');
        }else{
          $observacoes = null;
        }
        $conexao =     'mysql:host='.$f3->get("db_host").';port=3306;dbname='.$f3->get("db_name");
        $db=new DB\SQL($conexao,$f3->get("db_user"),$f3->get("db_password"));
        $tabela=new DB\SQL\Mapper($db,'objetodeavaliacao');
        $tabela->Entidade_id = (int)$entidade_id;
        $tabela->Avaliacao_id = (int)$avaliacao_id;
        $tabela->observacoes = $observacoes;
        $tabela->save();
        $data['id'] = $tabela->id;
      }else{
        $data['Status'] = "Permissao Negada.";
      }
      // RESPONDE JSON
      echo json_encode($data);
    }


    //Metodo responsavel pela insercao de um novo Pilar no Banco.
    function postNota($f3){
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
        $usuario_id = $f3->get('PARAMS.usuario_id');
        $item_id = $f3->get('PARAMS.item_id');
        $objetodeavaliacao_id = $f3->get('PARAMS.objetodeavaliacao_id');
        if( $f3->get('PARAMS.evidencias') != null){
          $evidencias = $f3->get('PARAMS.evidencias');
        }else{
          $evidencias = null;
        }
        if( $f3->get('PARAMS.observacoes') != null){
          $observacoes = $f3->get('PARAMS.observacoes');
        }else{
          $observacoes = null;
        }
        $conexao =     'mysql:host='.$f3->get("db_host").';port=3306;dbname='.$f3->get("db_name");
        $db=new DB\SQL($conexao,$f3->get("db_user"),$f3->get("db_password"));
        $tabela=new DB\SQL\Mapper($db,'nota');
        $tabela->Usuario_id = (int)$usuario_id;
        $tabela->Item_id = (int)$item_id;
        $tabela->ObjetoDeAvaliacao_id = (int)$objetodeavaliacao_id;
        $tabela->evidencias = $evidencias;
        $tabela->observacoes = $observacoes;
        $tabela->save();
        $data['Status'] = "Inserido com sucesso.";
      }else{
        $data['Status'] = "Permissao Negada.";
      }
      // RESPONDE JSON
      echo json_encode($data);
    }

    //Metodo responsavel pelo update de um registro de nota
    function putNota($f3){
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
        $nota_id = $f3->get('PARAMS.nota_id');
        $usuario_id = $f3->get('PARAMS.usuario_id');
        $pontuacao_id = $f3->get('PARAMS.pontuacao_id');
        $dt_avaliacao = $f3->get('PARAMS.dt_avaliacao');
        $tabela=new DB\SQL\Mapper($db,'nota');
        $result=$tabela->load(array('id=?',$nota_id));
        $result->Usuario_id = $usuario_id;
        $result->Pontuacao_id = $pontuacao_id;
        $result->dt_Avaliacao = $dt_avaliacao;
        $result->save();
        $resultado = array();
        $resultado['Permissao'] = "Sucesso.";
      }else{
        $resultado['Permissao'] = "Permissao Negada.";
      }
      // RESPONDE JSON
      echo json_encode($resultado);

    }



}
?>
