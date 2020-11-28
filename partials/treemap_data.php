<script type="text/javascript">
    google.charts.load('current', {
        'packages': ['treemap']
    });
    google.charts.setOnLoadCallback(drawChart);

    function drawChart() {
        var data = google.visualization.arrayToDataTable([
            ['Volumen', 'Parent', 'size', 'Market increase/decrease (color)'],
            ['Global', null, 0, 0],
            ['America', 'Global', 30, 10],
            ['Europe', 'Global', 35, 20],
            ['Asia', 'Global', 49, 30],
            ['Australia', 'Global', 60, 40],
            ['Africa', 'Global', 70, 50],
            
        ]);

        tree = new google.visualization.TreeMap(document.getElementById('treemap_div'));
        
        tree.draw(data, {
            minColor: '#f00',
            midColor: '#ddd',
            maxColor: '#0d0',
            headerHeight: 15,
            fontColor: 'black',
            showScale: true
        });

    }
</script>


<div id="treemap_div" style="width: 400x; height: 300px;"></div>