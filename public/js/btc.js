$("#test").change(function() {
    var doge = $(this).val();
    $.getJSON("https://www.cryptonator.com/api/ticker/btc-usd", function(data) {
        if (doge == "1") {
            document.getElementById("first").innerHTML = "Valor";
            document.getElementById("second").innerHTML = "Valor2";


        }
        if (doge == "2") {
            document.getElementById("first").innerHTML = "BTC";
            document.getElementById("second").innerHTML = "USD";
            var btc1 = data.ticker.price;

            $('#BTC').change(function() {
                var btc = $('#BTC').val();

                var usd = btc * btc1;

                document.getElementById("USD").value = usd;
            });

            $('#USD').change(function() {
                var usd2 = $('#USD').val();
                var usd3 = usd2 / btc1;
                document.getElementById("BTC").value = usd3;
            });

        }

       
        
        
        
        
    });
});