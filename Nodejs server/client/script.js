function askChange(){
    fetch("http://192.168.4.23:5000/server")
    .then(response => {
        console.log(response);
    })
}