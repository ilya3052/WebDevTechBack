let element = document.getElementById('client_phone');
let maskOptions = {
    mask: '+7(000)000-00-00',
    lazy: false
} 
let mask = new IMask(element, maskOptions);