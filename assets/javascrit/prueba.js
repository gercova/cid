$(document).ready(function () {
var base_url= "<?php echo base_url();?>";
    var year = (new Date).getFullYear();
    datagrafico(base_url,year);

    $("#year").on("change",function(){
        var yearselect = $(this).val();
        datagrafico(base_url,yearselect);
    });
});

function datagrafico(base_url,year){
    namesMonth=["ENE", "FEB", "MAR", "ABR", "MAY", "JUN","JUL", "AGO", "SEP", "OCT", "NOV", "DIC"];
    $.ajax({
            url: base_url + "dashboard/getData",
            type:"POST",
            data:{year: year},
            dataType:"json",
            success:function(data){
                var meses = new Array();
                var montos = new Array();
                $.each(data,function(key, value){
                    meses.push(namesMonth[value.mes -1]);
                    valor = Number(value.monto);
                    montos.push(valor);
                });
                graficar(meses,montos,year);
            }


    });

}

function graficar(meses,montos,year){
    Highcharts.chart('grafico', {
    chart: {
        type: 'column'
    },
    title: {
        text: 'Ingresos Acumulado por Meses'
    },
    subtitle: {
        text: 'Año: ' + year
    },
    xAxis: {
        categories: meses,
        crosshair: true
    },
    yAxis: {
        min: 0,
        title: {
            text: 'Monto Acumulado (soles)'
        }
    },
    tooltip: {
        headerFormat: '<span style="font-size:10px">{point.key}</span><table>',
        pointFormat: '<tr><td style="color:{series.color};padding:0">Monto: </td>' +
            '<td style="padding:0"><b>{point.y:.2f} soles</b></td></tr>',
        footerFormat: '</table>',
        shared: true,
        useHTML: true
    },
    plotOptions: {
        column: {
            pointPadding: 0.2,
            borderWidth: 0
        },
        series:{
            dataLabels:{
                enabled:true,
                formatter:function(){
                    return Highcharts.numberFormat(this.y,2)
                }
            }
        }
    },
    series: [{
        name: 'Meses',
        data: montos


    }]
});
}
