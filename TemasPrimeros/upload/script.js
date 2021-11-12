'use strict';
// Manejar el DOM
// console.log(document.querySelector('.mensaje').textContent);
//Con este método podemos selecconar el elemento de la clase .mensaje y sacar su contenido
// document.querySelector('.mensaje').textContent = '😍 Patata';
// document.querySelector('.number').textContent = '23';
// document.querySelector('.score').textContent = '10';

let numero = Math.floor((Math.random() * (20-1))+1);
console.log(numero);
let number = document.querySelector('.number');
let bodyBackgroundColor = document.querySelector('body').style.backgroundColor;
let derStyleColor = document.querySelector('.der').style.color;
let entreStyleColor = document.querySelector('.entre').style.color;
let h1 = document.querySelector('h1');
let mensajeTextContent = document.querySelector('.mensaje').textContent;
let Mpuntuacion = document.querySelector('.Mpuntuacion');
let score = document.querySelector('.score').textContent;


///////////
//Eventos
document.querySelector('.check').addEventListener('click',function() {
    const adivina = document.querySelector('.adivina').value;
    const number = document.querySelector('.number').textContent;
    if (adivina != "") {
        if (Number(adivina) === numero ) {
            document.querySelector('.number').textContent = numero;
            document.querySelector('.number').style.width='15rem';
            document.querySelector('body').style.backgroundColor = '#f0f7ab';
            document.querySelector('.der').style.color = '#000';
            document.querySelector('.entre').style.color = '#000';
            document.querySelector('h1').style.color = '#000';
            document.querySelector('.mensaje').textContent = "numero acertado";
            document.querySelector('h1').textContent = "Has ganado!";

            if (document.querySelector('.Mpuntuacion').textContent < document.querySelector('.score').textContent) {
                document.querySelector('.Mpuntuacion').textContent = document.querySelector('.score').textContent ;
            } else {
                console.log("Tu puntuacion actual es mejor")
            }
        } else if (Number(adivina) > numero){
            document.querySelector('.score').textContent -= 1;
            document.querySelector('.mensaje').textContent = "El numero es menor";
        } else {
            document.querySelector('.score').textContent -= 1;
            document.querySelector('.mensaje').textContent = "El numero es mayor";
        }
    } else{
        alert("Esta vacio")
    }
})

document.querySelector('.denuevo').addEventListener('click',function() {
    document.querySelector('.number').textContent = '?';
    document.querySelector('.adivina').value = '';
    document.querySelector('.score').textContent = '20';
    document.querySelector('.number').style.width='12rem';
    document.querySelector('body').style.backgroundColor = '#000';
    document.querySelector('.der').style.color = '#fff';
    document.querySelector('.entre').style.color = '#fff';
    document.querySelector('h1').style.color = '#fff';
    document.querySelector('h1').textContent = "Adivina el número!";
    numero = Math.floor((Math.random() * (20-1))+1);
    console.log(numero);


})

////////////////
//logica del juego
// generar numero aleatorio entre 1 y 20
// comprobar si es ===
// si has ganado hay que comprobar la puntuación maxima
// cabiar estilo del body y number
// comprobar si es > --> resta uno a la puntuacion y mandar mensaje
// comprobar si es < --> resta uno a la puntuacion y mandar mensaje

// cuando hacemos click en el boton tenemos que resetear todos los datos
/////////////////////

