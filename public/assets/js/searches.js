let selector = (id) => document.querySelector(id);

let selectorAll = (id) => document.querySelectorAll(id)


selector('#search_input').addEventListener('keyup', async function (e) {
    console.log(e.key)
    if (e.key === "Enter" && this.value != '') {
        let url = `http://localhost/clinicaSite/public/pesquisa-servico/${encodeURI(this.value)}`
        let results = await fetch(url);
        let json = await results.json();
        selector('#search_modal').classList.add('mostrar')
        gerarContent(json)
    }
})
selector('#search_icon').addEventListener('click', async function (e) {
    var input = selector('#search_input').value
    if (input) {
        let url = `http://localhost/clinicaSite/public/pesquisa-servico/${encodeURI(input)}`
        let results = await fetch(url);
        let json = await results.json();
        selector('#search_modal').classList.add('mostrar')
        gerarContent(json)
    }
})
selector('#search_modal').addEventListener('click', (e) => {
    if (e.target.id == 'search_modal') {
        selectorAll('.card').forEach(e => {
            e.remove(e)
        })

        selector('#search_modal').classList.remove('mostrar')
    }
})
function gerarContent(conteudo) {
    if (!conteudo.erro) {
        conteudo.results.map((e) => {
            var card = document.createElement('div'),
                cardheader = document.createElement('h5'),
                br = document.createElement('br')

            cardheader.classList.add('card-header')
            card.classList.add('card')

            cardheader.innerHTML = e.servico
            card.appendChild(cardheader)

            for (var i = 0; i < e.unidades.length; i++) {
                var cardtitle = document.createElement('h5'),
                    cardtext = document.createElement('p'),
                    cardbody = document.createElement('div'),
                    btn = document.createElement('a'),
                    link = `http://localhost/clinicaSite/public/unidades/${e.unidades[i].id_unidade}/${e.tipo_servico}/${e.id_servico}/agendar`

                cardbody.classList.add('card-body')
                btn.classList.add('btn')
                btn.classList.add('btn-danger')
                cardtext.classList.add('card-text')
                cardtitle.classList.add('card-title')

                btn.setAttribute('href', link)
                btn.innerHTML = 'Agendar'
                cardtext.innerHTML = e.unidades[i].endereco_unidade
                cardtitle.innerHTML = e.unidades[i].nome_unidade
                cardbody.appendChild(cardtitle)
                cardbody.appendChild(cardtext)
                cardbody.appendChild(btn)
                card.appendChild(
                    cardbody
                )
            }
            card.appendChild(br)
            card.appendChild(br)
            selector('#search_content').appendChild(card)

            /* cardtitle.classList.add('card-title')
            cardtitle.innerHTML = e.servico
            
            cardbody.appendChild(cardtitle)
            cardbody.appendChild(cardtext)
            cardbody.appendChild(btn)
            cardheader.classList.add('card-header')
            cardheader.innerHTML = e.servico
            card.appendChild(cardbody)
            card.appendChild(cardheader)
            */

        })
    }
}
function gerarUnidade(e) {
    var cardtitle = document.createElement('h5'),
        cardtext = document.createElement('p'),
        cardbody = document.createElement('div'),
        btn = document.createElement('a')

    cardbody.classList.add('card-body')
    btn.classList.add('btn')
    btn.classList.add('btn-primary')
    cardtext.classList.add('card-text')
    cardtitle.classList.add('card-title')

    var link = `http://localhost/clinicaSite/public/unidades/${e.unidade.id_unidade}/${e.tipo_servico}/${e.id_servico}/agendar`
    btn.setAttribute('href', link)
    btn.innerHTML = e.unidade.nome_unidade
    cardtext.innerHTML = e.unidade.endereco_unidade
    cardtitle.innerHTML = e.unidade.nome_unidade
    cardbody.appendChild(cardtitle)
    cardbody.appendChild(cardtext)
    cardbody.appendChild(btn)
}