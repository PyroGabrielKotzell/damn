function getData(tema){
    const request = new XMLHttpRequest();
    request.open("GET", "https://openlibrary.org/subjects/"+tema+".json?details=true", false); // `false` makes the request synchronous
    request.send(null);
    
    if (request.status === 200) {
      console.log(JSON.parse(request.responseText));
      return JSON.parse(request.responseText)
    }
    else 
        return null;
}





