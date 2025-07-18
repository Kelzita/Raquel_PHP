<?php 
   $texto = file_get_contents("texto.txt"); // Lê o conteúdo do arquivo texto.txt
    echo nl2br($texto). "<hr/>"; // Converte quebras de linha em <br> para exibição HTML 
    $texto = $texto ." extra"; // Adiciona " extra" ao final do conteúdo lido
    echo nl2br($texto). "<hr/>"; // Converte quebras de linha em <br> para exibição HTML
    file_put_contents("texto.txt", $texto); // Grava o conteúdo modificado de volta no arquivo texto.txt
?>

<br>
   <adress align="center">
      <i>Raquel Fernandes - Estudante - Técnico de desenvolvimento de sistemas</i>
</adress>