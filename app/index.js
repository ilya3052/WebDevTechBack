const white_list_email_domains = ["yandex.ru", "yandex.by", "yandex.kz", "ya.ru", "mail.ru", "internet.ru", "list.ru", "bk.ru", "inbox.ru", "vk.com", 
    "rambler.ru"];

const hasNumber = (str) => {
    return /\d/.test(str);
}

const hasLetter = (str) => {
    return /[a-zA-Zа-яА-Я]/u.test(str);
}

const hasSpecial = (str) => {
    return /[^a-zA-Z0-9а-яА-Я]/u.test(str);
}

const client_name = document.getElementById('client_name');
client_name.addEventListener('blur', () => {
    if (client_name.value === "" || hasNumber(client_name.value)) {
        document.querySelector(".client_name_error").innerText = "Укажите корректное имя";
    }
}
)
client_name.addEventListener('focus', () => {
    document.querySelector(".client_name_error").innerText = "";
}
)

const courier_name = document.getElementById('courier_name');
courier_name.addEventListener('blur', () => {
    if (courier_name.value === "" || hasNumber(courier_name.value)) {
        document.querySelector(".courier_name_error").innerText = "Укажите корректное имя";
    }
}
)
courier_name.addEventListener('focus', () => {
    document.querySelector(".courier_name_error").innerText = "";
}
)

const email = document.getElementById('client_mail');
email.addEventListener('blur', () => {
    if (email.value === "" || !white_list_email_domains.includes(email.value.split("@")[1])) {
        document.querySelector(".email_error").innerText = "Укажите корректный адрес электронной почты";
    }
}
)
email.addEventListener('focus', () => {
    document.querySelector(".email_error").innerText = "";
}
)

const house = document.getElementById('house');
house.addEventListener('blur', () => {
    if (house.value === "" || (hasLetter(house.value) && !hasNumber(house.value)) ||hasSpecial(house.value)) {
        document.querySelector(".house_error").innerText = "Укажите корректный номер дома";
    }
}
)
house.addEventListener('focus', () => {
    document.querySelector(".house_error").innerText = "";
}
)

const entrance = document.getElementById('entrance');
entrance.addEventListener('blur', () => {
    if (entrance.value === "" || !hasLetter(entrance.value)) {
        document.querySelector(".entrance_error").innerText = "Укажите корректный номер подъезда";
    }
}
)
entrance.addEventListener('focus', () => {
    document.querySelector(".entrance_error").innerText = "";
}
)

const apartment = document.getElementById('apartment');
apartment.addEventListener('blur', () => {
    if (apartment.value === "" || !hasLetter(apartment.value)) {
        document.querySelector(".apartment_error").innerText = "Укажите корректный номер квартиры";
    }
}
)
apartment.addEventListener('focus', () => {
    document.querySelector(".apartment_error").innerText = "";
}
)

const floor = document.getElementById('floor');
floor.addEventListener('blur', () => {
    if (floor.value === "" || !hasLetter(floor.value)) {
        document.querySelector(".floor_error").innerText = "Укажите корректный этаж";
    }
}
)
floor.addEventListener('focus', () => {
    document.querySelector(".floor_error").innerText = "";
}
)

let element = document.getElementById('client_phone');
let maskOptions = {
    mask: '+7(000)000-00-00',
    lazy: false
} 
let mask = new IMask(element, maskOptions);