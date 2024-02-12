<script type="text/javascript">
$(function () {

    // Radialize the colors
            Highcharts.getOptions().colors = Highcharts.map(Highcharts.getOptions().colors, function(color) {
                return {
                    radialGradient: { cx: 0.5, cy: 0.3, r: 0.7 },
                    stops: [
                        [0, color],
                        [1, Highcharts.Color(color).brighten(-0.3).get('rgb')] // darken
                    ]
//linearGradient: { x1: 0, x2: 0, y1: 0, y2: 1 },
//    stops: [
//        [0, color],
//        [1, '#3366AA']
//    ]
                };
            });

            // Build the chart
    $('#c-dept').highcharts({
        chart: {
            plotBackgroundColor: null,
            plotBorderWidth: null,
            plotShadow: true
        },
        title: {
            text: 'Units / Departments Survey Summary Report'
        },
        subtitle: {
            text: "<strong>Survey Title</strong>: <?php echo $_SESSION["DEFAULT"]["c_name"];?> - www.fbninsurance.com"
        },
        tooltip: { //pointFormat: '<span style="color:{point.color}">{point.name}</span>: <b>{point.y:.2f}%</b> of total<br/>'
                pointFormat: '<span style="color:{series.color}">{series.name}</span>: <b>{point.percentage:.1f}%</b>'
        },
        plotOptions: {
            pie: {
                allowPointSelect: true,
                cursor: 'pointer',
                dataLabels: {
                    enabled: true,
                    color: '#000000',
//                    connectorColor: '#000000',
                    formatter: function() {
                        //var num = this.percentage;
                        return '<b>'+ this.point.name +'</b> = '+ this.y +'%';// Points ('  + num.toFixed(2) +' %)';
                    }
                },
                showInLegend: true
            }
        },
        /*legend: {
            align: 'right',
            layout: 'vertical',
            verticalAlign: 'middle',
            itemMarginBottom: 4,
            itemMarginTop: 4,
            x: -40
        },*/
        series: [{
            type: 'pie',
            colorByPoint: true,
            name: 'Overall Percent',
            data: [
                <?php $d = '';
                if ($record = $cReports->ReportsDepartments($_REQUEST))
                {
                    foreach ($record as $key => $value) {
    //                        $labels[] = $value['label'];
    //                        $data[] = $value['value'];//$value['pe_market_value_percent'];
                        if ($key == 0){
                            $d .= "{name: '". $value['d_name'].': '.$value['d_tot_scores'].'/'.$value['d_max_scores'] ."',
                                        y: ". $value['d_percent'] .",
                                        sliced: true,
                                        selected: true
                                    },";
                        }else{
                            $d .= "['". $value['d_name'].': '.$value['d_tot_scores'].'/'.$value['d_max_scores'] ."', ".$value['d_percent']."],";//d_tot_scores
                        }
                    }
                }
                    echo substr($d, 0, -1);
                ?>
            ]
        }]
    });
});

</script>
<div id="c-dept" style="min-width: 610px; min-height: 440px; margin: 0 auto"></div>