      
    <script type="text/javascript">
      
      google.charts.load('current', {'packages':['table']});
      google.charts.setOnLoadCallback(drawTable);

      function drawTable() {
        var data = new google.visualization.DataTable();
        data.addColumn('string', 'Proceso');
        data.addColumn('number', 'Porcentaje');
        data.addRows([
          ['Chrome.exe',  {v: 10000, f: '90%'}],
          ['VirtualBox.exe',   {v:8000,   f: '120%'}],
          ['Vim.exe', {v: 12500, f: '5%'}],

        ]);

        var table = new google.visualization.Table(document.getElementById('table_div_ram'));

        table.draw(data, {showRowNumber: true, width: '100%', height: '100%'});
      }
    </script>

<div id="table_div_ram"></div>
