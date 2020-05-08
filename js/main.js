const inputs = document.querySelectorAll('.input');
// const textInputs = document.querySelectorAll('.text-input');


function focusFunc(){
    let parent = this.parentNode.parentNode;
    parent.classList.add('focus');
}

function blurFunc(){
    let parent = this.parentNode.parentNode;
    if(this.value ==""){
        parent.classList.remove('focus');
    }
    
}

inputs.forEach(input => {
    input.addEventListener('focus', focusFunc);
    input.addEventListener('blur', blurFunc);
});


var pass = document.querySelector('#passb');
pass.addEventListener("keyup", function(){
    checkPassword(pass.value);
});

function checkPassword(password){
    var strengthBar = document.querySelector('#strength');
    var message = document.querySelector('#message-beginner');
    var strength = 0;   


    if(password.match(/[a-z]+/)){
        strength+=1;
    }
    if(password.match(/[A-Z]+/)){
        strength+=1;
    }
    if(password.match(/[0-9]+/)){
        strength+=1;
    }
    if(password.match(/[()#$%^&*@!?<>]+/)){
        strength+=1;
    }
    if(password.length > 8){
        strength+=1;
    }
    //console.log(strength);
    switch(strength){
        case 0:{
            strengthBar.value = 0; 
            message.innerHTML = "";           
            break;
        }
        case 1:{
            strengthBar.value = 2;
            //strengthBar.style.backgroundColor = 'red';
            message.innerHTML = "<p style='color:red'>Słabiutko! Zabezpiecz lepiej bo jakieś Mańki wejdą ci na konto.</p>";
            break;

        }
        case 2:{
            strengthBar.value = 4;
            message.innerHTML = "<p style='color:orange'>Trochę lepiej ale dalej słabo</p>";
            break;
        }
        case 3:{
            strengthBar.value = 6;
            message.innerHTML = "<p style='color:#FFE333'>Jest ok ale stać cię na więcej!</p>";
            break;
        }
        case 4:{
            strengthBar.value= 8;
            message.innerHTML = "<p style='color:green'>Jest dobrze! Żaden Maniek nie wejdzie na twoje konto</p>";
            break;
        }
        case 5:{
            strengthBar.value = 10;
            message.innerHTML = "<p style='color:#6FE717'>Jest mega dobrze! Hakery nie majo szans</p>";
            break;
        }
    }

    //console.log(strengthBar);

}


        