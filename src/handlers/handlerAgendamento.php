<?php

namespace src\handlers;

use \src\models\Servico;
use \src\models\Unidade;
use \src\models\Medico_servico;
use \src\models\Medico;
use \src\models\Agendamento;
use DateTime;
use DatePeriod;
use DateInterval;

class handlerAgendamento
{

    public static function getDadosSolicitarServico($id)
    {

        //SELECIONA NO BANCO O SERVICO QUE VAI SER SOLICITADO
        $servico = Servico::select()->where('id_servico', $id['idservico'])->one();


        //SELECIONA NO BANCO OS MÉDICOS QUE FAZEM ESSE EXAME
        $id_medicos_disp = Medico_servico::select()
            ->where('id_servico', $id['idservico'])
            ->where('nome_servico', $id['nomeservico'])
            ->get();

        //ARRAY VAZIO
        $dados_medico = [];

        if (count($id_medicos_disp)) {
            foreach ($id_medicos_disp as $id_medico) {
                $id_medicos[] = $id_medico['id_medico'];
            }
            $dados_medico = Medico::select()
                ->where('id_unidade', $id['idunidade'])
                ->whereIn('id_medico', $id_medicos)
                ->get();
        }

        //SELECIONA A UNIDADE QUE FOI ESCOLHIDA PELO USUÁRIO
        $unidade = Unidade::select()
            ->where('id_unidade', $id['idunidade'])
            ->one();

        //SELECIONA TODOS OS AGENDAMENTOS
        $agendamentos = Agendamento::select()
            ->where('tipo_atendimento', $id['nomeservico'])
            ->where('id_unidade', $id['idunidade'])
            ->where('id_servico', $id['idservico'])
            ->execute();

        //CRIANDO PERÍODO MENSAL PARA O INPUT SELECT
        $mes = date('m');
        $ano = date('Y');
        $inicio = new DateTime(date('Y-m-d'));
        $inicio->add(new DateInterval('P1D'));
        $fim = new DateTime(date("Y-m-t", mktime(0, 0, 0, $mes, '01', $ano)));
        $periodo = new DatePeriod($inicio, new DateInterval('P1D'), $fim);

        //CRIANDO O PERÍODO DIÁRIO EM HORAS
        $horario_inicio = new DateTime(date('H:i', mktime(8, 0)));
        $horario_fim = new DateTime(date('H:i', mktime(18, 0)));
        $horarios = new DatePeriod($horario_inicio, new DateInterval('PT2H30M'), $horario_fim);


        //ARRAY VAZIOS QUE VÃO RECEBER AS DATAS E HORAS QUE JÁ TEM AGENDAMENTO
        $horarios_indisp = [];
        $data_indisp = [];

        //ITERAÇÃO PARA COLOCAR CADA DATA E HORÁRIO INDISPONÍVEL NO ARRAY VAZIO
        foreach ($agendamentos as $agendamento) {
            $data_indisp[] = $agendamento['data_atendimento'];
            $horarios_indisp[] = $agendamento['hora_atendimento'];
        }

        //ARRAYS VAZIOS QUE VÃO RECEBER AS DATAS E HORAS VÁLIDAS
        $horarios_validos = [];
        $datas_validas = [];

        //ITERAÇÃO PARA COLOCAR OS HORÁRIOS VALIDOS NO ARRAY DE HORARIOS
        foreach ($horarios as $hora) {
            if ($hora->format('H:i') != '12:00') {
                $horarios_validos[] = $hora->format('H:i');
            }
        }



        //ITERAÇÃO PARA COLOCAR AS DATAS VÁLIDAS NO ARRAY DE DATAS
        foreach ($periodo as $item) {
            $inicial_dia = substr($item->format("D"), 0, 1);
            $datas_cheias = Agendamento::select('hora_atendimento')
                ->where('data_atendimento', $item->format('Y-m-d'))
                ->where('tipo_atendimento', $id['nomeservico'])
                ->where('id_unidade', $id['idunidade'])
                ->where('id_servico', $id['idservico'])
                ->execute();
            $verifica_horarios = count($horarios_validos) - count($datas_cheias);
            if ($inicial_dia != 'S' && $verifica_horarios > 0) {
                $datas_validas[] = $item->format('d/m/Y');
            }
        }

        $array = array(
            'servico' => $servico,
            'medicos' => $dados_medico,
            'unidade' => $unidade,
            'datas_disponiveis' => $datas_validas
        );

        return $array;
    }

    public static function getHorarios($data, $idUnidade, $idServico, $nome_servico, $idMedico)
    {
        $arrayData = explode('/', $data);
        $ano = $arrayData[2];
        $mes = $arrayData[1];
        $dia = $arrayData[0];
        $data_selecionada = new DateTime(date("Y-m-d", mktime(0, 0, 0, $mes, $dia, $ano)));
        $agendamentos = Agendamento::select()
            ->where('tipo_atendimento', $nome_servico)
            ->where('id_unidade', $idUnidade)
            ->where('id_medico', $idMedico)
            ->where('data_atendimento', $data_selecionada->format('Y-m-d'))
            ->execute();
        $hora_indisp = [];
        $hora_disp = [];

        foreach ($agendamentos as $agendamento) {
            $hora_indisp[] = $agendamento['hora_atendimento'];
        }

        $horario_inicio = new DateTime(date('H:i', mktime(8, 0)));
        $horario_fim = new DateTime(date('H:i', mktime(18, 0)));
        $hora_atual = date('H:i');
        $horarios = new DatePeriod($horario_inicio, new DateInterval('PT2H30M'), $horario_fim);

        foreach ($horarios as $hora) {
            if ($hora->format('H:i') != '12:00' && !in_array($hora->format('H:i:s'), $hora_indisp)) {
                $hora_disp[] = $hora->format('H:i');
            }
        }

        return array('horarios' => $hora_disp);
    }
    public static function listarAgendamentos($data)
    {
        $data_agendamentos = Agendamento::select()
            ->join('unidades as u', 'agendamentos.id_unidade', '=', 'u.id_unidade')
            ->join('servicos as s', 'agendamentos.id_servico', '=', 's.id_servico')
            ->join('medicos as m', 'agendamentos.id_medico', '=', 'm.id_medico')
            ->join('prontuarios as p', 'agendamentos.id_prontuario', '=', 'p.id_prontuario')
            ->where('id_usuario', $data['id_usuario'])
            ->where('tipo_atendimento', $data['tipo_atendimento'])
            ->where('situacao', $data['situacao'])
            ->get();

        return $data_agendamentos;
    }
}
