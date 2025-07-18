<?php 
  foreach(file("livros.txt") as $livro) {
    list($titulo, $autor) = explode("," , $livro);
  
?>
<p> Título: <?=$titulo ?>, Autor: <?=$autor ?></p>

<?php 
}
?>
