function swalCancelar(dados) {
    console.log(dados)
    Swal.fire({
        title: "Confirmar Cancelamento",
        text: "Deseja cancelar este agendamento?",
        icon: "warning",
        showCancelButton: true,
        confirmButtonColor: "#dc3545",
        confirmButtonText: "Confirmar",
        cancelButtonText: "Cancelar",
    }).then((result) => {
        if (result.value) {
            $.ajax({
                type: "post",
                url: dados.base + '/cancelar-agendamento',
                data: {
                    idAgendamento: dados.idAgendamento,
                    tipoAgendamento: dados.tipoAgendamento,
                    idUsuario: dados.idUsuario,
                    nomeAtendimento: dados.nomeAtendimento
                },
                dataType: 'json',
                success: function (resultado) {
                    if (resultado === 1) {
                        Swal.fire({
                            icon: 'success',
                            title: dados.nomeAtendimento,
                            text: 'Agendamento cancelado com sucesso',
                            footer: dados.tipoAgendamento,
                            showConfirmButton: true
                        }).then(() => {
                            window.location.href = dados.base + '/' + dados.tipoAgendamento + '/agendados'
                        })
                    } else {
                        Swal.fire({
                            icon: 'error',
                            title: dados.nomeAtendimento,
                            text: 'Erro no cancelamento, tente novamente',
                            footer: dados.tipoAgendamento,
                            showConfirmButton: false,
                            timer: 2500
                        }).then(() => {
                            Swal.dismiss()
                        })
                    }
                }
            })
        }
    })
}