 <?php
class Pruebas extends TestCase {

    public function listar_usuarios()
    {
        $response = $this->action('GET', 'PersonaController@index');
        var_dump($response);
    }

}
