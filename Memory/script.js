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

function createBackCard(){
    let d = document.createElement("div");
    let txt = '<img src="carta_retro.jpg" alt="retro">';
    d.innerHTML = txt;
    cardsb.push(d);
    return d;
}

function createCard(){
}

function populate(){
    for (let index = 0; index < num; index++) {
        let cardsCol = document.getElementById("cards" + ((index%4)+1));
        console.log("cards" + (index%4)+1);
        const c = createBackCard();
        cardsCol.appendChild(c);
    }
}

