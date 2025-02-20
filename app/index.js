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

const fields = [
    { id: "client_name", errorClass: "client_name_error", validate: (v) => v === "" || hasNumber(v), msg: "Укажите корректное ФИО клиента" },
    { id: "courier_name", errorClass: "courier_name_error", validate: (v) => v === "" || hasNumber(v), msg: "Укажите корректное ФИО курьера" },
    { id: "client_phone", errorClass: "client_phone_error", validate: (v) => v === "" || v.length < 17, msg: "Укажите корректный номер телефона" },
    { id: "client_mail", errorClass: "email_error", validate: (v) => v === "" || !white_list_email_domains.includes(v.split("@")[1]), msg: "Укажите корректную эл. почту" },
    { id: "product", errorClass: "product_error", validate: (v) => v === "", msg: "Укажите корректное название товара"},
    { id: "product_price", errorClass: "product_price_error", validate: (v) => v === "" || v < 1, msg: "Укажите корректную стоимость товара" },
    { id: "city", errorClass: "city_error", validate: (v) => v === "", msg: "Укажите корректный город" },
    { id: "street", errorClass: "street_error", validate: (v) => v === "", msg: "Укажите корректную улицу" },
    { id: "house", errorClass: "house_error", validate: (v) => v === "" || hasLetter(v[0]) || hasSpecial(v[0]) || v < 1, msg: "Укажите корректный номер дома" },
    { id: "entrance", errorClass: "entrance_error", validate: (v) => (v.length > 0 && v < 1) || hasLetter(v), msg: "Укажите корректный номер подъезда" },
    { id: "apartment", errorClass: "apartment_error", validate: (v) => (v.length > 0 && v < 1) || hasLetter(v), msg: "Укажите корректный номер квартиры" },
    { id: "floor", errorClass: "floor_error", validate: (v) => (v.length > 0 && v < 1) || hasLetter(v), msg: "Укажите корректный номер этажа" },
    { id: "delivery_date", errorClass: "delivery_date_error", validate: (v) => v === "", msg: "Укажите корректную дату доставки"},
    { id: "delivery_price", errorClass: "delivery_price_error", validate: (v) => v === "" || v < 1, msg: "Укажите корректную стоимость доставки" }
];

const validateField = (input, errorClass, validationFunc, msg) => {
    const errorElement = document.querySelector(`.${errorClass}`);
    
    if (validationFunc(input.value)) {
        errorElement.innerText = msg;
    } else {
        errorElement.innerText = "";
    }
}

fields.forEach(({ id, errorClass, validate, msg }) => {
    const input = document.getElementById(id);
    input.addEventListener("blur", () => validateField(input, errorClass, validate, msg));
    input.addEventListener("focus", () => document.querySelector(`.${errorClass}`).innerText = "");
});
