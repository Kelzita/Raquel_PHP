<?php 
  # FILE_IGNORE_NEW_LINER Ignorar o \n de cada linha
  $linhas = file("texto.txt", FILE_IGNORE_NEW_LINES); // Lê o arquivo texto.txt ignorando quebras de linha
  var_dump($linhas); // Exibe o conteúdo do arquivo como um array
  foreach($linhas as $linha_num => $linha); { // Percorre cada linha do array
     echo "Linha #($linha_num) : ".$linha. "<br>"; // Exibe cada linha do arquivo com seu número
  }
?>
<br>
   <adress align="center">
      <i>Raquel Fernandes - Estudante - Técnico de desenvolvimento de sistemas</i>
</adress>