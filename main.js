// global
let lagredeOrdre = [];

//constructor
function Bestilling(vare, vareKvantum, tillegg, tilleggKvantum) {
    this.vare = vare
    this.vareKvantum = vareKvantum
    this.tillegg = tillegg
    this.tilleggKvantum = tilleggKvantum
    this.info = function() {
        console.log(vare, 'bestilt', vareKvantum,'stk,', tillegg, tilleggKvantum, 'stk');
    }
}


//lagrer objekt i matrisen
function lagreBestilling(bestilling) {
    lagredeOrdre.push(bestilling);
}


// FJERN DISSE 4 LINJENE NÅR SQL KOBLINGER ER MULIGE FRA FRONTEND ! 
const bestilling1 = new Bestilling('Tors Hammer', 1, 'sukker', 1);
const bestilling2 = new Bestilling('Americano', 1, 'ingenting', 0);
lagreBestilling(bestilling1);
lagreBestilling(bestilling2);


// konsoll-logger for testing
console.log(lagredeOrdre)


// funksjon for å lese JSON


// funksjon som manipulerer et gitt DOM-element til å printe ut en liste over varer.


// klasse for å kommunisere med backend