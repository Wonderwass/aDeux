var etape = 0;
$("#form").on("submit", function (e) {
  if (etape < 15) {
    e.preventDefault();
  }

  etape++;
  /*  var email = $("#email").val();*/
  if (etape == 1) {
    $("#email").hide();
    $("#textmail").hide();
    $("#password").show();
    $("#textmdp").show();
  } else if (etape == 2) {
    $("#password").hide();
    $("#textmdp").hide();
    $("#txtnom").show();
    $("#txtnom1").show();
  } else if (etape == 3) {
    $("#txtnom").hide();
    $("#txtnom1").hide();
    $("#txtprenom1").show();
    $("#prenom").show();
  } else if (etape == 4) {
    $("#txtprenom1").hide();
    $("#prenom").hide();
    $("#txtpseudo").show();
    $("#pseudo").show();
  } else if (etape == 5) {
    $("#txtpseudo").hide();
    $("#pseudo").hide();
    $("#txtage").show();
    $("#age").show();
  } else if (etape == 6) {
    $("#txtage").hide();
    $("#age").hide();
    $("#sex").show();
    $("#txtsex").show();
  } else if (etape == 7) {
    $("#sex").hide();
    $("#txtsex").hide();
    $("#txtpoids").show();
    $("#poids").show();
  } else if (etape == 8) {
    $("#txtpoids").hide();
    $("#poids").hide();
    $("#txtyeux").show();
    $("#yeux").show();
  } else if (etape == 9) {
    $("#txtyeux").hide();
    $("#yeux").hide();
    $("#txttaille").show();
    $("#taille").show();
  } else if (etape == 10) {
    $("#txttaille").hide();
    $("#taille").hide();
    $("#txtcheveux").show();
    $("#cheveux").show();
  } else if (etape == 11) {
    $("#txtcheveux").hide();
    $("#cheveux").hide();
    $("#txtorigine").show();
    $("#origine").show();
  } else if (etape == 12) {
    $("#txtorigine").hide();
    $("#origine").hide();
    $("#txtville").show();
    $("#ville").show();
  } else if (etape == 13) {
    $("#txtville").hide();
    $("#ville").hide();
    $("#txtrelation").show();
    $("#relation").show();
  } else if (etape == 14) {
    $("#txtrelation").hide();
    $("#relation").hide();
    $("#txtreligion").show();
    $("#religion").show();
  } else if (etape == 15) {
    $("#txtreligion").hide();
    $("#religion").hide();
    $("#txtimg").show();
    $("#photo").show();
  }
});

