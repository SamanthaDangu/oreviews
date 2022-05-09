const app = {
    apiBaseUrl: 'http://localhost:8080',
    init: function() {
        console.log('app.init()');

        // On appelle la méthode s'occupant d'ajouter les EventListener sur les éléments déjà dans le DOM
        app.addAllEventListeners();

        // On appelle la méthode s'occupant de charger tous les jeux vidéo
        app.loadVideoGames();
    },
    addAllEventListeners: function() {
        // On récupère l'élément <select> des jeux vidéo
        const selectElement = document.getElementById('videogameId');
        // On ajoute l'écouteur pour l'event "change"
        selectElement.addEventListener('change', app.handleVideogameSelected);

        // On récupère le bouton pour ajouter un jeu vidéo
        const addVideogameButtonElement = document.getElementById('btnAddVideogame');
        // On ajoute l'écouteur pour l'event "click"
        addVideogameButtonElement.addEventListener('click', app.handleClickToAddVideogame);

        // On récupère le formulaire d'ajout d'un jeu vidéo
        const addVideogameFormElement = document.getElementById('addVideogameForm');
        // On ajoute l'écouteur pour l'event "submit"
        addVideogameFormElement.addEventListener('submit', app.handleSubmitAddVideogame);
        
    },
    handleVideogameSelected: function(evt) {
        // On récupère l'élément <select> des jeux vidéos
        const selectElement = document.getElementById('videogameId');

        // On récupère l'élément contenant la review
        const reviewElement = document.getElementById('review');
        // Et on le vide
        while (reviewElement.firstChild) {
            reviewElement.removeChild(reviewElement.firstChild);
        }

        // On récupère la valeur du menu déroulant
        const videogameId = selectElement.value;
        // Debug
        // console.log('videogameId sélectionné : ' + videogameId);

        // On demande à l'API les infos pour le jeu vidéo
        // Options de la requête HTTP
        const fetchOptions = {
            method: 'GET',
            mode: 'cors',
            cache: 'no-cache'
        };
        
        // Exécuter la requête HTTP via XHR
        fetch(app.apiBaseUrl + '/videogames/'+videogameId+'/reviews', fetchOptions)
        .then(
            function(response) {
                return response.json();
            }
        )
        .then(
            function(jsonResponse) {
                // Et maintenant, on a accès aux données facilement
                console.log(jsonResponse);

                // Si il y a des reviews
                if (jsonResponse.length > 0) {
                    // --- On a un tableau de reviews, on peut le parcourir et créer chaque élément et le remplir ---
                    for(let i=0; i<jsonResponse.length; i++) {
                        app.createReview(jsonResponse[i]);
                    }
                }
                // Sinon
                else {
                    // On affiche un message d'alert
                    alert('Aucune critique pour ce jeu vidéo');
                }
            }
        );
    },
    createReview: function(review) {
        // Clone la template et on nrécupère son contenu
        const reviewElement = document.getElementById('reviewTemplate').content.cloneNode(true);

        // On personnalise avec les données
        reviewElement.querySelector('.reviewTitle').textContent = review.title;
        reviewElement.querySelector('.reviewText').textContent = review.text;
        reviewElement.querySelector('.reviewEditor').textContent = review.videogame.editor;
        reviewElement.querySelector('.reviewPlatform').textContent = review.platform.name;
        reviewElement.querySelector('.reviewVideogame').textContent = review.videogame.name;
        reviewElement.querySelector('.reviewPublication').textContent = review.publication_date;
        reviewElement.querySelector('.reviewAuthor').textContent = review.author;
        reviewElement.querySelector('.reviewDisplay').textContent = review.display_note;
        reviewElement.querySelector('.reviewGameplay').textContent = review.gameplay_note;
        reviewElement.querySelector('.reviewScenario').textContent = review.scenario_note;
        reviewElement.querySelector('.reviewLifetime').textContent = review.lifetime_note;

        // ne reste plus qu'à ajouter cette 'review' à la page
        document.getElementById('review').appendChild(reviewElement);
    },
    handleClickToAddVideogame: function(evt) {
        // https://getbootstrap.com/docs/4.4/components/modal/#modalshow
        // jQuery obligatoire ici
        $('#addVideogameModal').modal('show');
    },
    handleSubmitAddVideogame: function(evt) {
        // On stoppe l'envoi de données en HTTP (GET ou POST)
        evt.preventDefault();

        // On récupère les données du formulaire
        // https://developer.mozilla.org/fr/docs/Web/API/Fetch_API/Using_Fetch section "Corps" tout en bas
        let formData = new FormData(document.getElementById('addVideogameForm'));
        // On ajoute le status qui n'est pas dans le formulaire
        formData.append('status', 1);

        // On consomme l'API pour ajouter en DB
        const fetchOptions = {
            method: 'POST',
            mode: 'cors',
            cache: 'no-cache',
            // On ajoute les données du formulaire dans le corps de la requête
            body: formData
        };
        
        // Exécuter la requête HTTP via XHR
        fetch(app.apiBaseUrl + '/videogames', fetchOptions)
        .then(
            function(response) {
                // console.log(response);
                // si HTTP status code à 201 => OK
                if (response.status == 201) {
                    // Donc on peut recharger le menu déroulant
                    app.loadVideoGames();

                    // Vider les inputs de la fenêtre Modal
                    document.getElementById('inputTitle').value = '';
                    document.getElementById('inputEditor').value = '';

                    // Et fermer la fenêtre Modal
                    // https://getbootstrap.com/docs/4.4/components/modal/#modalhide
                    // jQuery obligatoire ici
                    $('#addVideogameModal').modal('hide');

                    // Puis convertir en JS le "texte JSON" reçu
                    // afin de récupérer les données et d'ajouter au menu déroulant
                    return response.json();
                }
                else {
                    alert('L\'ajout a échoué');
                }
            }
        )
        .then(
            function(jsonResponse) {
                // On s'assure que la réponse reçue ne soit pas vide
                if (jsonResponse.id > 0) {
                    app.addOptionToVideogameSelect(jsonResponse.id, jsonResponse.name);
                }
            }
        );
    },
    loadVideoGames: function() {
        // Options de la requête HTTP
        const fetchOptions = {
            method: 'GET',
            mode: 'cors',
            cache: 'no-cache'
        };
        
        // Exécuter la requête HTTP via XHR
        fetch(app.apiBaseUrl + '/videogames', fetchOptions)
        .then(
            function(response) {
                return response.json();
            }
        )
        .then(
            function(jsonResponse) {
                // Et maintenant, on a accès aux données facilement
                console.log(jsonResponse);

                // On vide le contenu du menu déroulant
                const selectElement = document.getElementById('videogameId');
                while (selectElement.firstChild) {
                    selectElement.removeChild(selectElement.firstChild);
                }
                // Puis on ajoute la première option "choisissez"
                app.addOptionToVideogameSelect(0, 'choisissez');

                // --- On a la liste, on peut ajouter les options au menu déroulant ---
                // On parcourt les résultats
                for (let i=0; i<jsonResponse.length; i++) {
                    app.addOptionToVideogameSelect(jsonResponse[i].id, jsonResponse[i].name);
                }
            }
        );
    },
    addOptionToVideogameSelect: function(value, label) {
        // On récupère l'élément <select> des jeux vidéos
        const selectElement = document.getElementById('videogameId');

        // On génère l'élément <option>
        let optionElement = document.createElement('option');
        optionElement.value = value;
        optionElement.textContent = label;

        // On ajoute dans le DOM
        selectElement.appendChild(optionElement);
    }
};

document.addEventListener('DOMContentLoaded', app.init);