(function ($) {
    "use strict";

    $(function () {
        var baslik = $('.grafik .baslik').html();
        var yBaslik = $('.grafik .yBaslik').html();
        var kategoriler = $('.grafik .kategoriler').data('isim-liste').split(',');

        var dummy = $('.grafik .kategoriler ul');
        var seriler = new Array();
        for (var i = 0; i < dummy.length; i++) {
            seriler[i] = new Object();
            seriler[i].name = $(dummy[i]).data('isim');
            var liste = $(dummy[i]).find('li');
            seriler[i].data = new Array();
            for (var j = 0; j < liste.length; j++) seriler[i].data.push(parseInt($(liste[j]).html()));
        }

        $('.grafik').highcharts({
            title: {
                text: baslik,
                x: -20 //center
            },
            xAxis: {
                categories: kategoriler
            },
            yAxis: {
                title: {
                    text: yBaslik
                },
                plotLines: [{
                    value: 0,
                    width: 1,
                    color: '#808080'
                }]
            },
            tooltip: {
                valueSuffix: ''
            },
            legend: {
                layout: 'vertical',
                align: 'right',
                verticalAlign: 'middle',
                borderWidth: 0
            },
            series: seriler
        });
    });


})(jQuery);