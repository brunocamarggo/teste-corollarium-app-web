<?php 
    
    class CitiesAPITest extends PHPUnit\Framework\TestCase {

        public function setUp() {
            $this->get = new CitiesAPI;
            $this->cities = json_decode($this->get->getAllCitiesFromWeb());
        }
        public function testsIfLondrinaBelongsToParana() {
            $this->assertEquals("Paraná", $this->cities->cidades->{'Londrina'});
        }

        public function testsIfAssisBelongsToSaoPaulo() {
            $this->assertEquals("São Paulo", $this->cities->cidades->{'Assis'});
        }

        public function testsIfSaoPauloBelongsToSaoPaulo() {
            $this->assertEquals("São Paulo", $this->cities->cidades->{'São Paulo'});
        }
    }
?>