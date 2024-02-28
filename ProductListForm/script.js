let prodotti = [];

function showProducts() {
    list = document.getElementById("product-list");
    list.innerHTML = "";
    prodotti.forEach(product => {
        list.innerHTML += '<div><i>' + product.nome + '</i>, ' +
        product.desc + ', ' + product.categoria + ', ' + product.sconto + ', ' + product.presente + ', ' + product.code +
        '<b style="clear:both; float:right;">&euro; ' + product.prezzo + '</b></div>';
    });
}

function tryAddProd(){
    form = document.querySelector("#prodForm");
    
    codice = form.querySelector("#code").value;
    if (form.querySelector("#deleter").checked) {
        deleteProduct(codice);
        return;
    }

    nome = form.querySelector("#name").value;
    desc = form.querySelector("#descrip").value;
    categoria = form.querySelector("#cat").value;
    prezzo = form.querySelector("#price").value;

    let sconto = null;

    radio = document.getElementById("sconti");
    radio.childNodes.forEach(radioB => {
        if (radioB.checked) sconto = radioB.value;
    });
    
    presente = form.querySelector("#inMagz").checked;

    addProduct(nome, desc, categoria, prezzo, sconto, presente, codice);
}

function addProduct(nome, desc, categoria, prezzo, sconto, presente, codice) {
    if (nome == "") {
        alert("Il nome e' vuoto");
        return;
    }
    if (desc == "") {
        alert("La descrizione e' vuota");
        return;
    }
    if (categoria == null) {
        alert("Errore con la categoria selezionata");
        return;
    }
    if (prezzo == "") {
        alert("Prezzo vuoto");
        return;
    }
    if (sconto == null) {
        alert("Sconto non selezionato");
        return;
    }
    if (codice == "") {
        alert("Il codice e' vuoto");
        return;
    }
    if (searchProd(codice)) {
        alert("Il Codice esiste gia'");
        return;
    }
    let inMag = "";
    if (presente) inMag = "Presente in Magazzino";
    else inMag = "Non presente in Magazzino"

    prodotti.push(product = { nome: nome, desc: desc, categoria: categoria, prezzo: prezzo, sconto: sconto + "%", presente: inMag, code: codice });

    showProducts();
}

function deleteProduct(code) {
    if (codice == "") {
        alert("Il codice e' vuoto");
        return;
    }

    prodToDel = null;

    if ((prodToDel = searchProd(code)) == null) {
        alert("Codice prodotto errato o non esistente");
        return;
    }

    prodotti.splice(prodotti.indexOf(prodToDel), 1);
    
    showProducts();
}

function sortProducts() {
    prodotti.sort(sortingAlg);

    showProducts();
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