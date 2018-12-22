function checkStringToRussianLaungage(val) {
    var regexp = /[а-яА-Я\s]/gm;
    return regexp.test(val);
}

function checkFirstSymbolToNumber(val) {
    var regexp = /[0-9]/gm;
    return regexp.test(val);
}