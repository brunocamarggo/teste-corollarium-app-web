// Author: Bruno de Camargo Barreto Silva
// Computer engineering student
// Federal University of Technology - Parana (UTFPR)
// Mobile +55-18-996-171-234 
// Address Av. Antônio Silveira Brasil, n. 1235. Cornélio Procópio - PR
// Email brunocamarggo@gmail.com, bsilva@alunos.utfpr.edu.br 
function getCorrectColor(cityName) {
    // Lógica para altera a cor de acordo com a primeira letra da cidade.
    // O back-end garente que todas as letras das cidades estão em uppercase.
    // Logo, da tabela ascii:
    // A-L --> 65-76, red
    // M-R --> 77-82, blue
    // S-Z --> 83-90, green
    let firstLetter = cityName.charCodeAt(0);
    if (firstLetter >= 65 && firstLetter <= 76) {
        return 'red-text';
    }
    else if (firstLetter >= 77 && firstLetter <= 82) {
        return 'blue-text';
    }
    else {
        return 'green-text';
    }
}
// função JQuery para fechar o div da informação de uma cidade
$("button").click(function(){
    $(".info-box").hide();
    $('#query').val("");
});