function loadGoogleChartsAPI() {
    var script = document.createElement("script");
    script.src = "https://www.google.com/recaptcha/api.js?onload=questOnloadCallback&render=explicit";
    script.type = "text/javascript";
    document.getElementsByTagName("body")[0].appendChild(script);
}

function questRecaptchaCallback(){
    recaptchaValid = true;
    var recaptchaElement = document.getElementsByClassName("quest-g-recaptcha");

    if(recaptchaElement[0].classList.contains("invalid")) {
        recaptchaElement[0].classList.remove("invalid");
    }
}

var questOnloadCallback = function () {
    grecaptcha.render('recaptchaForm-9999', {
        "sitekey": "6LdR0xgUAAAAAJka73YSV6hmJf_pXQvS1V-BNoBj",
        "callback": questRecaptchaCallback,
        "theme": "light"
    });
};