<?php

class Data {

    public function __construct() {

    }

    public static function getDias() {
        return array('Domingo', 'Segunda', 'Terça', 'Quarta', 'Quinta', 'Sexta', 'Sábado');
    }

    public static function getMeses() {
        return array('Janeiro', 'Fevereiro', 'Março', 'Abril', 'Maio', 'Junho', 'Julho', 'Agosto', 'Setembro', 'Outubro', 'Novembro', 'Dezembro');
    }

    public static function getHora24($unixTime = false) {
        if (!$unixTime) {
            $unixTime = time();
        }
        return date('H', $unixTime);
    }

    public static function getHora12($unixTime = false) {
        if (!$unixTime) {
            $unixTime = time();
        }
        return date('h', $unixTime);
    }

    public static function getMin($unixTime = false) {
        if (!$unixTime) {
            $unixTime = time();
        }
        return date('i', $unixTime);
    }

    public static function getSeg($unixTime = false) {
        if (!$unixTime) {
            $unixTime = time();
        }
        return date('s', $unixTime);
    }

    public static function getDia($unixTime = false) {
        if (!$unixTime) {
            $unixTime = time();
        }
        return date('d', $unixTime);
    }

    public static function getDiaSemana($unixTime = false) {
        if (!$unixTime) {
            $unixTime = time();
        }
        return date('w', $unixTime);
    }

    public static function getMes($unixTime = false) {
        if (!$unixTime) {
            $unixTime = time();
        }
        return date('m', $unixTime);
    }

    public static function getAno($unixTime = false) {
        if (!$unixTime) {
            $unixTime = time();
        }
        return date('Y', $unixTime);
    }

    public static function getDiaExt($dia = false) {
        $dias = self::getDias();
        if (($dia < 0) or ($dia > 6) or ($dia === false)) {
            return $dias [date('w')];
        }
        return $dias [$dia];
    }

    public static function getDiaSemanaExt($unixTime = false) {
        if (!$unixTime) {
            $unixTime = time();
        }
        $dia = self::getDiaSemana($unixTime);
        return self::getDiaExt($dia);
    }

    public static function getMesExt($mes = 0) {
        if (!isset($mes)) {
            return false;
        }
        $meses = self::getMeses();
        if (($mes < 1) or ($mes > 12)) {
            return $meses [date('n') - 1];
        }
        return $meses [$mes - 1];
    }

    public static function getUnixTimeAtual() {
        return time();
    }

    public static function getUnixTime($hora, $min, $seg, $mes, $dia, $ano) {
        return mktime(intval($hora), intval($min), intval($seg), intval($mes), intval($dia), intval($ano));
    }

    public static function addZero($num) {
        if ($num < 10) {
            $num = "0{$num}";
        }
        return $num;
    }

    public static function formatTimestamp($timestamp, $format) {
        $ano = $timestamp ['year'];
        $mes = self::addZero($timestamp ['mon']);
        $dia = self::addZero($timestamp ['mday']);
        $diaS = $timestamp ['wday'];
        $hora = self::addZero($timestamp ['hours']);
        $min = self::addZero($timestamp ['minutes']);
        $seg = self::addZero($timestamp ['seconds']);

        switch ($format) {
            case 'AMD' :
                $result = $ano . '/' . $mes . '/' . $dia;
                break;
            case 'AMD-' :
                $result = $ano . '-' . $mes . '-' . $dia;
                break;
            case 'DMA' :
                $result = $dia . '/' . $mes . '/' . $ano;
                break;
            case 'Dext_DMA' :
                $arrayDias = self::getDias();
                $result = $arrayDias [$diaS] . ", " . $dia . '/' . $mes . '/' . $ano;
                break;
            case 'D_Mext_AHMS' :
                $arrayMes = self::getMeses();
                $result = $dia . ' de ' . $arrayMes [$timestamp ['mon'] - 1] . ' de ' . $ano . ' ' . $hora . ':' . $min;
                break;
            case 'AMDHMS' :
                $result = $ano . '/' . $mes . '/' . $dia . ' ' . $hora . ':' . $min . ': ' . $seg;
                break;
            case 'DMAHM' :
                $result = $dia . '/' . $mes . '/' . $ano . ' ' . $hora . ':' . $min;
                break;
            case 'DMAHMS' :
                $result = $dia . '/' . $mes . '/' . $ano . ' ' . $hora . ':' . $min . ': ' . $seg;
                break;
            case 'HM' :
                $result = $hora . ':' . $min;
                break;
            case 'HMDMA' :
                $result = $hora . ':' . $min . ' ' . $dia . '/' . $mes . '/' . $ano;
                break;
        }

        return $result;
    }

