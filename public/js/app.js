// --------------- Fonction message connexion ------------
const messageLog = document.getElementById("messageLog");
if(messageLog){
    setTimeout(function(){
      messageLog.remove();
    },2000);
}


// ----------------- Forrmulaire d'inscription -------------
// petite commparaison entre le mdp et la confirmation affichant 
// un message quand les 2 sont identiques 
const check = function() {
  const mdp = document.getElementById('password').value;
  const mdpconfirm = document.getElementById('confirmpwd').value;
  const message = document.getElementById('message');
    if ((mdp != null) && (mdp ==
      mdpconfirm)) {
      message.style.color = 'green';
      message.innerHTML = 'Mot de passe identique';
    } else {
      message.style.color = 'red';
      message.innerHTML = 'Mot de passe incorrect';
    }
}


//------------------ A améliorer -----------------
// fonction supprimer utilisant AJAX 
// setimeout obligatoire pour le moment pour attendre le chargement de la page
const deleteButtons = document.querySelectorAll(".deleteUser")
  //console.log(deleteButtons);
  deleteButtons.forEach(button => {
    button.addEventListener('click', async function(event){
      event.preventDefault();
      userId  = button.value;
      //console.log(document.querySelector(`.rowUser-${userId}`))
        const response = await fetch('https://blog.ddev.site/users?id='+ userId, {
          method : "DELETE"  
        })
        const message = await response.json()
        //console.log(message);
        const rowUser = document.querySelector(`.rowUser-${userId}`)
        console.log(rowUser);
        rowUser.remove();
    })
  });
/* setTimeout(function(){
  
},2000); */
//-----------------------------------------------------


setTimeout(function(){
  const deleteButtons = document.querySelectorAll(".deleteComment")
    deleteButtons.forEach(button => {
      button.addEventListener('click', async function(event){
        event.preventDefault();
        commentId  = button.value;
          const response = await fetch('https://blog.ddev.site/comments?id='+ commentId, {
            method : "DELETE"  
          })
          const message = await response.json()
          const rowComment = document.querySelector(`.rowComment-${commentId}`)
          rowComment.remove();
      })
    });
},3000);