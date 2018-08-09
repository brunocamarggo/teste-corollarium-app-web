// Author: Bruno de Camargo Barreto Silva
// Computer engineering student
// Federal University of Technology - Parana (UTFPR)
// Mobile +55-18-996-171-234 
// Address Av. Antônio Silveira Brasil, n. 1235. Cornélio Procópio - PR
// Email brunocamarggo@gmail.com, bsilva@alunos.utfpr.edu.br 

// *** ATENÇÃO ***:  Altere a variável url para apontar para o seu end-point.
let url = 'http://localhost/public_html/api.php/cities/';

function feedAutoComplete() {
    // populando o autocomple usango api do back-end
    // os dados são obtidos com o uso da api nativa fetch
    // Chrome, Firefox, Safari, Edge, e Webview dão suporte a esta api
    // Em navegadores antigos como IE este método não ira funcionar.
    let cidades = []

    fetch(url)
    .then(res => res.json())
    .then((data) => {
        for(let key in data['cidades']){
            cidades.push(key);
        } 
    })
    .catch(err => { 
        console.log(err);
        throw err; 
    });
    return cidades;
} 

$( function() {
    // Utilizando a biblioteca jQuery para realizar a funcionalidade de auto-completar.
    $( "#query" ).autocomplete({
        source: feedAutoComplete(),
        minLength: 3,
        select: function( event, selected ) {                
            let cityName = selected.item.value;
            let textClass = getCorrectColor(cityName);
            let cidadeEstado = "";
            // Realizando a consulta da cidade digitada no back-end.
            fetch(url + cityName)
            .then(res => res.json())
            .then((data) => {
                cidadeEstado = data['cidade'].estado;
                let $newInfo = $(
                    "<div class='info-box'>" +
                        "<button class='btn-close' onclick='parentNode.remove()'>&#10006;</button>" +
                        "<span class=" + textClass +">" + 
                            cityName +"</span><span> é um município do Estado de " + cidadeEstado + "." +
                        "</span>" +
                    "</div>");
                $('.info-list').append($newInfo);
                $('#query').val("");
            })
            .catch(err => { 
                console.log(err);
                throw err; 
            });
        }
    });
} );