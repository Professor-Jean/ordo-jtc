<?php
/**
*Funcionalidade: este aquivo possui a função de gerenciar as mensagens de aviso
*Data de criação: 10/10/2016
*/

function messageRepository($id, $data=NULL){
  //$id -> identificador único de cada mensagem.
  //$date -> complemento da mensagem, se houver.
  switch ($id){
    case 1:
      $msg = "Cadastro de ".$data." realizado com sucesso.";
      break;
    case 2:
      $msg = "Erro ao realizar o cadastro de ".$data."!";
      break;
    case 3:
      $msg = "Usuário ou senha incorretos!";
      break;
    case 4:
      $msg = "Erro no campo ".$data."!";
      break;
    case 5:
      $msg = "Campo vazio: ".$data."!";
      break;
    case 6:
      $msg = "Senhas não coincidem!";
      break;
    case 7:
      $msg = $data." já cadastrado(a)!";
      break;
    case 8:
      $msg = "Deletar o Administrador: ".$data;
      break;
    case 9:
      $msg = "Você não pode se deletar sendo o único administrador!".$data;
      break;
    case 10:
      $msg = "Erro ao realizar a exclusão de ".$data."!";
      break;
    case 11:
      $msg = $data." excluído(a) com sucesso!";
      break;
    case 12:
      $msg = "Já existe outro usuário com este E-mail!";
      break;
    case 13:
      $msg = "Erro ao realizar a alteração de ".$data."!";
      break;
    case 14:
      $msg = $data." alterado(a) com sucesso!";
      break;
    case 15:
      $msg = "Já existe um produto com este código!";
      break;
    case 16:
      $msg = "A data não está no formato DD/MM/AAAA!";
      break;
    case 17:
      $msg = "Já existe outro Vendedor com este E-mail!";
      break;
    case 18:
      $msg = "Já existe outro Vendedor com este Telefone!";
      break;
    case 19:
      $msg = "Este Vendedor está vinculado a algum registro de ".$data."!";
      break;
    case 20:
      $msg = "Já existe uma Cidade com este nome neste Estado!";
      break;
    case 21:
      $msg = "Já existe um Estado com este Nome!";
      break;
    case 22:
      $msg = "Já existe um Estado com esta Sigla!";
      break;
    case 23:
      $msg = "Este Estado está vinculado a algum registro de Cidade!";
      break;
    case 24:
      $msg = "Esta Cidade está vinculada a algum registro de Vendedor!";
      break;
    case 25:
      $msg = "Não existe um usuário com este E-mail!";
      break;
    case 26:
      $msg = "E-mail enviado!";
      break;
    case 27:
      $msg = "ID inválido!";
      break;
    case 28:
      $msg = "Erro ao alterar senha!";
      break;
    case 29:
      $msg = "Nenhum vendedor selecionado!";
      break;
    case 30:
      $msg = "Entrada efetuada com sucesso!";
      break;
    case 31:
      $msg = "Hora inválida!";
      break;
    case 32:
      $msg = "Erro ao realizar a Entrada de Produtos em Estoque!";
      break;
    case 33:
      $msg = "Erro ao realizar repasse!";
      break;
    case 34:
      $msg = "Erro ao realizar Repasse de Mercadoria!";
      break;
    case 35:
      $msg = "Repasse de Mercadoria realizado com sucesso.";
      break;
    case 36:
      $msg = "A quantidade escolhida é maior que a do repasse selecionado!";
      break;
    case 37:
      $msg = "Repasse de conserto realizado com sucesso!";
      break;
    case 38:
      $msg = "Reposição de Produto realizada com sucesso!";
      break;
    case 39:
      $msg = "Repasse de Brinde para Vendedor realizado com sucesso!";
      break;
    case 40:
      $msg = "Não é possível excluir este produto pois está vinculado a mais registros!";
      break;
    case 41:
      $msg = "Não é possível excluir este tamanho pois está vinculado a mais registros!";
      break;
    case 42:
      $msg = "Não é possível excluir este categoria pois está vinculado a mais registros!";
      break;
      case 43:
          $msg = "Preencha o campo data e horário!";
          break;
      default:
      $msg = "[ID INSERIDO NÃO EXISTE!]";
    break;

  }
  return $msg;
}
