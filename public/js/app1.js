// js view conducteur_create
if (document.getElementById('conducteur_principal') != null) {
    document.getElementById('conducteur_principal').addEventListener('change', (function () {
        document.querySelectorAll('#conducteur_secondaire option').forEach(item => {
            if (this.value === item.value) {
                item.disabled = true
            }else{
                item.disabled = false
            }

        })
    }))
}

// js validation demande_vehicule
let buttonVals = document.getElementsByClassName('buttonVal');
for (let i = 0; i < buttonVals.length; i++) {
    const buttonVal = buttonVals[i];
    buttonVal.addEventListener('click', (function(){
        document.querySelector('#validation form #demande').value = this.value
    }))

}

// js retour de véhicule
let buttonRets = document.getElementsByClassName('buttonRet');
for (let i = 0; i < buttonRets.length; i++) {
    const buttonRet = buttonRets[i];
    buttonRet.addEventListener('click', (function(){
        document.querySelector('#retour form #demande').value = this.value
        var kilometrageRet = document.querySelector('form #kilometrage_retour')
        kilometrageRet.setAttribute('min',kilometrages[this.value])
        kilometrageRet.setAttribute('placeholder','Kilométrage de départ :'+kilometrages[this.value])
    }))

}
