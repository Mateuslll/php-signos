<?php include('layouts/header.php'); ?>

<div class="container mt-5">
    <?php
    $data_nascimento = $_POST['data_nascimento'];

    $signos = simplexml_load_file('signos.xml');

    $data_formatada = date('d/m', strtotime($data_nascimento));

    function verificarSigno($data_nascimento, $data_inicio, $data_fim) {
        $data_nasc = DateTime::createFromFormat('d/m', $data_nascimento);
        $inicio = DateTime::createFromFormat('d/m', $data_inicio);
        $fim = DateTime::createFromFormat('d/m', $data_fim);

        if ($inicio > $fim) {
            return ($data_nasc >= $inicio || $data_nasc <= $fim);
        } else {
            return ($data_nasc >= $inicio && $data_nasc <= $fim);
        }
    }

    $signo_encontrado = false;
    foreach ($signos->signo as $signo) {
        $data_inicio = (string) $signo->dataInicio;
        $data_fim = (string) $signo->dataFim;

        if (verificarSigno($data_formatada, $data_inicio, $data_fim)) {
            echo "<h2>Seu signo é: " . $signo->signoNome . "</h2>";
            echo "<p>" . $signo->descricao . "</p>";
            $signo_encontrado = true;
            break;
        }
    }

    if (!$signo_encontrado) {
        echo "<p>Não foi possível identificar seu signo.</p>";
    }
    ?>
    <a href="index.php" class="btn btn-secondary mt-3">Voltar</a>
</div>

</body>
</html>