$(document).ready(function () {
  function rechargeProfil(
    relation,
    photo,
    pseudo,
    religion,
    cheveux,
    poids,
    taille,
    yeux,
    origine,
    ville,
    age
  ) {
    $(".age").text(pseudo + ", " + age);
    $(".imgprofil").css({
      background: "url(assets/img/" + photo,
      "background-size": "cover",
      "background-repeat": "no-repeat",
      "border-radius": "5px",
    });
    //pour que ca ne me recharge pas la page mais  qu'il me change seulement le profil d'utilistaeur
    $("#txtpk").text(relation);
    $("#pk").text(pseudo);
    $("#religionjs").text(religion);
    $("#cheveuxjs").text(cheveux);
    $("#poid").text(poids);
    $("#taillejs").text(taille);
    $("#yeuxjs").text(yeux);
    $("#originejs").text(origine);
    $("#ouhabite").text("Où habite " + pseudo);
    $("#villejs").text(ville);
  }

  $("#coeur-coeur").click(function (e) {
    e.preventDefault();
    // Récupérer les ID de l'utilisateur actuel et de l'utilisateur ciblé
    var idUtilisateurCible = $(this).data("user-crush"); // Remplacez cela par la manière dont vous obtenez l'ID de l'utilisateur cible
    // Effectuer la requête AJAX
    $.ajax({
      type: "POST",
      url: "./traitement/traitement.crush.php",
      data: {
        action: "like",
        idUtilisateurCible: idUtilisateurCible,
      },
      datatype: "json", // pour travailler en javascript
      success: function (response) {
        if (typeof response === "string") {
          response = JSON.parse(response);
          if (response.aleatUser !== undefined) {
            let responseObj = response.aleatUser;
            rechargeProfil(
              responseObj.relation,
              responseObj.photo,
              responseObj.pseudo,
              responseObj.religion,
              responseObj.cheveux,
              responseObj.poids,
              responseObj.taille,
              responseObj.yeux,
              responseObj.origine,
              responseObj.ville,
              responseObj.age
            );

            $("#coeur-coeur").data("user-crush", responseObj.id_utilisateur);
          } else if (response.vide !== undefined) {
            console.log("Réponse du serveur (vide) :", response.vide);
            $(".FndBlancProfil").html(
              '<div class="conversations_crush">' +
                '<a href="notif.php" class="notif"><i class="gg-bell"></i></a>' +
                '<a class="notifMessage" href="list_crush_conv.php"><i class="gg-comment"></i></a>' +
                '<a href="profil.php" class="redirectionProfil" style="background-image: url(\'view/assets/img/<?= addslashes($_SESSION["photo"]); ?>);"></a>' +
                "</div>" +
                '<div class="FinSwipe">' +
                '<img src="assets/img/robot.rose-removebg-preview.png" alt="icons-robot">' +
                '<h1 id="phrase_robot"></h1>' +
                "</div>"
            );
          } else {
            console.log("Réponse du serveur non gérée :", response);
            // Reste du code...
          }
        }
      },
      error: function (xhr, status, error) {
        console.error("Erreur lors de la requête AJAX :", error);
      },
    });
  });

  $("#recal").click(function (e) {
    e.preventDefault();
    // Récupérer les ID de l'utilisateur actuel et de l'utilisateur ciblé
    var idUtilisateurCible = $(this).data("user-crush"); // Remplacez cela par la manière dont vous obtenez l'ID de l'utilisateur cible
    // Effectuer la requête AJAX
    $.ajax({
      type: "POST",
      url: "./traitement/traitement.crush.php",
      data: {
        action: "recal",
        idUtilisateurCible: idUtilisateurCible,
      },
      datatype: "json", // pour travailler en javascript
      success: function (response) {
        if (typeof response === "string") {
          response = JSON.parse(response);
          if (response.aleatUser !== undefined) {
            let responseObj = response.aleatUser;
            rechargeProfil(
              responseObj.relation,
              responseObj.photo,
              responseObj.pseudo,
              responseObj.religion,
              responseObj.cheveux,
              responseObj.poids,
              responseObj.taille,
              responseObj.yeux,
              responseObj.origine,
              responseObj.ville,
              responseObj.age
            );

            $("#recal").data("user-crush", responseObj.id_utilisateur);
          } else if (response.vide !== undefined) {
            console.log("Réponse du serveur (vide) :", response.vide);
            var photo =
              '<?= htmlspecialchars($_SESSION["photo"], ENT_QUOTES) ?>';
            $(".FndBlancProfil").html(
              '<div class="conversations_crush">' +
                '<a href="notif.php" class="notif"><i class="gg-bell"></i></a>' +
                '<a class="notifMessage" href="list_crush_conv.php"><i class="gg-comment"></i></a>' +
                '<a href="profil.php" class="redirectionProfil" style="background-image: url(\'assets/img/view/assets/img/' +
                photo +
                ')"></a>' +
                "</div>" +
                '<div class="FinSwipe">' +
                '<img src="assets/img/robot.rose-removebg-preview.png" alt="icons-robot">' +
                '<h1 id="phrase_robot"></h1>' +
                "</div>"
            );
          } else {
            console.log("Réponse du serveur non gérée :", response);
            // Reste du code...
          }
        }
      },
      error: function (error) {
        console.error("Erreur lors de la requête AJAX :", error);
      },
    });
  });
});
//document.addEventListener('DOMContentLoaded', function() {
//var hiddenLinks = document.querySelectorAll('.hidden-link');

// hiddenLinks.forEach(function(link) {
//    link.addEventListener('click', function(event) {
//      event.preventDefault(); // Empêche le comportement de lien par défaut
//       window.location.href = this.href; // Effectue la redirection
// });
// });
//});

// Pour la phrase robot

$(document).ready(function () {
  var phrase =
    "Bonjour ! tu as atteint le maximum de profils actuellement disponibles";
  var counter = 0;

  var h1 = $("#phrase_robot");

  function afficherLettre(index) {
    if (index < phrase.length) {
      h1.text(h1.text() + phrase.charAt(index)); // Utilisez .html() pour obtenir et définir le contenu HTML avec jQuery
      index++;
      setTimeout(function () {
        afficherLettre(index);
      }, 50);
    }
  }

  afficherLettre(0);
});

