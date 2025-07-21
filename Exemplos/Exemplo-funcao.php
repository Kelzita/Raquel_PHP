    <!DOCTYPE html>
    <html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Exemplo da função rand e shuffle </title>
    </head>
    <body>
        <?php 
         # rand - Gera um inteiro aleatório 
         $sorteio = rand(0, 5); // Gera um número aleatório entre 0 e 5
         echo "Sorteado: " .$sorteio."<hr>"; // Imprime o número sorteado
         #array_merge - Combina um ou mais arrays
         #range - Cria um array contendo uma faixa de elementos 
         #(inicio,fim,passo)
         $vetor = array_merge(range(0, 10), range($sorteio, 10, 2), array ($sorteio)); // Cria um array com os números de 0 a 10, os números pares a partir do número sorteado até 10 e o número sorteado
         print_r($vetor); // Imprime o índice do Array - As pares entre colchetes
        echo "<hr>"; // Imprime o Array com os índices
        #embaralha
        shuffle($vetor);  //Embaralha os elementos do array
        print_r($vetor); 
        echo "<hr>";
    ?>  
    <adress align="center">
      <i>Raquel Fernandes - Estudante - Técnico de desenvolvimento de sistemas</i>
</adress>
    
    </body>
    </html>