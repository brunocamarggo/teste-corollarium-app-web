<?php

    // Author: Bruno de Camargo Barreto Silva
    // Computer engineering student
    // Federal University of Technology - Parana (UTFPR)
    
    // Mobile +55-18-996-171-234 
    // Address Av. Antônio Silveira Brasil, n. 1235. Cornélio Procópio - PR
    // Email brunocamarggo@gmail.com, bsilva@alunos.utfpr.edu.br 
    
    class CitiesAPI {
    // url contendo uma lista com informações sobre os municípios do Brasil
    
    function getAllCitiesFromWeb() {
        // Retorna em formato JSON um arquivo contendo os noemes de todas as cidades do Brasil e seus
        // respectivos estados. Como fonte dos dados foi utilizado o repositório disponibilizado para o teste.
        $cities = array();
        // Realizando a captura dos dados
        $url ='https://gist.githubusercontent.com/letanure/3012978/raw/36fc21d9e2fc45c078e0e0e07cce3c81965db8f9/estados-cidades.json';

        $string = file_get_contents($url);
        // Convertendo para um objeto JSON
        $cities_json = json_decode($string);
        // Extraíndo apenas as informaçoes necessárias (nome e Estado de uma cidade)        
        foreach ($cities_json->estados as $estado) {
            foreach($estado->cidades as $cidade) {
                $cities[$cidade] = $estado->nome;
            }
        }

        $cities = array(
            'cidades' => $cities
        );

        // Convertendo para o formatdo JSON. Desta forma, a representação final ficara sendo:
        // JSON = 
        //  { 
        //      "cidade":
        //          {cidade nome}: {Estado},
        //  }
        //
        // Ou seja, cada valor chave do JSON (key) é um nome de cidade e
        // cada valor (value) é o respectivo Estado.
        return json_encode($cities, JSON_UNESCAPED_UNICODE | JSON_PRETTY_PRINT);
    }

    function findByName($name) {
        // Retorna um JSON contendo o nome da cidade e seu respectivo Estado.
        // Fazendo uso do método acima para obter a lista de todas as cidades/Estados do Brasil e
        // Convertendo para JSON para a manipulação dos dados.
        $cities = json_decode($this->getAllCitiesFromWeb());      
        // Se exister um Estado para a cidade informada pelo usário, ou seja,
        // Caso $cities->cidades->$name contenha um valor, Então o usuário entrou um nome de cidade válido.
        // De outra forma, a cidade informada não existe no Brasil, logo não existe Estado associado a mesma.
        if (isset($cities->cidades->$name)){
            $result = array(
                "nome" => ucfirst($name),
                "estado" => $cities->cidades->$name
            );
            $result = array(
                "cidade" => $result
            );
            // Convertendo para o formatdo JSON. Desta forma, a representação final ficara sendo:
            // JSON =
            // cidade {
            //      {
            //          {cidade nome}: {estado}
            //      }
            // }    
            return json_encode($result, JSON_UNESCAPED_UNICODE | JSON_PRETTY_PRINT);
        }
        // Se o usuário fizer uma requisição de nome de cidade inválido
        // o retorno será "Not Found".
        return "Not Found";
    }
}
?>