// requete ajax pour les messages privés

function sendMessage(idCible) {
  var input = $("#conversation-" + idCible);
  messageCrush(input, idCible);
}

function handleKeyDown(event, idCible) {
  if (event.which === 13) {
    // Vérifie si la touche pressée est "Entrée" (code 13)
    messageCrush($("#conversation-" + idCible), idCible);
  }
}

function messageCrush(input, idCible) {
  $.ajax({
    type: "POST",
    url: "./traitement/traitement.conv.php",
    datatype: "json",
    data: {
      inputMessage: input.val(),
      idCrush: idCible,
    },
    success: function (response) {
      var text = JSON.parse(response);
      console.log(text.inputMessage);
      $("#messages-conv").append(
        '<div class="otherright right ?>">' +
          '<p id="chatmarg" class="bulle">' +
          text.inputMessage +
          "</p>" +
          "</div>"
      );
      input.val("");
    },
    error: function (error) {
      console.log("Error in AJAX request:", error.responseText);
    },
  });
}

$(document).ready(function () {
  // Appel à une fonction ou AJAX pour charger les derniers messages

  // Supposons que vous ayez une fonction pour charger les messages initiaux
  loadInitialMessages();
});

// Fonction pour charger les messages initiaux
function loadInitialMessages() {
  // Supposons que vous avez une logique pour charger les messages initiaux
  // Utilisez AJAX ou tout autre moyen pour obtenir les messages

  // Une fois que vous avez les messages, ajoutez-les à la zone de chat
  // ...

  // Défiler vers le bas pour afficher les derniers messages
  scrollToBottom();
}

// Fonction pour déplacer le défilement vers le bas
function scrollToBottom() {
  $("#messages-conv").scrollTop($("#messages-conv").prop("scrollHeight"));
}

// Obtenez la largeur et la hauteur de l'écran
var largeurEcran =
  window.innerWidth ||
  document.documentElement.clientWidth ||
  document.body.clientWidth;
var hauteurEcran =
  window.innerHeight ||
  document.documentElement.clientHeight ||
  document.body.clientHeight;

// Affichez les dimensions dans la console
console.log("Largeur de l'écran : " + largeurEcran + " pixels");
console.log("Hauteur de l'écran : " + hauteurEcran + " pixels");

// Sélectionnez l'élément qui a les attributs data-cible et data-user
var messageDiv = $(".FndBlancProfil .other");

// Utilisez la fonction data() pour récupérer les valeurs des attributs data-*

var idCible = messageDiv.data("cible");

function getNewMessages(lastMessageId, idCible) {
  $.ajax({
    type: "GET",
    url: "./traitement/traitement.conv.php",
    data: {
      action: "getNewMessages",
      lastMessageId: lastMessageId,
      idCible: idCible,
    },
    dataType: "json",
    success: function (newMessages) {
      // Traiter les nouveaux messages et les ajouter à l'interface
      newMessages.forEach(function (message) {
        console.log("Nouveau message reçu:", message.message);
        $("#messages-conv").append(
          '<div class="otherleft left">' +
            '<p id="chatmarg" class="bulle">' +
            message.message +
            "</p>" +
            "</div>"
        );
      });

      // Mettre à jour la variable lastMessageId avec le dernier message reçu
      if (newMessages.length > 0) {
        lastMessageId = newMessages[newMessages.length - 1].id;
      }

      // Appeler récursivement la fonction après un certain délai
      setTimeout(function () {
        getNewMessages(lastMessageId, idCible);
      }, 5000); // Rafraîchissement toutes les 5 secondes (ajustez selon vos besoins)
    },
    error: function (error) {
      console.error(
        "Erreur lors de la récupération des nouveaux messages:",
        error.responseText
      );
      // Appeler récursivement la fonction même en cas d'erreur
      setTimeout(function () {
        getNewMessages(lastMessageId, idCible);
      }, 5000); // Rafraîchissement toutes les 5 secondes (ajustez selon vos besoins)
    },
  });
}

// Appel initial pour récupérer les messages au chargement de la page
getNewMessages(0, idCible);
