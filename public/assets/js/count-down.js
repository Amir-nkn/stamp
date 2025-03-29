// function countdown() {
//     let tempsRestant = 24 * 60 * 60; // 24 heures
//     let timer = setInterval(function() {
//         let heures = Math.floor(tempsRestant / 3600);
//         let minutes = Math.floor((tempsRestant % 3600) / 60);
//         let secondes = tempsRestant % 60;
//         document.getElementById("countdown").textContent = `${heures}h ${minutes}m ${secondes}s`;
//         if (tempsRestant <= 0) {
//             clearInterval(timer);
//             document.getElementById("countdown").textContent = "Fin de l'enchère";
//         }
//         tempsRestant--;
//     }, 1000);
// }
// countdown();
