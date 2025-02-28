<?php

function getJogosMaisVendidos()
{
    // HTML da página 
    $url = "https://store.steampowered.com/search/?hidef2p=1&filter=topsellers&ndl=1";

    // Inicializa o cURL
    $ch = curl_init();
    curl_setopt($ch, CURLOPT_URL, $url);
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
    curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
    $html = curl_exec($ch);
    curl_close($ch);

    $dom = new DOMDocument(); //O HTML da página é carregado no DOMDocument, que permite manipular o HTML
    @$dom->loadHTML($html);
    $xpath = new DOMXPath($dom); //facilita a busca dos elementos

    // Seleciona os elementos dos jogos
    $jogos = $xpath->query("//div[@id='search_resultsRows']/a");


    $resultado = [];
    $contador = 1;


    foreach ($jogos as $jogo) {
        // Verifica se $jogo é um nó válido
        if (!$jogo instanceof DOMNode) {
            continue;
        }

        //coleta info
        $precoElemento = $xpath->query(".//div[contains(@class, 'search_price')]", $jogo);
        $preco = ($precoElemento->length > 0) ? trim($precoElemento->item(0)->textContent) : "preço não encontrado";

        $tituloElemento = $xpath->query(".//span[@class='title']", $jogo);
        $titulo = ($tituloElemento->length > 0) ? trim($tituloElemento->item(0)->textContent) : "titulo não encontrado";

        $avaliacaoElemento = $xpath->query(".//span[contains(@class, 'search_review_summary')]", $jogo);
        $avaliacao = ($avaliacaoElemento->length > 0) ? trim($avaliacaoElemento->item(0)->getAttribute('data-tooltip-html')) : "Sem avaliação";

        $avaliacao = str_replace("<br>", " ", $avaliacao);
        $avaliacao = strip_tags($avaliacao);

        $link = ($jogo instanceof DOMElement) ? $jogo->getAttribute('href'): "link não encontrado";

        //armazena os dados
        $resultado[] = [
            'posicao' => $contador++,
            'titulo' => $titulo,
            'preco' => $preco,
            'avaliacao' => $avaliacao,
            'link' => $link 
        ];
    }

    return $resultado;
}

$jogos = getJogosMaisVendidos();
$dadosJson = json_encode($jogos, JSON_PRETTY_PRINT | JSON_UNESCAPED_UNICODE);
file_put_contents("jogos.json", $dadosJson);
?>