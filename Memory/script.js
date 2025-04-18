let num = 0;
let cards = [];
let cardsb = [];
let selected = [];

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
    selected = [];
    populate();
}

function activateCard(card){
    let int = parseInt(card.id);
    if (selected.length == 2) return;
    if (selected.length > 0){
        selected.push(card);
        card.onclick = null;
        card.src = cards[int].src;
        if (selected[0].src == selected[1].src) {
            selected[0].style.borderColor = selected[1].style.borderColor = "white";
            selected.splice(0, 2);
        }
        else setTimeout(() => {
            let element1 = document.getElementById(selected[0].id);
            let element2 = document.getElementById(selected[1].id);
            selected[0].src = selected[1].src = "carta_retro.jpg";
            selected[0].onclick = () => {activateCard(element1)};
            selected[1].onclick = () => {activateCard(element2)};
            selected.splice(0, 2);
        }, 900);
        return;
    }
    selected.push(card);
    card.onclick = null;
    card.src = cards[int].src;
}

function createBackCard(id){
    let img = document.createElement("img");
    img.className = "carta";
    img.id = id;
    img.src = "carta_retro.jpg";
    img.alt = "retro";
    img.onclick = () => {activateCard(img)};
    cardsb.push(img);
    return img;
}

function createCard(url){
    let img = document.createElement("img");
    img.src = url;
    img.alt = "carta";
    img.hidden = true;
    cards.push(img);
    cards.push(img.cloneNode(true));
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

