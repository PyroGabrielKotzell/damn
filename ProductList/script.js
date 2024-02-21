let prodotti = [];

function showProducts() {
    list = document.getElementById("product-list");
    list.innerHTML = "";
    prodotti.forEach(product => {
        list.innerHTML += '<div><i>'+product.nome+'</i>'+'<b style="clear:both; float:right;">'+product.code+'</b></div>';
    });
}

function addProduct() {
    let input1 = prompt('Specifica il nome del prodotto', '');
    let input2 = "";

    do{
        input2 = prompt('Specifica il codice del prodotto', '');

        thereIs = prodotti.find(prod => {
            return input2 === prod.code; 
        }) != null;

        if (thereIs) alert("Codice prodotto già esistente");
    }while (thereIs);

    prodotti.push(
        product = {
            nome: input1,
            code: input2
        }
    )

    showProducts();
}

function deleteProduct() {
    if (prodotti.includes(a)) prodotti.splice(prodotti.indexOf(a), 1);
    showProducts();
}

function sortProducts() {
    prodotti.sort(sortingAlg);
}

function sortingAlg(a, b){
    if (a.name > b.name) return 1;
    if (a.name == b.name) return 0;
    return -1;
}