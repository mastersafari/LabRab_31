(function a() {


    const xDefaultValues = [-2, -1.5, -1, -0.5, 0, 0.5, 1, 1.5, 2];

    let errorsArea = document.getElementById("errors-area");
    let submitButton = document.getElementById("submit-button");
    let xRadio = document.querySelectorAll("input[name='x']");
    let yText = document.getElementById("y");
    let rText = document.getElementById("r");

    submitButton.addEventListener("click", onSubmit);

    let errorsText = "";

    function onSubmit(event) {
        if (!check()) {
            event.preventDefault();
            errorsArea.innerText = errorsText;
            if (errorsText != null)
                errorsArea.classList.remove("invisible");
            else
                errorsArea.classList.add("invisible");
                

            errorsText = "";
        }
    }

    function check() {
        //checking x
        let selected = null;
        for (let i = 0; i < xRadio.length; i++) {
            if (xRadio[i].checked) {
                // 

                if (xDefaultValues.indexOf(+xRadio[i].value) === -1)   {
                    errorsText += "Не ломайте пжлст :(";
                }

                selected = xRadio[i].value;
            }
        }
        if (!selected) {
            errorsText += "Следует выбрать X\n";
        }

        //checking y
        yText.value = yText.value.trim();

        if (yText.value.length === 0) {
            errorsText += "Поле Y обязательно\n";
        }
        if (yText.value.length >= 10) {
            errorsText += "Значение координаты \nY некорректно\n";
        }
        let yTextValue = yText.value.replace(',', '.');
        if (isNaN(yTextValue)) {
            errorsText += "В поле Y следует\n ввести число\n";
        }
        let val = +yText.value;
        if (val <= -5 || val >= 3) {
            errorsText += 'Y должен лежать в (-5 ; 3)\n';
        }

        //checking r
        rText.value = rText.value.trim();

        if (rText.value.length === 0) {
            errorsText += "Поле R обязательно\n";
        }
        if (rText.value.length >= 10) {
            errorsText += "Значение радиуса\n R некорректно\n";
        }

        let rTextValue = rText.value.replace(',', '.');
        if (isNaN(rTextValue)) {
            errorsText += "В поле R следует\n ввести число\n";
        }
        let v = +rText.value;
        if (v <= 1 || v >= 4) {
            errorsText += 'R должен лежать в (1 ; 4)';
        }
        if (errorsText !== "")
            return false;
        return true;

    }


})();