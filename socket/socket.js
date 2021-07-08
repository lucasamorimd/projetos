//const conn = new WebSocket('wss://lad566ws.herokuapp.com/wss');
const conn = new WebSocket('ws://localhost:8085/ws');
conn.onopen = function(e) {
    console.log("Conectado");
    setInterval(ping, 50000);
}

function ping() {
    var obj = "@";
    conn.send(obj);
}
/*
var container = document.getElementById("containerChat");
var form = document.getElementById("butao");
var texto = document.getElementById("mensagem");
var me = document.getElementById("me");
var you = document.getElementById("you");
var cardMe = document.getElementById("cardMe");
var cardYou = document.getElementById("cardYou");
var conteudoMe = document.getElementById("conteudoMe");
var conteudoYou = document.getElementById("conteudoYou");
var meOffset = document.getElementById("meOffset");
var youOffset = document.getElementById("youOffset");
let tudoMe = document.querySelectorAll("#me > *");
let tudoYou = document.querySelectorAll("#you > *");
tudoYou.forEach(console.log);
*/

var butao = document.getElementById("butao");
var texto = document.getElementById("mensagem");
var container = document.getElementById("containerChat");
var CardMensagem = document.getElementById("CardMensagem");
var cardMe = document.getElementById("cardMe");
var meOffset = document.getElementById("meOffset");
var me = document.getElementById("me");
var nomeUser = document.getElementById("nomeUser");
var form = document.getElementById("formMensagem");
var typingTimer; //timer identifier
var doneTypingInterval = 1000; //time in ms, 1 second for example

//on keyup, start the countdown
$(form).keyup(function(e) {
    clearTimeout(typingTimer);
    if ($(form).val) {
        typingTimer = setTimeout(doneTyping, doneTypingInterval);
    }
    var fonkey = e.shiftKey;
    if (e.key != "Enter") {
        conn.send('@dig')
    }

});

function doneTyping() {
    conn.send("@stopDig");
    console.log('parei de digitar');
}
form.addEventListener('keypress', function(e) {
    var fon = e.shiftKey;

    console.log(fon);
    if (e.key === "Enter" && fon != true) {
        e.preventDefault();
        butao.click();
        console.log(e.key);
        e.target.value = "";
    }


});


butao.addEventListener('click', function(e) {
    //e.preventDefault();
    /* var conteudo = document.createTextNode("Eu: " + texto.value);
     var divNova = document.createElement('p');
     divNova.appendChild(conteudo);
     var contentMe = document.querySelector("#contentMe");
     contentMe.appendChild(divNova);
     cardMe.appendChild(contentMe);
     meOffset.appendChild(cardMe);
     me.appendChild(meOffset);
     container.appendChild(me);*/

    var conteudo = document.createTextNode(texto.value);
    var titulo = document.createTextNode("Eu:");
    var divNova = document.createElement('p');
    divNova.appendChild(conteudo);

    var cardTitle = document.createElement('span');
    cardTitle.classList.add("card-title");
    cardTitle.appendChild(titulo);

    var cardContent = document.createElement('div');
    cardContent.classList.add("card-content");
    cardContent.classList.add("white-text");
    cardContent.appendChild(cardTitle);
    cardContent.appendChild(divNova);

    var card = document.createElement('div');
    card.classList.add("card");
    card.classList.add("indigo");
    card.classList.add("darken-3");
    card.appendChild(cardContent);

    var col = document.createElement('div');
    col.classList.add("col");
    col.classList.add("s12");
    col.classList.add("m6");
    col.classList.add("quebra");
    col.appendChild(card);

    var row = document.createElement('div');
    row.classList.add("row");
    row.appendChild(col);

    CardMensagem.appendChild(row);
    window.scroll({ top: 1000000000, left: 0, behavior: 'smooth' });
    var enviar = nomeUser.value + "!:! " + texto.value;

    conn.send(enviar);
    e.target.value = "";
    console.log(enviar);
});

conn.onmessage = function(e) {
    var dados = e.data;
    var testando = dados.split("!:!");
    var conteudo = document.createTextNode(testando[1]);
    var titulo = document.createTextNode(testando[0]);
    var divNova = document.createElement('p');
    var cardTitle = document.createElement('span');
    var cardContent = document.createElement('div');
    var card = document.createElement('div');
    var col = document.createElement('div');
    var row = document.createElement('div');

    if (e.data == "@dig") {
        // console.log(e);
        var digitando = document.getElementById('digitando');
        var camada1 = document.getElementById('camada1');
        var camada2 = document.getElementById('camada2');
        var camada3 = document.getElementById('camada3');
        var camada4 = document.getElementById('camada4');
        var estadigitando = document.createTextNode("");
        //var textoDig = document.textContent("Está digitando");
        digitando.style.display = "block";
        camada4.appendChild(estadigitando);
        camada3.appendChild(camada4);
        camada2.appendChild(camada3);
        camada1.appendChild(camada2);
        digitando.appendChild(camada1);
        //digitando.innerHTML = textoDig;
    }
    if (e.data == "@stopDig") {
        var el = document.getElementById('digitando');
        el.style.display = "none";
    }
    if (e.data != "@" && e.data != "@dig" && e.data != "@stopDig") {
        var el = document.getElementById('digitando');
        el.style.display = "none";
        /* var conteudoYou = document.createTextNode("Ele: " + e.data);
         var divNovaYou = document.createElement('p');
         divNovaYou.appendChild(conteudoYou);
         var contentYou = document.querySelector("#contentYou");
         contentYou.appendChild(divNovaYou);
         cardYou.appendChild(contentYou);
         youOffset.appendChild(cardYou);
         you.appendChild(youOffset);
         container.appendChild(you);*/

        console.log(testando[0] + " é este aqui");

        divNova.appendChild(conteudo);

        cardTitle.classList.add("card-title");
        cardTitle.appendChild(titulo);


        cardContent.classList.add("card-content");
        cardContent.classList.add("white-text");
        cardContent.appendChild(cardTitle);
        cardContent.appendChild(divNova);


        card.classList.add("card");
        card.classList.add("blue-grey");
        card.classList.add("darken-3");
        card.appendChild(cardContent);

        col.classList.add("col");
        col.classList.add("s12");
        col.classList.add("m6");
        col.classList.add("offset-m6");
        col.classList.add("quebra");
        col.appendChild(card);


        row.classList.add("row");
        row.appendChild(col);

        CardMensagem.appendChild(row);
        window.scroll({ top: 1000000000, left: 0, behavior: 'smooth' });

    }

}