    public static function getDataExt($dia = false, $mes = false, $ano = false) {
        $ano = ($ano) ? $ano : self::getAno();
        $mes = ($mes) ? $mes : self::getMes();
        $dia = ($dia) ? $dia : self::getDia();
        $unixTime = self::getUnixTime(0, 0, 0, $mes, $dia, $ano);
        $diaExt = self::getDiaExt(date('w', $unixTime));
        $mesExt = self::getMesExt($mes);
        return $diaExt . ', ' . $dia . ' de ' . $mesExt . ' de ' . $ano;
    }

    public static function getTimeStamp($unixtime = null) {
        if (!empty($unixtime)) {
            $result = getdate($unixtime);
        } else {
            $result = getdate(time());
        }
        return $result;
    }

    public static function getOptionsDia() {
        $array = array();
        for ($i = 1; $i <= 31; $i++) {
            $dia = self::addZero($i);
            $array [$i] = $dia;
        }
        return $array;
    }

    public static function getOptionsMes() {
        $array = array();
        for ($i = 1; $i <= 12; $i++) {
            $mes = self::addZero($i);
            $array [$i] = $mes;
        }
        return $array;
    }

    public static function getOptionsAno($inicio, $fim) {
        if ($inicio < $fim) {
            $ascendente = TRUE;
        } else {
            $ascendente = FALSE;
        }

        $array = array();

        if ($ascendente) {
            for ($i = $inicio; $i <= $fim; $i++) {
                $array [$i] = $i;
            }
        } else {
            for ($i = $inicio; $i >= $fim; $i--) {
                $array [$i] = $i;
            }
        }

        return $array;
    }

    public static function getOptionsHora() {
        $array = array();
        for ($i = 0; $i <= 23; $i++) {
            $hora = self::addZero($i);
            $array [$i] = $hora;
        }
        return $array;
    }

    public static function getOptionsMin() {
        $array = array();
        for ($i = 0; $i <= 59; $i++) {
            $min = self::addZero($i);
            $array [$i] = $min;
        }
        return $array;
    }

    public static function cal($mes = false, $ano = false) {

        $mes = intval($mes);
        $ano = intval($ano);
        $mes = ($mes > 0) ? ($mes) : ((int) date("m"));
        $ano = ($ano > 0) ? ($ano) : ((int) date("Y"));

        $totalDias = date("t", mktime(0, 0, 0, $mes, 1, $ano));
        $weekStart = date("w", mktime(0, 0, 0, $mes, 1, $ano));

        $ct = 0;
        $matrizDias = array();
        $linha = 0;

        for ($i = 0; $i < $weekStart; $i++) {
            $matrizDias [$linha] [] = 0;
            ++$ct;
        }
        for ($d = 1; $d <= $totalDias; $d++) {
            $matrizDias [$linha] [] = $d;
            if ($ct == "6") {
                $ct = -1;
                $linha++;
            }
            $ct++;
        }

        return $matrizDias;
    }

