async function selecionarData(data) {

    console.log(data.dados)
    const { value: fruit } = await Swal.fire({
        title: 'Escolha o dia do exame',
        input: 'select',
        inputOptions: {
            'Datas': data.dados
        },
        inputPlaceholder: 'Datas disponíveis',
        showCancelButton: true,
        inputValidator: (value) => {
            return new Promise((resolve) => {
                console.log(data.dados[value]);
                if (value) {
                    resolve()
                } else {
                    resolve('Selecione uma data')
                }
            })
        }
    })
    if (fruit) {
        var button = document.getElementById('selectData');
        Swal.fire(`Data selecionada: ${data.dados[fruit]}`)
        button.value = data.dados[fruit]
    }

}
async function selecionarMedico(data) {

    var obj = Object.entries(data)
    var map = new Map(obj);
    console.log(map.values())
    const { value: fruit } = await Swal.fire({
        title: 'Escolha um médico responsável pelo exame',
        input: 'select',
        inputOptions: {
            'Datas': map
        },
        inputPlaceholder: 'medicos dispoíveis',
        showCancelButton: true,
        inputValidator: (value) => {
            return new Promise((resolve) => {
                console.log(data.dados[value]);
                if (value) {
                    resolve()
                } else {
                    resolve('Selecione uma data')
                }
            })
        }
    })
    if (fruit) {
        var button = document.getElementById('selectData');
        Swal.fire(`Data selecionada: ${data.dados[fruit]}`)
        button.value = data.dados[fruit]
    }

}

function selecionarHora(dados) {
    var data_atendimento = document.getElementById('selectData').value;
    var id_medico = document.getElementById('id_medico').value;
    if (id_medico) {
        console.log(id_medico)
        if (!data_atendimento) {
            Swal.fire(`Escolha primeiro uma data!!`)
        } else {
            $.ajax({
                url: dados.base + '/gethorarios/servico',
                type: 'post',
                // dataType: 'json',
                data: {
                    key: data_atendimento,
                    idUnidade: dados.idUnidade,
                    idServico: dados.idServico,
                    nomeServico: dados.nomeServico,
                    idMedico: id_medico
                },
                success: function (resultado) {
                    swalHorario(resultado)
                }

            });
        }
    } else {
        Swal.fire(`Escolha um médico!`)
    }
}

async function swalHorario(data) {
    data = JSON.parse(data);
    console.log(data);
    const { value: hora } = await Swal.fire({
        title: 'Escolha o Horário do exame',
        input: 'select',
        inputOptions: {
            'Horários': data.horarios
        },
        inputPlaceholder: 'Horários disponíveis',
        showCancelButton: true,
        inputValidator: (value) => {
            return new Promise((resolve) => {
                if (value) {
                    resolve()
                } else {
                    resolve('Selecione um horário disponível')
                }
            })
        }
    })
    if (hora) {
        var button = document.getElementById('selectHora');
        Swal.fire(`Data selecionada: ${data.horarios[hora]}`)
        button.value = data.horarios[hora]
    }
}
function submitar() {
    let horario = document.getElementById('selectHora').value;
    let medico = document.getElementById('id_medico').value;
    let data = document.getElementById('selectData').value;
    if (horario && medico && data) {
        document.getElementById('formSolicitarExame').submit()
    } else {
        Swal.fire('Escolha um médico, data e horário para prosseguir!')
    }
}
