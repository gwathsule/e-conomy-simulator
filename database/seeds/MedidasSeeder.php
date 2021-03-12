<?php

use App\Domains\Medida\Medida;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Storage;
use Illuminate\Http\File;

class MedidasSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $medidas = json_decode(file_get_contents(storage_path('support/medidas.json')), true);
        foreach ($medidas as $medida) {
            $this->saveMedida($medida);
        }
    }

    private function saveMedida($dataMedida)
    {
        $medida = new Medida();
        $medida->codigo_evento = $dataMedida['codigo_evento'];
        $medida->nome = $dataMedida['nome'];
        $medida->resumo = $dataMedida['resumo'];
        $medida->titulo_noticia = $dataMedida['titulo_noticia'];
        $medida->medida_imediata = $dataMedida['medida_imediata'];
        $medida->tipo_noticia = $dataMedida['tipo_noticia'];
        $medida->texto_noticia = $dataMedida['texto_noticia'];
        $medida->diferenca_financas = $dataMedida['diferenca_financas'];
        $medida->diferenca_popularidade_empresarios = $dataMedida['diferenca_popularidade_empresarios'];
        $medida->diferenca_popularidade_trabalhadores = $dataMedida['diferenca_popularidade_trabalhadores'];
        $medida->diferenca_popularidade_estado = $dataMedida['diferenca_popularidade_estado'];
        $medida->save();
        try {
            $imagem = $dataMedida['imagem'];
            Storage::putFileAs(
                "public/medidas/" . $medida->id,
                new File(public_path("img/medidas_exemplos/$imagem")),
                $imagem
            );
            $medida->url_imagem = "medidas/$medida->id/$imagem";
        }catch (\Symfony\Component\HttpFoundation\File\Exception\FileNotFoundException $ex) {
            $medida->url_imagem = null;
        }

        $medida->update();
    }
}