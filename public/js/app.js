// --------------- Fonction message connexion ------------
const successMessage = document.getElementById("successMessage");
if(successMessage){
    setTimeout(function(){
        successMessage.remove();
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
setTimeout(function(){
  
  const deleteButtons = document.querySelectorAll(".deleteUser")
  console.log(deleteButtons);
  deleteButtons.forEach(button => {
    button.addEventListener('click', async function(event){
      event.preventDefault();
      userId  = button.value;
      console.log(document.querySelector(`.rowUser-${userId}`))
        const response = await fetch('https://blog.ddev.site/users?id='+ userId, {
          method : "DELETE"  
        })
        const message = await response.json()
        console.log(message);
        const rowUser = document.querySelector(`.rowUser-${userId}`)
        rowUser.remove();
    })
  });
},2000);
//-----------------------------------------------------




/* const todo =  fetch('https://jsonplaceholder.typicode.com/todos/1')
  .then(response => response.json())
  .then(json => console.log(json))

console.log(todo) */


/*const a = async function(){
  /* const todoToSave = {
    userId : '5',
    title : 'Bonjour',
    completed : false
  }; 
  const response = await fetch('https://blog.ddev.site/users' , {
    method : "GET"  
  })
  const responseJson = await response.json()
  const users = await responseJson
  console.log(users)
  const body = document.querySelector('body')
  
  /* for(let i = 0; i < users.length; i++){
    const div = document.createElement('div')
    const h4 = document.createElement('h4')
    div.classList.add("container")
    h4.innerHTML = `${users[i].nom} ${users[i].prenom}`;
    div.append(h4)
    body.append(div)
  } 

  users.forEach(user => {
    const div = document.createElement('div')
    const h4 = document.createElement('h4')
    div.classList.add("container")
    h4.innerHTML = `${user.nom} ${user.prenom}`;
    div.append(h4)
    body.append(div)
  });
  
}
a();*/