    public static function getUnixInterval($dia = false, $mes = false, $ano = false, $option = 'DIA') {
        $ano = ($ano) ? $ano : self::getAno();
        $mes = ($mes) ? $mes : self::getMes();
        $dia = ($dia) ? $dia : self::getDia();

        switch ($option) {
            case 'DIA' :
                $minUnixTime = self::getUnixTime(0, 0, 0, $mes, $dia, $ano);
                $maxUnixTime = self::getUnixTime(23, 59, 59, $mes, $dia, $ano);
                break;
            case 'SEMANA' :
                $dataReferencia = self::getUnixTime(0, 0, 0, $mes, $dia, $ano);
                $diaSemana = date("w", $dataReferencia);
                $minUnixTime = $dataReferencia - ($diaSemana * self::NUM_SEGUNDOS_DIA());
                $maxUnixTime = $dataReferencia + ((6 - $diaSemana + 1) * self::NUM_SEGUNDOS_DIA()) - 1;
                break;
            case 'MES' :
                $minUnixTime = self::getUnixTime(0, 0, 0, $mes, 1, $ano);
                $ultimoDia = date('t', $minUnixTime);
                $maxUnixTime = self::getUnixTime(23, 59, 59, $mes, $ultimoDia, $ano);
                break;
            case 'ANO' :
                $minUnixTime = self::getUnixTime(0, 0, 0, 1, 1, $ano);
                $maxUnixTime = self::getUnixTime(23, 59, 59, 12, 31, $ano);
                break;
        }
        $result ['min'] = $minUnixTime;
        $result ['max'] = $maxUnixTime;
        return $result;
    }

    public static function getNumDias($mes, $ano) {
        return date('t', mktime(0, 0, 0, $mes, 1, $ano));
    }

    public static function NUM_SEGUNDOS_DIA() {
        return 86400;
    }

    public static function calcSemanasMes($mes, $ano) {
        $diaFinal = self::getNumDias($mes, $ano);
        $semanas = array();
        for ($i = 1; $i <= $diaFinal; $i++) {
            $intervalo = self::getUnixInterval($i, $mes, $ano, "SEMANA");
            $key = $intervalo ['min'] . "_" . $intervalo ['max'];
            $semanas [$key] = 1;
        }
        $keys = array_keys($semanas);
        $semanas = array();
        foreach ($keys as $limite) {
            $data = explode("_", $limite);
            $semanas [] = $data;
        }
        return $semanas;
    }

    public static function getUnixTimeDiaAnterior() {
        $atual = self::getUnixTime(0, 0, 0, self::getMes(), self::getDia(), self::getAno());
        $intervalo = 43200;
        $ontem = $atual - $intervalo;
        return $ontem;
    }

    public function calcTempoPassado($unixTime, $format = true) {
        $unixTime = time() - $unixTime;

        $padraoD = 86400;
        $padraoH = 3600;
        $padraoM = 60;

        $numD = intval($unixTime / $padraoD);
        $restoD = $unixTime % $padraoD;

        $numH = intval($restoD / $padraoH);
        $restoH = $restoD % $padraoH;

        $numM = intval($restoH / $padraoM);

        $result ['d'] = $numD;
        $result ['h'] = $numH;
        $result ['m'] = $numM;

        if ($format) {
            return self::formatTempoPassado($result);
        } else {
            return $result;
        }
    }

    public function formatTempoPassado($tempoPassado) {
        if ($tempoPassado ['d'] > 0) {
            $s = ($tempoPassado ['d'] > 1) ? "s" : "";
            return "{$tempoPassado ['d']} dia{$s} atrás";
        } elseif ($tempoPassado ['h'] > 0) {
            $s = ($tempoPassado ['h'] > 1) ? "s" : "";
            return "{$tempoPassado ['h']} hora{$s} atrás";
        } else {
            $s = ($tempoPassado ['m'] > 1) ? "s" : "";
            return "{$tempoPassado ['m']} minuto{$s} atrás";
        }
    }

    public static function desfotmatForUnixTime($data) {
        
        if($data != ""){
            $dia = substr($data, 0, 2);
            $mes = substr($data, 3, 2);
            $ano = substr($data, 6, 4);

            $unix = self::getUnixTime(0, 0, 0, $mes, $dia, $ano);

        }else{
            $unix = "";
        }

        return $unix;
    }

}

?>