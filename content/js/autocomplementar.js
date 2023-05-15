function autocompletar(arreglos){
    const inputCliente = document.querySelector('#tipo-cliente');
    let indexFocus =-1;
    inputCliente.addEventListener('input', function(){
        const tiposcliente = this.value;
        if(!tiposcliente) return false;

        //crear lista de suguerencas
        const divList = document.createElement('div');
        divList.setAttribute('id', this.id + '-lista-autocompletar');
        divList.setAttribute('class', 'lista-autocompletar-items');
        this.parentNode.appendChild(divList);

        //validar arreglo vs input

        if(arreglos.length == 0) return false;

        arreglos.forEach(item => {
            if(item.substr(0, tiposcliente.length)==tiposcliente){
               // console.log(item);
               const elementoLista =document.createElement('div');
               elementoLista.innerHTML = `<strong>${item.substr(0, tiposcliente.length)}</strong>${item.substr(tiposcliente.length)}`;
               elementoLista.addEventListener('click', function(){
                   inputCliente.value = this.innerHTML;
                   return false;
               });
               divList.appendChild(elementoLista);
            }
            
        });

    });
    inputCliente.addEventListener('keydown', function(){

    });

}

autocompletar(['perro', 'gato', 'paloma','conejo'])