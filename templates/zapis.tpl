<form name="forma_zamowienia" accept-charset="utf-8" action="#">

    <p class="start">Formularz zamówień</p>
    <table class="tabela">
        <tr>
            <td class="text">Produkt:</td>
            <td><input class="input" type="text" name="nazwa" id="nazwa" maxlength="30" placeholder="Nazwa produktu"
                       required/></td>
        </tr>
        <tr>
            <td class="text">Ilość:</td>
            <td><input class="input" type="text" name="ilosc" id="ilosc" maxlength="30" placeholder="Ilość"
                       required/></td>
        </tr>
        <tr>
            <td class="text">Wersja:</td>
            <td>
                <select name="wersja" id="wersja">
                    <option value="Podstawowy">Podstawowa</option>
                    <option value="Sredni">Niektóre dodatki</option>
                    <option value="Wysoki">Wszystkie dodatki</option>
                </select>
            </td>
        </tr>
        <tr>
            <td>
                <button class="submit" onclick="wyslij()">Wyślij dane</button>
            </td>
        </tr>
    </table>
</form>



