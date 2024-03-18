let num = 0;
let cards = [];
let cardsb = [];
let card1 = null;
let card2 = null;

function takeIn(cardnum){
    num = cardnum.value;
    let i = 1;
    let col = document.getElementById("cards" + i);
    while (col.firstChild) {
        col.removeChild(col.firstChild);
        if (!col.firstChild) {
            i++;
            if (i == 7) break;
            col = document.getElementById("cards" + i);
        }
    }
    cards = [];
    cardsb = [];
    card1 = null;
    card2 = null;
    populate();
}

function activateCard(card){
    let int = parseInt(card.id);
    if (card1){
        card2 = cards[int].firstChild.cloneNode(true);
        card2.id = int;
        card.parentElement.replaceChild(card2.cloneNode(true), card);
        setTimeout(() => {
            if (card1 == null || card2 == null) return;
            if (card1.src != card2.src) {
                document.getElementById(card2.id).parentElement.replaceChild(cardsb[parseInt(card2.id)].firstChild.cloneNode(true), document.getElementById(card2.id));
                document.getElementById(card1.id).parentElement.replaceChild(cardsb[parseInt(card1.id)].firstChild.cloneNode(true), card1);
            }
            card1 = null;
            card2 = null;
        }, 1300);
    }else{
        card1 = cards[int].firstChild.cloneNode(true);
        card1.id = int;
        card.parentElement.replaceChild(card1.cloneNode(true), card);
    }
}

function createBackCard(id){
    let d = document.createElement("div");
    let txt = '<img class="carta" id="' + id + '" src="carta_retro.jpg" alt="retro" onclick="activateCard(this)">';
    d.innerHTML = txt;
    cardsb.push(d);
    return d;
}

function createCard(url){
    let d = document.createElement("div");
    let txt = '<img class="carta" id="0" src="' + url + '" alt="carta">';
    d.innerHTML = txt;
    d.style.visibility="hidden";
    cards.push(d);
    cards.push(d.cloneNode(true));
}

function populate(){
    let cardsTmp = [];
    let n1 = num * 2;
    let n2 = num * 2;
    let colIndex = 0;
    while (n1 > 0) {
        n1 -= 10;
        fetch("https://api.thecatapi.com/v1/images/search?limit=10")
        .then(response => {
            return response.json();
        })
        .then(json => {
            json.forEach(element => {
                cardsTmp.push(element);
            });
            for (let index = 0; index < 10; index++) {
                if (n2 == 0) {
                    cards.sort(() => Math.random() - 0.5);
                    break;
                }
                let cardsCol = document.getElementById("cards" + ((colIndex%6)+1));
                if (n2 <= num) createCard(cardsTmp[index].url);
                const c = createBackCard(cardsb.length);
                cardsCol.appendChild(c);
                n2--;
                colIndex++;
            }
        })
    }
}

