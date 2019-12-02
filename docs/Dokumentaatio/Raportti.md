# Raportti

## Johdanto

MyMovieDatabase lyhyemmin MyMDB on elokuvakeräilijöille suunnattu sivusto, jolla on mahdollista pitää kirjaa elokuvakokoelmasta. 
Käyttäjätunnukset voi luoda kuka tahansa rekisteröitymislomakkeen avulla ja käyttäjätunnuksien luomisen jälkeen käyttäjä voi alkaa 
lisätä tietokantaan elokuviaan, ja tallentaa niistä tarkat tiedot ylös. Elokuvien lisäyksen yhteydessä käyttäjät voivat tietojen kirjoittamisen
sijasta hyödyntää imdb-tietokantaa, josta tiedot voidaan hakea automaattisesti imdbID:n avulla. Käyttäjien on myös mahdollista muokata elokuvien 
tyyppi valikoimaan profiilinsa asetuksien kautta. Jokaisella käyttäjällä on olemassa valmiina yleisimmät elokuvatyypit, mutta näiden lisäksi, 
jokainen voi lisätä henkilökohtaisia vaihtoehtoja. Elokuvalistauksen käyttäjät voivat nähdä ruutu tai lista näkymässä ja käyttäjät näkevät vain itse
lisäämänsä elokuvat.

## Yleistä

Sivusto on toteutettu käyttämällä Laravel alustaa, sekä PHP-, jQuery- ja JavaScript kieliä hyödyntämällä. Sivuston pääsisältö noudetaan hyödyntämällä API:ta ja
AJAX-kutsuja jQuerylla toteutettuna. Ainoastaan settings ja sessions sivujen tiedot luetaan ja tallennetaan PHP:llä Laravelin tietokanta yhteyksiä hyödyntämällä.
Elokuvien tiedot imdb-kannata haetaan hyödyntämällä [OMDb API:ta](http://www.omdbapi.com/).

## Istunnot

Käyttäjän kirjauduttua istunto tallennetaan tietokantaan ja voimassa olevia istuntoja on mahdollista hallita Session sivulta, joka löytyy käyttäjänimen alta valikosta.

## Asetukset

Käyttäjä voi muokata tilin tietoja ja asetuksia asetukset sivulla, joka löytyy käyttäjänimen alta valikosta.

## Tietokanta

[Linkki tietokannan dokumenttiin](Tietokanta.md)

## OMDb API

[OMDb API:ta](http://www.omdbapi.com/) hyödynnetään elokuvatietojen noutamisessa imdbID:n avulla ja koska tämä vaatii oman API-avaimen. Loin oman API kutsun, joka tekee
kutsun OMDb API rajapintaan palvelimen puolelta, jottei API-avainta tarvitsisi tallentaa käyttäjän puolelle.

## API

[Linkki API:n dokumenttiin](API.md)

## Sivustorakenne

![](../images/sivustorakenne.PNG)

## Kansiorakenne

Peruskansio rakenne. Laravellin kansio rakenteen monimutkaisuuden takia olen jättänyt pois suurenmäärän kansioita. Kuvassa vain mainitsemisen arvoiset kansiot.

```
laravel
|
|
|
|
|
|
|
|
|---public
    ----css
        auth.css
        bootstrap.min.css
        movies.css
        sessions.css
        settings.css
        styles.css
    ----js
        ----movies
            imdbUpdate.js
            movies.js
            saveMovie.js
            viewSelector.js
        app.js
        cookie.js
        jquery-3.4.1.min.js
        pagination.js
        settings.js
    ----img
        grid-three.up.svg
        home-bg.jpg
        imdb_logo.jpg
        list.svg
        no-poster-available.jpg
        pencil.svg
        rotten_tomatoes_logo.png
        trash.svg
|
|---resources
    ---views
        ----auth
            ----passwords
                change.blade.php
            login.blade.php
            register.blade.php
            session.blade.php
        ----layouts
            app.blade.php
        ----movies
            detail.blade.php
            movie.blade.php
            view.blade.php
        home.blade.php
        settings.blade.php
        welcome.blade.php
|
|---routes
    api.php
    web.php
|
|.env
|



```