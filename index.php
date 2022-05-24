<?php 
    $erroNome = "";
    $erroEmail = "";
    $erroSenha = "";
    $erroRepeteSenha = "";

    if ($_SERVER['REQUEST_METHOD'] == 'POST') {

      //verificar se está vazio
      if (empty($_POST['nome'])) {
          $erroNome = "Preencha o campo 'Nome'";
      } else {
          $nome = limpaPost($_POST['nome']);

      //verificar uso de caracteres especiais
          if (!preg_match("/^[a-zA-Z-' ]*$/", $nome)) {
            $erroNome = "Utilize apenas letras";
          }
      }

    if (empty($_POST['email'])) {
      $erroEmail = "Preencha o campo 'Email'";
  } else {
      $email = limpaPost($_POST['email']);
      //verificar o formato email
      if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        $erroEmail = "Digite um email inválido";
      }
  }

    if (empty($_POST['senha'])) {
      $erroSenha = "Preencha o campo 'Senha'";
  } else {
      $senha = limpaPost($_POST['senha']);
      //obriga senha a ser no minimo de 6 digitos
    if (strlen($senha) < 6) {
        $erroSenha = "A senha precisa ter no mínimo 6 digitos";
      }
  } 

    if (empty($_POST['repete_senha'])) {
      $erroRepeteSenha = "Por favor, repita a senha";
  } else {
      $repete_senha = limpaPost($_POST['repete_senha']);
      //verif. se as senhas são iguais
    if ($repete_senha !== $senha) {
        $erroRepeteSenha = "As senhas não estão iguais";
      }
  } 

    if (($erroNome=="")&& ($erroEmail=="")&& ($erroSenha=="")&& ($erroRepeteSenha=="")) {
      header('Location: sucesso.php');
    }
}

     function limpaPost($valor) {
     $valor = trim($valor);
     $valor = stripslashes($valor);
     $valor = htmlspecialchars($valor);
     return $valor;
  }

?>
<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Validação de Formulário</title>
    <link href="css/estilo.css" rel="stylesheet">
</head>
<body>
    <main>
    <h1><span>PHP</span><br>Validação de Formulário</h1>

     <form method= "post">

        <!-- Nome Completo -->
        <label> Nome Completo </label>
        <input type = "text" <?php if (!empty($erroNome)){echo "class= 'inválido'";} ?> <?php if (isset($_POST['nome'])){ echo "value='".$_POST['nome']."'";} ?> name = "nome" placeholder = "Digite seu nome">
        <br><span class= "erro"><?php echo $erroNome; ?></span>

        <!-- Email -->
        <label> E-mail </label>
        <input type = "email" <?php if (!empty($erroEmail)){echo "class= 'inválido'";} ?> <?php if (isset($_POST['email'])){ echo "value='".$_POST['email']."'";} ?> name = "email" placeholder = "Example@email.com">
        <br><span class = "erro"><?php echo $erroEmail; ?></span>

        <!-- Senha -->
        <label> Senha </label>
        <input type = "password" <?php if (!empty($erroSenha)){echo "class= 'inválido'";} ?> <?php if (isset($_POST['senha'])){ echo "value='".$_POST['senha']."'";} ?> name = "senha" placeholder = "Digite uma Senha">
        <br><span class = "erro"> <?php echo $erroSenha; ?></span>

        <!-- Repete a Senha -->
        <label> Repita a Senha </label>
        <input type = "password" <?php if (!empty($erroRepeteSenha)){echo "class= 'inválido'";} ?> <?php if (isset($_POST['repete_senha'])){ echo "value='".$_POST['repete_senha']."'";} ?> name = "repete_senha" placeholder = "Repita a Senha">
        <br><span class = "erro"><?php echo $erroRepeteSenha ?></span>

        <button type = "submit">Enviar Formulário</button>

      </form>
    </main>
</body>
</html>