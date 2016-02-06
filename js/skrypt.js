isOffline = false; //Zmienna ustawiajaca tryb offline/online
interval = null;

//Funkcja sprawdzajaca czy Ilosc jest liczba
function sprawdz(ilosc) {

    var ilosc = document.getElementById('ilosc').value;

    var sprawdzone = ilosc.match("^[0-9]+$") != null;

    return sprawdzone;
}

//Funkcja wywolywana gdy polaczenie zostanie utracone
function utracone() {
    console.log("Brak połączenia!");
    isOffline = true;
    zapiszDoLocalStorage();
}

//Funkcja zapisujaca do lokalnej pamieci i sprawdzajaca polaczenie co 30000ms
function zapiszDoLocalStorage() {
    if (interval == null) {
        interval = setInterval(sprawdzPolaczenie, 30000);
    }
    var nazwa = document.getElementById('nazwa').value;
    var ilosc = document.getElementById('ilosc').value;
    var wersja = document.getElementById('wersja').value;

    var rec = {'nazwa': nazwa, 'ilosc': ilosc, 'wersja': wersja}
    localStorage.setItem(localStorage.length, JSON.stringify(rec));

}

//Funkcja zapisujaca ktore pobrane sa z local storage
function zapiszDane() {
    var url = 'index.php?sub=baza&action=zapis';

    for (var i = 0; i < localStorage.length; i++) {
        var tab = JSON.parse(localStorage.getItem(i));
        var json_data = "{\"nazwa\":\"" + tab['nazwa'] + "\",\"ilosc\":\"" + tab['ilosc'] + "\",\"login\":\"" + tab['login'] + "\"}";
        var msg = "data=" + encodeURIComponent(json_data);
        przejdz(url, msg);
    }
    localStorage.clear();
}

//funkcja sprawdzajaca polaczenie
function sprawdzPolaczenie() {
    var url = 'index.php?sub=connection&action=check';
    var xmlHttpReq = false;
    var self = this;

    if (window.XMLHttpRequest) {
        self.xmlHttpReq = new XMLHttpRequest();
    } else if (window.ActiveXObject) {
        self.xmlHttpReq = new ActiveXObject("Microsoft.XMLHTTP");
    }
    self.xmlHttpReq.onreadystatechange = function () {
        if (self.xmlHttpReq.readyState == 4) {
            if (self.xmlHttpReq.status == 200) {
                console.log('masz juz polaczenie');
                isOffline = false;
                clearInterval(interval);
                interval = null;
                zapiszDane();
            }
        }
    };


    self.xmlHttpReq.open('GET', url);
    self.xmlHttpReq.send();

}

//Funkcja pobierajaca dane z formularza zamowien i zapisujaca je
function wyslij() {
    var nazwa = document.getElementById('nazwa').value;
    var ilosc = document.getElementById('ilosc').value;
    var wersja = document.getElementById('wersja').value;

    if (sprawdz(ilosc)) {

        var json_data = "{\"nazwa\":\"" + nazwa + "\",\"ilosc\":\"" + ilosc + "\",\"wersja\":\"" + wersja + "\"}";
        var msg = "data=" + encodeURIComponent(json_data);
        var url = 'index.php?sub=baza&action=zapis';

        przejdz(url, msg);
    } else {
        document.getElementById('wynik').innerHTML = "Wprowadź prawidłowe dane!";
    }
}

//Funkcja obslugujaca XHR
function przejdz(url, msg) {
    var xmlHttpReq = false;
    var self = this;

    if (window.XMLHttpRequest) {

        self.xmlHttpReq = new XMLHttpRequest();
    } else if (window.ActiveXObject) {

        self.xmlHttpReq = new ActiveXObject("Microsoft.XMLHTTP");
    }


    self.xmlHttpReq.onreadystatechange = function () {

        if (self.xmlHttpReq.readyState == 4) {

            if (self.xmlHttpReq.status == 200) {
                document.getElementById('wynik').innerHTML = self.xmlHttpReq.responseText;
            } else if (self.xmlHttpReq.status == 401) {
                document.getElementById('wynik').innerHTML = "Najpierw się zaloguj!";
            }
        }
    };


    self.xmlHttpReq.onerror = utracone;

    self.xmlHttpReq.open('POST', url);
    self.xmlHttpReq.setRequestHeader("X-Requested-With", "XMLHttpRequest");
    self.xmlHttpReq.setRequestHeader("Content-Type", "application/x-www-form-urlencoded; ");
    self.xmlHttpReq.setRequestHeader("Content-length", msg.length);

    self.xmlHttpReq.send(msg);

}