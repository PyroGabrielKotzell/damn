let num = takeIn('Quante carte del memory prendo?', "Specifica un numero valido");
let cards = [];
let cardsb = [];
let card1 = null;
let card2 = null;

populate();

function takeIn(message, errorMsg){
    let input = NaN;
    do {
        valido = true;
        input = Number(prompt(message, ''));
        if (input == null) return null;
        if (isNaN(input) || input <= 0) {
            alert(errorMsg);
            valido = false;
        }
    } while (!valido);
    return input;
}

function activateCard(card){
    console.log(card);
}

function createBackCard(id){
    let d = document.createElement("div");
    let txt = '<img class="carta" id="' + id + '" src="carta_retro.jpg" alt="retro" onclick="activateCard(this)">';
    d.innerHTML = txt;
    cardsb.push(d);
    return d;
}

function createCard(url, id){
    let d = document.createElement("div");
    let txt = '<img class="carta" id="' + id + '" src="' + url + '" alt="carta">';
    d.innerHTML = txt;
    d.style.visibility="hidden";
    cards.push(d);
}

function populate(){
    let cardsTmp = [];
    let n1 = num * 2;
    let n2 = num * 2;
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
            return null;
        })
        .then(g => {
            for (let index = 0; index < 10; index++) {
                if (n2 == 0) break;
                let cardsCol = document.getElementById("cards" + ((index%4)+1));
                if (n2 <= num) createCard(cardsTmp[index].url, n2);
                const c = createBackCard(n2);
                cardsCol.appendChild(c);
                n2 -= 1;
            }
        })
    }
}

