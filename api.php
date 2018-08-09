<?php

    // Author: Bruno de Camargo Barreto Silva
    // Computer engineering student
    // Federal University of Technology - Parana (UTFPR)
    
    // Mobile +55-18-996-171-234 
    // Address Av. Antônio Silveira Brasil, n. 1235. Cornélio Procópio - PR
    // Email brunocamarggo@gmail.com, bsilva@alunos.utfpr.edu.br 

    header('Access-Control-Allow-Origin: *');
    header('Content-Type: application/json');

    include_once 'app/repositories/CitiesAPI.php';

    $get = new CitiesAPI();

    $request = explode('/', trim($_SERVER['PATH_INFO'],'/'));
    // Se a função count() retornar 1, então é um pedido para todas as cidades
    // Caso contrário é um pedido para uma única cidade
    if (count($request) === 1 &&  array_shift($request) === "cities") {
        $cities = $get->getAllCitiesFromWeb();
        echo $cities;
    }
    else if(count($request) === 2){
        $cityName = ucfirst($request[1]);
        $city = $get->findByName($cityName);
        echo $city;   
    }
    else {
        echo "Para utlizar esta api: ";
        echo "O end-point api.php/cities retorna uma lista de todas as cidades do Brasil e seus respectivos Estados. \n\n";
        echo "O end-point api.php/cities/[city] retorna o nome da cidade informada e seu respectivo Estado.";

    }

?>