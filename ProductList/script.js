let prodotti = [];

function showProducts() {
    list = document.getElementById("product-list");
    list.innerHTML = "";
    prodotti.forEach(product => {
        list.innerHTML += '<div><i>' + product.nome + '</i>, ' + product.desc + ', ' + product.prezzo + '<b style="clear:both; float:right;">&euro; ' + product.code + '</b></div>';
    });
}

function addProduct() {
    let input1 = takeIn('Specifica il nome del prodotto', "Il nome non puo' essere vuoto");
    if (input1 == null) return;

    let input2;
    loop: while(true){
        input2 = takeIn('Specifica il codice del prodotto', "Il codice non puo' essere vuoto");
        if (input2 == null) return;
        if (searchProd(input2)) {
            alert("Codice prodotto gia' esistente");
            continue loop;
        } else break;
    }

    let input3 = takeIn('Specifica la descrizione del prodotto', "La descrizione non puo' essere vuota");
    if (input1 == null) return;

    let input4 = takeIn('Specifica il prezzo del prodotto', "Prezzo non valido");
    if (input1 == null) return;

    prodotti.push(product = { nome: input1, desc: input3, prezzo: input4, code: input2 });

    showProducts();
}

function deleteProduct() {
    let input;
    prodToDel = null;
    loop: while(true){
        input = takeIn('Specifica il codice del prodotto', "Il codice non puo' essere vuoto");
        if (input == null) return;
        if ((prodToDel = searchProd(input)) == null) {
            alert("Codice prodotto non esistente");
            continue loop;
        } else break;
    }

    prodotti.splice(prodotti.indexOf(prodToDel), 1);
    
    showProducts();
}

function sortProducts() {
    prodotti.sort(sortingAlg);

    showProducts();
}

function takeIn(message, errorMsg){
    let input = "";

    do {
        valido = true;
        input = prompt(message, '');
        if (input == null) return null;
        if (input == "") {
            alert(errorMsg);
            valido = false;
        }
    } while (!valido);
    return input;
}

function searchProd(code){
    return prodotti.find(prod => {
        return code === prod.code;
    });
}

function sortingAlg(a, b){
    if (a.nome > b.nome) return 1;
    if (a.nome == b.nome) return 0;
    return -1;
}