<?php

$nome_oportunidade = $_POST['firstname'] . ' ' . $_POST['lastname'];

if (!isset($_POST['firstname']) || empty($_POST['firstname']) || !isset($_POST['lastname']) || empty($_POST['lastname'])) {
    echo 'Erro ao criar oportunidade. Por favor, preencha todos os campos obrigatórios.';
    exit;
}

$url = 'https://api.insight.ly/v3.1/Opportunities'; 
$api_key = ''; // Chave/Token de acesso API
$pipeline_id = ''; // ID do pipeline 
$stage_id = ''; // ID da coluna 

$descricao = "Nome: $nome_oportunidade\n";
$descricao .= "Email: {$_POST['email']}\n";
$descricao .= "Telefone: {$_POST['phone']}\n";
$descricao .= "Cidade: {$_POST['city']}\n";
$descricao .= "Estado: {$_POST['state']}\n";

$data = array(
    'OPPORTUNITY_NAME' => $nome_oportunidade,
    'OPPORTUNITY_DETAILS' => $descricao
);

$ch = curl_init($url);

curl_setopt($ch, CURLOPT_POST, true);
curl_setopt($ch, CURLOPT_POSTFIELDS, json_encode($data));
curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
curl_setopt($ch, CURLOPT_HTTPHEADER, array(
    'Content-Type: application/json',
    'Authorization: Basic ' . base64_encode($api_key . ':')
));

$resultado = curl_exec($ch);

if (curl_errno($ch)) {
    echo 'Erro ao conectar com a API: ' . curl_error($ch);
} else {
    $resposta = json_decode($resultado, true);
    if (isset($resposta['OPPORTUNITY_ID'])) {
        echo 'Oportunidade criada com sucesso! ID: ' . $resposta['OPPORTUNITY_ID'];
        
        // Continuar com a transferência para o pipeline em questão
        toPipeline($resposta['OPPORTUNITY_ID'], $pipeline_id, $stage_id);
    } elseif (isset($resposta['errors'])) {
        echo 'Erro ao criar oportunidade: ' . $resposta['errors'][0]['MESSAGE'];
    } else {
        echo 'Erro ao criar oportunidade. Resposta completa: ' . $resultado;
    }
}

curl_close($ch);

// Função para transferir para o pipeline em questão
function toPipeline($opportunityId, $pipelineId, $stageId) {
    $url = 'https://api.insight.ly/v3.1/Opportunities/' . $opportunityId . '/Pipeline';
    $api_key = ''; // Chave/Token de acesso API
    
    $data = array(
        'PIPELINE_ID' => $pipelineId,
        'PIPELINE_STAGE_CHANGE' => array(
            'STAGE_ID' => $stageId
        )
    );

    $ch = curl_init($url);

    curl_setopt($ch, CURLOPT_CUSTOMREQUEST, "PUT");
    curl_setopt($ch, CURLOPT_POSTFIELDS, json_encode($data));
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
    curl_setopt($ch, CURLOPT_HTTPHEADER, array(
        'Content-Type: application/json',
        'Authorization: Basic ' . base64_encode($api_key . ':')
    ));

    $resultado = curl_exec($ch);

    if (curl_errno($ch)) {
        echo 'Erro ao conectar com a API: ' . curl_error($ch);
    } else {
        $resposta = json_decode($resultado, true);
        if (isset($resposta['PIPELINE_ID'])) {
            echo 'Oportunidade transferida para o pipeline com sucesso!';
            // Continuar com a transferência para o estágio correto dentro do pipeline
            toStage($opportunityId, $pipelineId, $stageId);
        } else {
            echo 'Erro ao transferir oportunidade para o pipeline. Resposta completa: ' . $resultado;
        }
    }

    curl_close($ch);
}

// Função para transferir para o estágio correto dentro do pipeline
function toStage($opportunityId, $pipelineId, $stageId) {
    $url = 'https://api.insight.ly/v3.1/Opportunities/' . $opportunityId . '/PipelineStage';
    $api_key = '';// Chave/Token de acesso API
    
    $data = array(
        'PIPELINE_ID' => $pipelineId,
        'PIPELINE_STAGE_CHANGE' => array(
            'STAGE_ID' => $stageId
        )
    );

    $ch = curl_init($url);

    curl_setopt($ch, CURLOPT_CUSTOMREQUEST, "PUT");
    curl_setopt($ch, CURLOPT_POSTFIELDS, json_encode($data));
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
    curl_setopt($ch, CURLOPT_HTTPHEADER, array(
        'Content-Type: application/json',
        'Authorization: Basic ' . base64_encode($api_key . ':')
    ));

    $resultado = curl_exec($ch);

    if (curl_errno($ch)) {
        echo 'Erro ao conectar com a API: ' . curl_error($ch);
    } else {
        $resposta = json_decode($resultado, true);
        if (isset($resposta['PIPELINE_ID'])) {
            echo 'Oportunidade transferida para o estágio correto!';
        } else {
            echo 'Erro ao transferir oportunidade para o estágio correto. Resposta completa: ' . $resultado;
        }
    }

    curl_close($ch);
}

?>
