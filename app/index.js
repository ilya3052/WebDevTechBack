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

const client_phone = document.getElementById('client_phone');
client_phone.addEventListener('blur', () => {
    if (client_phone.value === "" || client_phone.value.length <= 17) {
        console.log(client_phone.value.length);
        
        document.querySelector(".client_phone_error").innerText = "Укажите корректный номер телефона";
    }
}
)

client_phone.addEventListener('focus', () => {
    document.querySelector(".client_phone_error").innerText = "";
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

const product = document.getElementById('product');
product.addEventListener('blur', () => {
    if (product.value === "") {
        document.querySelector(".product_error").innerText = "Укажите корректный товар";
    }
}
)
product.addEventListener('focus', () => {
    document.querySelector(".product_error").innerText = "";
}
)

const product_price = document.getElementById('product_price');
product_price.addEventListener('blur', () => {
    if (product_price.value === "" || product_price.value < 1) {
        document.querySelector(".product_price_error").innerText = "Укажите корректную цену";
    }
}
)
product_price.addEventListener('focus', () => {
    document.querySelector(".product_price_error").innerText = "";
}
)

const house = document.getElementById('house');
house.addEventListener('blur', () => {    
    if (house.value === "" || house.value < 1) {
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
    
    if ((entrance.value.length > 1 && entrance.value < 1) || hasLetter(entrance.value)) {
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
    if (apartment.value === "" || hasLetter(apartment.value)) {
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
    if (floor.value === "" || hasLetter(floor.value)) {
        document.querySelector(".floor_error").innerText = "Укажите корректный этаж";
    }
}
)
floor.addEventListener('focus', () => {
    document.querySelector(".floor_error").innerText = "";
}
)
