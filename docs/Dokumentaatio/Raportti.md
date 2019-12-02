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

## Istunnot

Käyttäjän kirjauduttua istunto tallennetaan tietokantaan ja voimassa olevia istuntoja on mahdollista hallita Session sivulta, joka löytyy käyttäjänimen alta valikosta.

## Asetukset

Käyttäjä voi muokata tilin tietoja ja asetuksia asetukset sivulla, joka löytyy käyttäjänimen alta valikosta.

## Tietokanta

[Linkki tietokannan dokumenttiin](Tietokanta.md)

## API

[Linkki API:n dokumenttiin](API.md)