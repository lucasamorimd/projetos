<?php

namespace src\controllers;

use \core\Controller;
use \src\handlers\handlerLogin;
use \src\models\Agendamento;
use \src\handlers\handlerAgendamento;
use DateTime;

class AgendamentosController extends Controller
{

    private $loggedUser;
    public function __construct()
    {
        $this->loggedUser = handlerLogin::checkLogin();
        if ($this->loggedUser === false) {
            $this->redirect('/unsigned');
        }
    }
    public function agendarServico()
    {
        $params = filter_input_array(INPUT_POST, FILTER_DEFAULT);
        $arrayData = explode('/', $params['data_atendimento']);
        $ano = $arrayData[2];
        $mes = $arrayData[1];
        $dia = $arrayData[0];
        $data_selecionada = new DateTime(date("Y-m-d", mktime(0, 0, 0, $mes, $dia, $ano)));
        $verifica_data = Agendamento::select('id_agendamento')
            ->where('tipo_atendimento', $params['tipo_atendimento'])
            ->where('data_atendimento', $data_selecionada->format('Y-m-d'))
            ->where('hora_atendimento', $params['hora_atendimento'])
            ->where('situacao', 'pendente')
            ->one();
        if ($verifica_data === false) {
            Agendamento::insert(
                [
                    'id_usuario' => $this->loggedUser->id_usuario,
                    'id_unidade' => $params['id_unidade'],
                    'id_servico' => $params['id_servico'],
                    'id_medico' => $params['id_medico'],
                    'nome_paciente' => $params['nome_paciente'],
                    'email_paciente' => $params['email_paciente'],
                    'telefone_paciente' => $params['telefone_paciente'],
                    'tipo_atendimento' => $params['tipo_atendimento'],
                    'nome_atendimento' => $params['nome_atendimento'],
                    'data_atendimento' => $data_selecionada->format('Y-m-d'),
                    'hora_atendimento' => $params['hora_atendimento'],
                    'preco_servico' => $params['preco']

                ]
            )->execute();
            $_SESSION['type'] = 'success';
            $_SESSION['swal'] = ucfirst($params['nome_atendimento']) . " agendado com sucesso!";
            $this->redirect('/' . $params['tipo_atendimento'] . '/agendados');
        }
        $_SESSION['type'] = 'error';
        $_SESSION['swal'] = "Houve algum erro no agendamento!";
        $this->redirect('/unidades/' . $params['id_unidade'] . '/exames/' . $params['id_servico'] . '/agendar');
    }
    public function solicitar($id)
    {

        $dados_solicitar_servico = handlerAgendamento::getDadosSolicitarServico($id);


        $datas = "'" . implode("','", $dados_solicitar_servico['datas_disponiveis']) . "'";

        $array = [
            'usuario_dados' => ['usuario' => $this->loggedUser],
            'dados_solicitar_servico' => $dados_solicitar_servico,
            'datas_disp' => $datas,
            'id_servico' => $id['idservico'],
            'nome_servico' => $id['nomeservico']
        ];

        $this->render('solicitar', $array);
    }

    public function horariosAjax()
    {

        $horarios = handlerAgendamento::getHorarios($_POST['key'], $_POST['idUnidade'], $_POST['idServico'], $_POST['nomeServico']);
        echo json_encode($horarios);
    }

    public function listarServico($data)
    {
        /*if ($data['situacao'] == 'agendados') {
            $data['situacao'] = 'pendente';
        } elseif($data['situacao']=='') {
            $data['situacao'] = 'realizado';
        }*/
        if ($data['situacao'] == 'agendados') {
            $data['situacao'] = 'pendente';
        } elseif ($data['situacao'] == 'realizados') {
            $data['situacao'] = 'realizado';
        } else {
            $data['situacao'] = 'aguardando-resultado';
        }
        $dados = array(
            'situacao' => $data['situacao'],
            'id_usuario' => $this->loggedUser->id_usuario,
            'tipo_atendimento' => $data['servico']
        );
        $dados_agendamentos = handlerAgendamento::listarAgendamentos($dados);

        $array = array(
            'usuario_dados' => $this->loggedUser,
            'dados_agendamentos' => $dados_agendamentos,
            'tipo_atendimento' => $data['servico']
        );
        $this->render('agendamentos', $array);
    }
}
