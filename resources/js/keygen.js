(function () {
    function getRandomInt(min, max) {
        return Math.floor(Math.random() * (max - min + 1)) + min;
    }

    function generateProductKey() {
        var tokens = "abcdefghijklmnopqrstuvwxyz0123456789",
            charsStart = 8,
            chars = 4,
            charsEnd = 12,
            segments = 5,
            keyString = "";

        for (var i = 0; i < segments; i++) {
            var segment = "";

            if (i == 0) {

                for (var j = 0; j < charsStart; j++) {
                    var k = getRandomInt(0, 35);
                    segment += tokens[k];
                }

            } else if (i == (segments-1)) {

                for (var j = 0; j < charsEnd; j++) {
                    var k = getRandomInt(0, 35);
                    segment += tokens[k];
                }
                
            }else {
                for (var j = 0; j < chars; j++) {
                    var k = getRandomInt(0, 35);
                    segment += tokens[k];
                }
            }

            keyString += segment;

            if (i < (segments - 1)) {
                keyString += "-";
            }
        }

        return keyString;

    }

    document.addEventListener("DOMContentLoaded", function () {
        var generate = document.querySelector("#generate"),
            output = document.querySelector("#field-license-key-66a27576c485363b0d587d1c659501755fe3deb8");

        generate.addEventListener("click", function () {

            var productKey = generateProductKey();
            output.value = productKey;

        }, false);

    });

})();
