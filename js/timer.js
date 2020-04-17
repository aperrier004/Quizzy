/* Chronometre utilisé pour les questionnaires qui doivent être effectués en un temps limité*/

    function timer(min, sec) {
        var yourDateToGo = new Date(); //on récupere la date actuelle

        /* On y ajoute la durée du chronometre, en min et sec */
        yourDateToGo.setSeconds(yourDateToGo.getSeconds() + sec);
        yourDateToGo.setMinutes(yourDateToGo.getMinutes() + min); 
        /* On va afficher, chaque seconde, la différence entre yourDateToGo (l'heure à la fin du chrono) et l'heure actuelle */
        var timing = setInterval( 
            function() {
            
                var currentDate = new Date().getTime(); 
                var timeLeft = yourDateToGo - currentDate; //difference entre la date fin du chrono et la date actuelle
                var days = Math.floor(timeLeft / (1000 * 60 * 60 * 24)); //conversion milisecondes en jours
                if (days < 10) days = "0" + days; 
                var hours = Math.floor((timeLeft % (1000 * 60 * 60 * 24)) / (1000 * 60 * 60)); //conversion milisecondes en heures
                if (hours < 10) hours = "0" + hours;
                var minutes = Math.floor((timeLeft % (1000 * 60 * 60)) / (1000 * 60)); //conversion milisecondes en minutes 
                if (minutes < 10) minutes = "0" + minutes;
                var seconds = Math.floor((timeLeft % (1000 * 60)) / 1000); //conversion milisecondes en seconds
                if (seconds < 10) seconds = "0" + seconds;

                document.getElementById("tempsRestant").innerHTML = minutes + "m " + seconds + "s"; // On affiche le temps dans la div associée 
                
                /* Si le chronomètre arrive à 0, un boite de dialogue d'ouvre et on envoie le formulaire de réponses */
                if (timeLeft <= 0) {
                    clearInterval(timing);
                    document.getElementById("tempsRestant").innerHTML = "0m 00s";
                    alert("Temps écoulé !");
                    $('button[type="submit"]').click(); // on envoie le formulaire

                }
            }, 1000);
    }

